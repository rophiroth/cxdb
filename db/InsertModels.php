<?php 
//include the information needed for the connection to MySQL data base server. 
// we store here username, database and password 
include("dbconfig.php");
error_reporting(E_ALL ^ E_NOTICE);
require_once '../php/excel_reader2.php';

$xls=$_GET['xls'];
if($xls=="") $xls='../php/scores.xls';
$data = new Spreadsheet_Excel_Reader($xls);
//echo $data->dump(true,true); 
$cx = array(
  'A1' => 430,
  'A3' => 460,
  'A8' => 500,
  'B1' => 320,
  'D2' => 360,
  'D4' => 390,
  'G1' => 450
);

$species = array(
    0 => 'HUMAN',
    5 => 'MOUSE',
    10 => 'RAT'
);

$sId = array(
    'HUMAN' => 6,
    'MOUSE'=> 0,
    'RAT' => 3
);

$insert ="";
$modelId=272;
$page = 1;
//for de 10 pasos para ir cx por cx (son 10 modelos x cx)
for($i=1;$i<$data->rowcount($page);$i+=11)
{
    $pName = substr(cell($i,0),0,2);
    //(recorrido por columnas para las 3 especies)
    for($j=0;$j<3*5;$j+=5)
    {        
        $sIdentity = cell($i,($j+3));
        $sSimilarity = cell($i,($j+4));
//        echo $pid."<br>";
        
        //recorrido de las 10 filas para los distintos modelos de las 3 especies
        for($k=$i+1;$k<=10+$i;$k++)
        {
//            echo "i:".$i." j:".$j." k:".$k."<br>";
            $file = "CX".$pName."_".$species[$j].".B99990".cell($k, $j);
            //insert for model
//            $insert .= "INSERT INTO `CXModelsDB`.`Model` (`Protein_idProtein`, `ModelType_idModelType`, `PDB`, `alignment`, `seqIdentity`, `seqSimilarity`)".
//                "VALUES ( ".$cx[$pName].", 0, '".$file.".pdb', '".$file.".fasta', ".$sIdentity.", ".$sSimilarity.");";
//            echo "INSERT INTO `CXModelsDB`.`Model` (`Protein_idProtein`, `ModelType_idModelType`, `PDB`, `alignment`, `seqIdentity`, `seqSimilarity`)" .
//                "VALUES ( ".$cx[$pName]+$sId[$species[$j]].", 0, '".$file.".pdb', '".$file.".fasta', ".$sIdentity.", ".$sSimilarity.");<br>";
            //insert scores
            //DOPE
            $score = cell($k, $j+1);
//            echo "Cell: ".$score."<br>";
            echo "INSERT INTO `CXModelsDB`.`Score` (`Evaluator_idEvaluator`, `Model_idModel`, `value`) VALUES ('1', $modelId, $score);<br>";
            
            $insert .= "INSERT INTO `CXModelsDB`.`Score` (`Evaluator_idEvaluator`, `Model_idModel`, `value`) VALUES ('1', $modelId, $score);";
            //MAIDEN
            $score = cell($k, $j+2);
//            echo "Cell2: ($k, $j+2): ".$score."<br>";
            echo "INSERT INTO `CXModelsDB`.`Score` (`Evaluator_idEvaluator`, `Model_idModel`, `value`) VALUES ('2', $modelId, $score);<br>";
            //
            $insert .= "INSERT INTO `CXModelsDB`.`Score` (`Evaluator_idEvaluator`, `Model_idModel`, `value`) VALUES ('2', $modelId, $score);";
            $modelId++;
        }
    }
//    $data->
//    echo $data->raw($i,'A');
}

function cell($r,$c)
{
//    echo "val( ".$r.", ".chr($c+65) ."); result:".$GLOBALS['data']->val( $r, chr($c+65) )."<br>";
    return $GLOBALS['data']->raw( $r, chr($c+65),$GLOBALS['page'] );
}

// connect to the MySQL database server 
$db = mysqli_connect($dbhost, $dbuser, $dbpassword,$database) or die("Connection Error: " . mysql_error()); 
 
// select the database 
//mysql_select_db($database) or die("Error connecting to db."); 
 
//echo $insert;
// make the instert
//$result = mysqli_multi_query($db,$insert);
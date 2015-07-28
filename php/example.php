<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';

$xls=$_GET['xls'];
if($xls=="") $xls='score.xls';
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

//for de 10 pasos para ir cx por cx (son 10 modelos x cx)
for($i=1;$i<$data->rowcount();$i+=11)
{
    $pName = substr($data->val($i,chr(0+65)),0,2);
    //(recorrido por columnas para las 3 especies)
    for($j=0;$j<3*5;$j+=5)
    {        
        $sIdentity = $data->val($i,chr($j+3+65));
        $sSimilarity = $data->val($i,chr($j+4+65));
//        echo $pid."<br>";
        
        //recorrido de las 10 filas para los distintos modelos de las 3 especies
        for($k=$i+1;$k<=10+$i;$k++)
        {
//            echo "i:".$i." j:".$j." k:".$k."<br>";
            $file = "CX".$pName."_".$species[$j].".B99990".cell($k, $j);
            echo "INSERT INTO `CXModelsDB`.`Model` (`Protein_idProtein`, `ModelType_idModelType`, `PDB`, `alignment`, `seqIdentity`, `seqSimilarity`)".
                "VALUES ( ".$cx[$pName].", 0, '".$file.".pdb', '".$file.".fasta', ".$sIdentity.", ".$sSimilarity.")<br>";
            
        }
    }
//    $data->
//    echo $data->raw($i,'A');
}

function cell($r,$c)
{
//    echo "val( ".$r.", ".chr($c+65) ."); result:".$GLOBALS['data']->val( $r, chr($c+65) );
    return $GLOBALS['data']->val( $r, chr($c+65) );
}
?>
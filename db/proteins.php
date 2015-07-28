<?php 
//include the information needed for the connection to MySQL data base server. 
// we store here username, database and password 
include("dbconfig.php");
 
// get how many rows we want to have into the grid - rowNum parameter in the grid 
$limit = $_GET['rows']; 
 
// connect to the MySQL database server 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
 
// select the database 
mysql_select_db($database) or die("Error connecting to db."); 

// the actual query for the grid data 
$SQL = "SELECT * FROM getAllProteins"; // ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
 
// we should set the appropriate header information. Do not forget this.
$s = "{\n\r\"rows\":\n[";
$firstRow = true;
// be sure to put text data in CDATA
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //check first row or not to put ,
    if($firstRow){
        $firstRow=false;
    }else{ $s .= ","; }
        
    $s .= "{";
    $s .= "\"id\":". $row['idProtein'].",";
    //$s .= "<cell>". $row['idProtein']."</cell>";
    $s .= "\"Name\":\"". $row['Protein Name']."\",";
    $s .= "\"Family\":\"". $row['Family']."\",";
    $s .= "\"Structure Type\":\"". $row['Structure Type']."\",";
    $s .= "\"Organism\":\"". $row['Organism']."\",";
    $s .= "\"Array\":\"". getArrayText($row['isHeteromeric'], $row['isHeterotipic'])."\"";
    $s .= "}";
//    $s .= "}<br>";
}
$s .= "]}"; 
 
echo $s;

function getArrayText($isHeteromeric,$isHeterotipic)
{
    $r = "";
    if($isHeteromeric){
        $r = "Heteromeric";}
    if(!$isHeteromeric){
        $r = "Homomeric";}
    if($isHeterotipic){
        $r .= " and Heterotipic";}
    if($isHeterotipic!= null && !$isHeterotipic){
        $r .= " and Homotipic";}
        //echo $result;
    return $r;
}

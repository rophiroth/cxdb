<?php
$files = $_POST['files'];
//echo "XXD";
//$files = filter_input(INPUT_POST, 'files');
//$files = filter_input(INPUT_GET, 'files');
$zip = new ZipArchive();
$zip_path = "../public/";
//$zip_path = "";
session_start();
$zip_name = session_id().".zip";
//$zip_name = tempnam(sys_get_temp_dir(), 'CX');
//echo tmpfile()."\n";
//echo sys_get_temp_dir()."\n";
$zip->open($zip_path.$zip_name,  ZipArchive::OVERWRITE);
$downloadRdy =false;
//echo "Files: ".$files."\n";
//if($files ==NULL)
//    echo "NADA!";
//echo $files;
//echo "decoded json: ".json_decode(stripslashes($files));
//return;

//foreach (json_decode(stripslashes($files)) as $file) {
foreach ($files as $file) {
//  echo $file."\n";
//  $file= "../proteinModels/cx39/alineamiento.fasta";
  if(file_exists($file)){
    $return = $zip->addFromString(basename($file),  file_get_contents($file));
//    echo file_get_contents($file);
    if($return)
    {
        $downloadRdy = true;
//        echo "file count: ".$zip->numFiles;
//        echo "\nfilezise: ".filesize($zip_path.$zip_name);
//        echo "\nfilename: ".$zip->filename;
    }
  }
  else{
//   echo"file does not exist";
  }
}
//sleep(10);
$name = $zip->filename;
$zip->close();
if($downloadRdy)
{
//sleep(1);
//   echo "filezise: ".filesize($zip_path.$zip_name);
//   header('Content-Type: application/zip');
//   header("Content-Type: application/force-download");// some browsers need this
//   header('Content-disposition: attachment; filename='.$zip_name);
////   header('Content-disposition: attachment; filename='.$name);
////   header('Expires: 0');
////   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
////   header('Pragma: public');
////   header('Content-Length: ' . filesize($zip_path.$zip_name));
//   //ob_clean();
//   //flush();
//   readfile($zip_path.$zip_name);
//    echo json_encode(array('zip'=>$name));
    echo "public/".$zip_name;
}
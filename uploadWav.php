<?php


#$upload_dir = 'uploads/';
#$target_file = $upload_dir . basename($_FILES["uploadFile2"]["name"]);
$tmp_name = $_FILES["uploadFile2"]["tmp_name"];
$name = $_FILES["uploadFile2"]["name"];
$moved = move_uploaded_file($tmp_name, "$name");
$FileType = pathinfo($name,PATHINFO_EXTENSION);
$filename = pathinfo($name, PATHINFO_FILENAME);

if($FileType != "wav" && $FileType != "mp3" )
    {
    echo "Sorry only wav  files are allowed.";
    $uploadOk = 0;
}
else if ($moved && file_exists("$name")){
    #echo  'uploaded';
    $python = `python STT.py $name $filename`;
    echo $python;
}
 else {
     echo'SORRY';
}


?>
<?php


$upload_dir = 'uploads/';
$target_file = $upload_dir . basename($_FILES["uploadFile1"]["name"]);
$tmp_name = $_FILES["uploadFile1"]["tmp_name"];
$name = $_FILES["uploadFile1"]["name"];
$moved = move_uploaded_file($tmp_name, "$upload_dir/$name");
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($FileType != "txt" && $FileType != "doc" )
    {
    echo "Sorry only TXT  files are allowed.";
    $uploadOk = 0;
}
else if ($moved && file_exists("$upload_dir/$name")){
    echo  'uploaded';
}
 else {
     echo'SORRY';
}

?>
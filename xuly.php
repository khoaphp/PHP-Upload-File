<?php
//print_r( $_FILES["avatar"] );
/*
Array
(
    [name] => 42666105_2174746692743819_5761307944473853952_n.jpg
    [type] => image/jpeg
    [tmp_name] => C:\xampp\tmp\phpA97F.tmp
    [error] => 0
    [size] => 91155
)
*/ 
// 1: Phải là hình: png, jpg, jpeg, gif
// 2: Phải nhỏ hơn 5M
// 3: Random tên file -> tránh bị trùng / đè file đang có

$target_dir = "upload/";
$target_file = $target_dir . RandomChuoi(10) . "-" . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// check phai la file hinh
if(isset($_POST["btnUpload"])) {
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}

// check file size
if ($_FILES["avatar"]["size"] > 5*1*1024*1024) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// check file type
if( $imageFileType != "jpg"  && 
    $imageFileType != "png"  && 
    $imageFileType != "jpeg" && 
    $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// final 
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


function RandomChuoi($dai){
    $mang = array("a", "A",  "b", "B", "c", "d", 0, 1,2,3,4,5,6,7,8,9);
    $r = "";
    for($i=1; $i<=$dai; $i++){
        $ran = rand(0, count($mang) - 1);
        $r = $r . $mang[$ran];
    }
    return $r;
}



?>
<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "user_info";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// receiving values
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$channel_id = $_POST["channel_id"];
$time=$_POST["sendTime"];
$type = $_POST["type"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && $type == "text"){

$message = $_POST['message'];
$status= array();

    $sql = "INSERT INTO `chat` (sid,type,chat,sender_id,receiver_id,time) VALUES('$channel_id','$type','$message','$sender_id','$receiver_id','$time')";
    $result = $conn->query($sql);
    file_put_contents("test.txt","\ncheck point 1",FILE_APPEND);
if ($result == true) {
    $status["status"]= "true";
}else {
    $status["status"]= "false";
}
file_put_contents("test.txt","\ncheck point 2",FILE_APPEND);
}

elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $type == "mms") {
    $fileName = $_POST["fileName"];
    $extension = $_POST["file_extension"];

    $sql = "INSERT INTO `chat` (sid,type,file_name,extension,sender_id,receiver_id,time) VALUES('$channel_id', '$type','$fileName','$extension','$sender_id','$receiver_id','$time')";
    $result = $conn->query($sql);

    if ($result == true) {
    $status["status"]= "image added db";
}else {
    $status["status"]= "false";
}
}

echo(json_encode($status));
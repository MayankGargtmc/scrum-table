<?php

session_start();
$id=0;
$story='';
$not_started='';
$in_progress='';
$done='';
$update=false;

$mysqli= new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

if(isset($_POST['save'])){
    $story=$_POST['story'];
    $mysqli->query("INSERT INTO data (story) VALUES ('$story')") or die($mysqli->error);

    $_SESSION['message']="The new story has been saved!";
    $_SESSION['msg_type']="success";

    header("location: scrum.php");
    exit();
}   

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die(mysqli_error());

    $_SESSION['message']="The story has been deleted!";
    $_SESSION['msg_type']="warning";

    header("location: scrum.php");
    exit();
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update=true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row=$result->fetch_array();
        $story=$row['story'];
    }
}

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $story=$_POST['story'];
    $not_started=$_POST['not_started'];
    $in_progress=$_POST['in_progress'];
    $done=$_POST['done'];
    

    $mysqli->query("UPDATE data SET story='$story',not_started='$not_started',
        in_progress='$in_progress', done='$done' WHERE id=$id" ) or 
        die($mysqli->error);

    $_SESSION['message']="Record has been updated!";
    $_SESSION['msg_type']="warning";

    header('location: scrum.php');
    exit();
}

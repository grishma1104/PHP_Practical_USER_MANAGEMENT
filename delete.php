<?php
include"db.php";
session_start();
$uid=$_SESSION["uid"];
if(isset($_GET["pid"])){
    $pid=$_GET["pid"];
    $sql=$conn->prepare("Delete from products where pid=? and uid=?");
    $sql->bind_param("ii",$pid,$uid);
    if($sql->execute()){
        echo "<script>
        alert ('Product Deleted Succesfully');
        window.location.href('home.php');
        </script>";

    }
    else{
        echo "<script>
        alert ('Product Not Deleted');
        </script>";

    }
}
?>
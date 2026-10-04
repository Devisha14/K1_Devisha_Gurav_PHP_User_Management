<?php
include 'db.php';
if (isset($_GET['pid'])) {
    $pid=$_GET['pid'];
$sql=$conn->prepare("delete from products where pid=?");
$sql->bind_param("i",$pid);
if ($sql->execute()) {
    header("Location:home.php");
}
}

?>
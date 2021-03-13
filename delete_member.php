<?php
session_start();
error_reporting(0);
if($_SESSION['username']=="")
{
    header("location:login.php");
}
else{
  include("classes/mainfunctions.php");
  $obj=new maindbfunctions();
  $obj->connect();

  $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');

  $mid=$_REQUEST['val'];
  $query="update birthday set member_display_or_not= 'NO' WHERE id=$mid";
  $ans=mysqli_query($link,$query);
  echo $ans;
}
?>

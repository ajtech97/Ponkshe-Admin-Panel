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

    // $link = mysqli_connect('localhost','root','','ponkshe');
// $count=$_REQUEST['val'];
// $_SESSION['display']=$_SESSION['display']+$count;
$data='{
	"records": [';
//$counter=1;
$query=mysqli_query($link,"select * from birthday where member_display_or_not like 'YES' order by (CurrDateTime)");
while($row=mysqli_fetch_array($query))
{
    
    $mid=$row['id'];
    $name= $row['name'];
    $dob= $row['dob'];
    $email= $row['email'];
    $address=preg_replace( "/\r|\n/"," ",$row["address"]);
    $contactno= $row["contactno"];
    $memberphoto= $row["memberphoto"];

    $currdate=date("d-m-Y h:i:s A",strtotime($row['CurrDateTime']));

    $data.= '{"mid":"'.$mid.'","name":"'.ucwords($name).'","dob":"'.$dob.'","email":"'.$email.'","address":"'.$address.'","contactno":"'.$contactno.'","memberphoto":"'.$memberphoto.'","currdate":"'.$currdate.'"},';
//    $counter++;
}
$data.=']}';
$data=str_replace( '},]}', '}]}',$data);
echo $data;
}
?>

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

    $link = mysqli_connect('localhost','root','','owcc');

$data='{
	"records": [';

$query1=mysqli_query($link,"select * from  local where local_display_or_not='YES' order by booking_no desc");
while($row=mysqli_fetch_array($query1))
{
    $booking_no=$row["booking_no"];
    $name=$row["name"];
    $pickup=$row['pickup'];
    $date=$row['date'];
    $time=$row['time'];
    $car=$row['car'];
    $contactno=$row['contactno'];
    $booktime=$row['Booktime'];
    $adminkey=$row['adminkey'];

    $data.= '{"booking_no":"'.$booking_no.'","name":"'.ucwords($name).'","pickup":"'.$pickup.'","date":"'.$date.'","time":"'.$time.'",
        "car":"'.$car.'","contactno":"'.$contactno.'","booktime":"'.$booktime.'","adminkey":"'.$adminkey.'"},';
}


$data.=']}';
$data=str_replace( '},]}', '}]}',$data);
echo $data;
}
?>

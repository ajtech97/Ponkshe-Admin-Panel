<?php session_start();?>
    <?php error_reporting(0);

if($_SESSION['username']=="")
{
    header("location:login.php");   
}
else{

    include("classes/mainfunctions.php");
    $obj=new maindbfunctions();
    $obj->connect();

   $ip=$obj->ipaddress();

 date_default_timezone_set('Asia/kolkata');
                $curdate=date('Y-m-d');
                $curtime=date('H:i:s');
    

 // membername
      //       email
      //       address
      //       mobno
      //date
if(isset($_REQUEST["submit"]))
    {
        $mname=addslashes($_REQUEST["membername"]);
        $memail=$_REQUEST["email"];
        $maddress=$_REQUEST["address"];
        $mmobno=$_REQUEST["mobno"];
        $mdob=$_REQUEST["date"];

        $tablename="birthday";
        $colmob="contactno";

        $mobnoc=$obj->checkmobnoarepresentornotmember($tablename,$colmob,$mmobno);
   
    if($mobnoc=="no")
    {
        $photo=$obj->file_upload_function("memberphoto","MemberImages");
    
        $ans=$obj->insertdb("birthday","name",$mname,"dob",$mdob,"email",$memail,"address",$maddress,"contactno",$mmobno,"memberphoto",$photo,"member_display_or_not","YES","CurrDateTime",$curdate." ".$curtime,"ipaddress",$ip);
    }
    else
    {
         echo "<script>alert('Mobile No Already Exist');</script>";
    }
    
    if($ans=="yes")
    {
        echo "<script>alert('Member Added Successfully');</script>";
        echo "<script>window.location='index.php';</script>";
    }
    else
    {
        echo "<script>alert('Member Add Failed');</script>";    
        echo "<script>window.location='index.php';</script>";
    }
    }

$MId=$_REQUEST["mid"];

if(isset($_REQUEST["updatedata"]))
    {
        $mname=addslashes($_REQUEST["membername"]);
        $memail=$_REQUEST["email"];
        $maddress=$_REQUEST["address"];
        $mmobno=$_REQUEST["mobno"];
        $mdob=$_REQUEST["date"];
    
        $tablename="birthday";
        $colmob="contactno";

    $mobnoc=$obj->checkmobnoarepresentornotmember($tablename,$colmob,$mmobno);
   
    if($mobnoc=="no")
    {
        if($_FILES['memberphoto']['name']!="")
        {
        $photo=$obj->file_upload_function("memberphoto","MemberImages");
        $ans=$obj->updatememberdata($tablename,$mname,$memail,$maddress,$mmobno,$mdob,$photo,$MId);
        }
        else
        {
        $ans=$obj->updatememberdatawithoutphoto($tablename,$mname,$memail,$maddress,$mmobno,$mdob,$MId);
        }
    }
    else
    {
        echo "<script>alert('Mobile No Already Exist');</script>";
    }
    
    if($ans==1)
    {
        echo "<script>alert('Member Updated Successfully');</script>";
        echo "<script>window.location='index.php';</script>";
    }
    else
    {
        echo "<script>alert('Member Update Failed');</script>";
        echo "<script>window.location='index.php';</script>";
    }
}
}

    ?>
   
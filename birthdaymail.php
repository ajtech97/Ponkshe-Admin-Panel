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

  $mid=$_REQUEST['val'];
  $querymail= mysqli_query($link,"select name,email from birthday where id=$mid");

  $row=mysqli_fetch_array($querymail);
  $name=$row['name'];
  $email=$row['email'];

    $subject = "Happy Birthday From Ponkshe";
    $message = "Happy Birthday $name";
    $headers = ["MIME-Version: 1.0",
                "Content-type: text/plain; charset=utf-8",
                "From: info@admin@ponkshe.com"
                ];

                // $headers .= "Organization: Sender Organization\r\n";
                // $headers .= "MIME-Version: 1.0\r\n";
                // $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
                // $headers .= "X-Priority: 3\r\n";
                // $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
                // $headers .= "From: admin@ponkshe.com";
    // $headers = implode("\r\n", $headers);
    
    if(mail($email,$subject,$message,$headers)){
        echo "Mail sent successfully";
    }
    else{
        echo "Try again...";
    }

}
?>

<?php
error_reporting(0);
date_default_timezone_set('Asia/kolkata');

$link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');

class maindbfunctions
{


            function connect()
            {
                 $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                 if (!$link)
                 {
                   $msg="There is some problem with the Connection Please Check.
                   The Error is : ".mysqli_error();
                   mail("officialajinkyal@gmail.com","Dashboard Error",$msg);
                 }
            }

            function userlogin($user,$pass)
           {
               $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
               $count=0;
               $query=mysqli_query($link,"select count(*) as cou,name from users where name='$user' and pass='$pass'");
               $row=mysqli_fetch_array($query);
               $count=$row['cou'];
               if($count>0)
               {
                   return $row['name'];
               }
               else
               {
                   return "no";
               }
           }

            function ipaddress()
            {

                    if(!empty($_SERVER['HTTP_CLIENT_IP']))
                    {
                      $ip=$_SERVER['HTTP_CLIENT_IP'];
                    }
                    elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
                    {
                          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                    }
                    else
                    {
                          $ip=$_SERVER['REMOTE_ADDR'];

                    }
                    return $ip;
            }



      function insertdb()
      {
          /*
          first argument is table name and then column name , value
          Eg. ...->insertdb('tablename','column_name1','value1','column_name2','value2');
          */
        $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');

        $j = 0;
        $col = '';
        $val = '';
        $info = func_get_args();
        $num = func_num_args();

        $table = "`" . $info[0] . "`";

        for ($j = 1; $j < $num; $j++) {
            if (($j % 2) == 0) {
                $val = $val . "'" . $info[$j] . "',";
            }
            if (($j % 2) == 1) {

                $col = $col . "`" . $info[$j] . "`,";
            }
        }
        $val = rtrim($val, ",");
        $col = rtrim($col, ",");
        // echo "insert into $table($col) values($val)";
        $ans=mysqli_query($link,"insert into $table($col) values($val)");
          if($ans==1)
          {
              return  "yes";
          }
          else
          {
              return "no";
          }
    }

    //Account Setting

                function checkrecorsarepresentornot($tablename,$columnname,$value)
                {
                        $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                        $count=0;
                        $query=mysqli_query($link,"select count(*) as cou from ".$tablename." where ".$columnname."='".$value."'");
                        $row=mysqli_fetch_array($query);
                        $count=$row['cou'];
                        if($count>0)
                        {
                            return "yes";
                        }
                        else
                        {
                            return "no";
                        }
                }

                function updatepass($tablename,$name,$rnpass,$mob,$anomob,$email,$address,$curdate,$curtime,$ip)
                {
                  $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                  $query=mysqli_query($link,"update ".$tablename." set name='$name',pass='$rnpass',mobileno='$mob',anothermobileno='$anomob',address='$address',emailid='$email',currdatetime='$curdate $curtime',ipaddress='$ip' where uid=1");
                    if($query==1)
                    {
                        return "yes";
                    }
                    else
                    {
                        return "no";
                    }
                }

                function localadminkeystarting()
                {
                    $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                    $query=mysqli_query($link,"select adminkey from local");
                    $row1=mysqli_fetch_array($query);
                    $adminkey=$row1['adminkey'];
                    if($adminkey=="")
                    {
                        $aksno=mysqli_query($link,"select * from adminkeystarting");
                        $row2=mysqli_fetch_array($aksno);
                        $serno=$row2['local'];

                    }
                    else
                    {
                        $alinno=mysqli_query($link,"select adminkey from local order by booking_no desc");
                        $row3=mysqli_fetch_array($alinno);
                        $serno=$row3['adminkey'];
                        $serno++;
                    }
                    return $serno;
                }


                //Member
                function checkmobnoarepresentornotmember($tablename,$colmob,$value)
                {
                    $link = mysqli_connect('localhost','root','','ponkshe');
                    $count=0;
                    $query=mysqli_query($link,"select count(*) as cou from ".$tablename." where ".$colmob."='".$value."' and member_display_or_not='YES'");
                    $row=mysqli_fetch_array($query);
                    $count=$row['cou'];
                    if($count>0)
                    {
                        return "yes";
                    }
                    else
                    {
                        return "no";
                    }
                }

                function checkmobnoarepresentornotmemberupdate($tablename,$colmob,$value,$MId)
                {
                    $link = mysqli_connect('localhost','root','','ponkshe');
                    $count=0;
                    $query=mysqli_query($link,"select count(*) as cou from ".$tablename." where ".$colmob."='".$value."' and id<>'$MId' and member_display_or_not='YES'");
                    $row=mysqli_fetch_array($query);
                    $count=$row['cou'];
                    if($count>0)
                    {
                        return "yes";
                    }
                    else
                    {
                        return "no";
                    }
                }

                function file_upload_function($file,$foldername)
                {
                $_FILES["'.$file.'"];
                $errors= array();
                $file_name = $_FILES["$file"]["name"];
                $file_size =$_FILES["$file"]["size"];
                $file_tmp =$_FILES["$file"]["tmp_name"];
                $file_type=$_FILES["$file"]["type"];
                //***********************************************************************
                $target_dir = $foldername."/";
                $target_file = $target_dir . basename($_FILES["$file"]["name"]).$file_name;
                //***********************************************************************
                $file_ext=strtolower(end(explode('.',$_FILES["$file"]["name"])));

                $expensions= array("jpg","jpeg","png","PNG","JPEG","JPG");
                if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPG or JPEG or PNG file.";
                }
                if ($_FILES["$file"]["size"] > 2097152) {
                $errors[]='File size must be less than 2 MB';
                }
                // if($file_size > 2097152){
                // echo "hhhiiiiiiiiiii";
                // $errors[]='File size must be less than 2 MB';
                // }
                date_default_timezone_set("Asia/Kolkata");
                $currdate=date('Y')."_".date('d')."_".date('m');
                $currtime=date('H')."_".date('i')."_".date('s');
                $f_name=$currdate."_".$currtime."_".$file_name;
                if(empty($errors)==true)
                {
                if (move_uploaded_file($file_tmp,$target_dir.$f_name))
                {
                $errors[]=$f_name;
                }
                else
                {
                $errors[]="Sorry, there was an error uploading your file.";
                }
                }
                return $errors[0];
                }

                function updatememberdata($tablename,$mname,$memail,$maddress,$mmobno,$mdob,$photo,$MId)
                {
                    $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                    $query=mysqli_query($link,"update ".$tablename." set name='$mname',dob='$mdob',email='$memail',address='$maddress',contactno='$mmobno',memberphoto='$photo' where id='$MId'");
                    return $query;
                }
                function updatememberdatawithoutphoto($tablename,$mname,$memail,$maddress,$mmobno,$mdob,$MId)
                {
                    $link = mysqli_connect('localhost','ponkshe_fam','y)U[#DYPg#uI','ponkshe_ponkweb');
                    $query=mysqli_query($link,"update ".$tablename." set name='$mname',dob='$mdob',email='$memail',address='$maddress',contactno='$mmobno' where id='$MId'");
                    return $query;
                }

}



?>
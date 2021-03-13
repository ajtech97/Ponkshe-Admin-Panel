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


?>
<!doctype html>
<html lang="en" ng-app="myapp" ng-controller="myctrl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <title>Today's Birthday</title>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <!-- <link rel="icon" sizes="192x192" href="images/android-desktop.png"> -->

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Material Design Lite">
  <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
  <meta name="msapplication-TileColor" content="#3372DF">

  <link rel="shortcut icon" href="images/favicon1.png">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
  <link rel="stylesheet" href="css/styles.css">

  <script src="js/angular.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/materialmain.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/my.css">
  <link rel="stylesheet" href="css/scrollbar.css">
  <!-- <link rel="stylesheet" href="css/materialblue.css"> -->

  <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }

    .menu2 {
      background-color: #00BCD4;
    }

    .menuname2 {
      color: #37474F;

    }

    table {
      width: 100%;
      table-layout: fixed;
    }

    .tbl-content {
      height: auto;
      width: 100%;
      max-height: 343px;
      overflow-x: auto;
      margin-top: 0px;
      background-color: #64B5F6;
    }

    #pic{
            height: 150px;
            width: 150px;
            background-repeat: no-repeat;
            background-size: 100% 100%;
}
  </style>

  <script>
    function sendmailmember(val) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
              alert(this.responseText);
            } else {
              alert(this.responseText);
            }
          }
        };
        xmlhttp.open("GET", "birthdaymail.php?val=" + val, true);
        xmlhttp.send();
    }

    
  </script>

</head>


<body>

  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Today's Birthday</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
          <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
            <i class="material-icons">search</i>
          </label>
          <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" id="search" ng-model="search">
            <label class="mdl-textfield__label" for="search">Enter your query...</label>
          </div>
        </div>

      </div>
    </header>

    <?php include "nav.php"; ?>

    <main class="mdl-layout__content mdl-color--grey-100">
      <!-- <input type="hidden" id="setmob" value="">
      <input type="hidden" id="setemail" value=""> -->

      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--5-col"></div>

        <div class="mdl-cell mdl-cell--6-col">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="searchbox" ng-model="search">
            <label class="mdl-textfield__label" for="searchbox">Search by Name</label>
          </div>
        </div>
      </div>

      <center>
        <h4 class="custnotfound">Oops... No Birthday Found!</h4>
      </center>

      <br>
      <br>
      <br>
      <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%;">
        <thead>
          <tr>
            <th class="mdl-data-table__cell--non-numeric">Sr No</th>
            <th class="mdl-data-table__cell--non-numeric">Member Name</th>
            <th class="mdl-data-table__cell--non-numeric">Contact No</th>
            <th class="mdl-data-table__cell--non-numeric">DOB</th>
            <th class="mdl-data-table__cell--non-numeric">Email</th>
            <th class="mdl-data-table__cell--non-numeric">Address</th>
            <th class="mdl-data-table__cell--non-numeric">Send Mail</th>
          </tr>

        </thead>
      </table>
      <div class="tbl-content">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%;">
          <tbody>

            <tr ng-repeat="x in con  | filter:search " class="ng-scope" ng-model="search">

              <!-- id
name
dob
email
address
contactno
memberphoto
currdate -->
              <input type="hidden" id="tblmid{{x.mid}}" value="{{x.mid}}">
              <input type="hidden" id="tblname{{x.mid}}" value="{{x.name}}">
              <input type="hidden" id="tbldob{{x.mid}}" value="{{x.dob}}">
              <input type="hidden" id="tblemail{{x.mid}}" value="{{x.email}}">
              <input type="hidden" id="tbladdress{{x.mid}}" value="{{x.address}}">
              <input type="hidden" id="tblcontactno{{x.mid}}" value="{{x.contactno}}">
              <input type="hidden" id="tblmemberphoto{{x.mid}}" value="{{x.memberphoto}}">
              

              <td data-label="Sr No" class="mdl-data-table__cell--non-numeric ng-binding">{{$index + 1}}</td>
              <td data-label="Name" class="mdl-data-table__cell--non-numeric ng-binding">{{x.name}}</td>
              <td data-label="Contact No" class="mdl-data-table__cell--non-numeric ng-binding">{{x.contactno}}</td>
              <td data-label="DOB" class="mdl-data-table__cell--non-numeric ng-binding">{{x.dob}}</td>
              <td data-label="Email" class="mdl-data-table__cell--non-numeric ng-binding">{{x.email}}</td>
              <td data-label="Address" class="mdl-data-table__cell--non-numeric ng-binding">{{x.address}}</td>

              <td data-label="Send Mail" class="mdl-data-table__cell--non-numeric ng-binding">
                <button class="mdl-button mdl-js-button mdl-button--fab  mdl-button--colored asssignbtn"
                  title="Send Mail" onclick='sendmailmember(this.id)' id="{{x.mid}}" for="sendmailmember">
                  <div class="mdl-tooltip mdl-tooltip--large" for="sendmailmember">Send Mail</div>
                  <i class="material-icons" id="sendmailmember" style="outline:none">email</i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

     
    </main>
  </div>
  <script>
    

    function fillvalues(val) {
      id = val;
      document.getElementById("mid").value = document.getElementById("tblmid" + id).value;
      document.getElementById("membername").value = document.getElementById("tblname" + id).value;
      document.getElementById("email").value = document.getElementById("tblemail" + id).value;
      document.getElementById("address").value = document.getElementById("tbladdress" + id).value;
      document.getElementById("mobno").value = document.getElementById("tblcontactno" + id).value;
      document.getElementById("date").value = document.getElementById("tbldob"+ id).value;
      document.getElementById("photo").innerHTML = document.getElementById("tblmemberphoto" + id).value;
      var pic = document.getElementById("tblmemberphoto" + id).value;
      document.getElementById("pic").style.backgroundImage = "url('MemberImages/"+pic+"')";
      

    }

  </script>

  <script>
    var cont = 0;
    var x = angular.module("myapp", []);
    x.controller("myctrl", function ($scope, $http, $interval) {
      $scope.getData = function () {
        $http.get('birthdayjson.php').success(function (data) {

          $scope.con = data.records;


          if (data.records == "") {
            $("#newcallstable").fadeOut();
            $(".custnotfound").fadeIn();


          } else {
            $("#newcallstable").fadeIn();
            $(".custnotfound").fadeOut();
          }
          console.log(data.records);
        });
      };


      //                    $scope.intervalFunction = function() {
      //                        $interval(function() {
      //                            $scope.getData();
      //
      //                        }, 5000)
      //                    };

      $scope.getData();
      //                    $scope.intervalFunction();

      //            var pagesShown = 1;
      //            var pageSize = 10 ;
      //
      //            $scope.paginationLimit = function (x) {
      //                return pageSize * pagesShown;
      //            };
    });
  </script>
  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  

  <!-- <script src="js/main.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

</body>

</html>
<?php }?>
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
  <title>Members</title>

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

    .menu1 {
      background-color: #00BCD4;
    }

    .menuname1 {
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
    function deletemember(val) {
      if (confirm("If you want to delete then press 'Ok'..!")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
              alert("Deleted successfully");
            } else {
              alert("Try again...");
            }
          }
        };
        xmlhttp.open("GET", "delete_member.php?val=" + val, true);
        xmlhttp.send();
      }
    }

    function valid() {
      var membername = document.getElementById("membername").value;
      var email = document.getElementById("email").value;
      var address = document.getElementById("address").value;
      var mobno = document.getElementById("mobno").value;
      var date = document.getElementById("date").value;

      if (membername == "") {
        alert("Please Enter Member Name");
        document.getElementById("membername").focus();
        return false;
      }
      if (email == "") {
        alert("Please Enter Email Id");
        document.getElementById("email").focus();
        return false;
      }
      if (address == "") {
        alert("Please Enter Address");
        document.getElementById("address").focus();
        return false;
      }
      if (mobno.length!=10) {
        alert("Please Enter 10 Digit Mobile No");
        document.getElementById("mobno").focus();
        return false;
      }
      if (date == "") {
        alert("Please Enter DOB");
        document.getElementById("date").focus();
        return false;
      }

    }
    
  </script>

</head>


<body>

  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Add Member</span>
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
      <input type="hidden" id="setmob" value="">
      <input type="hidden" id="setemail" value="">

      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--4-col"></div>

        <div class="mdl-cell mdl-cell--6-col">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="searchbox" ng-model="search">
            <label class="mdl-textfield__label" for="searchbox">Search by Name</label>
          </div>
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored asssignbtn"
            onclick='openopup(this.id,"insert")' for="tt2" id="addpurbtn">
            <div class="mdl-tooltip mdl-tooltip--large" for="tt2">Add Member</div>
            <i class=" material-icons" id="tt2" style="align:center;outline:none;">person_add</i>
          </button>
        </div>
      </div>

      <center>
        <h4 class="custnotfound">Oops... No Member Found!</h4>
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
            <th class="mdl-data-table__cell--non-numeric">Edit/View</th>
            <th class="mdl-data-table__cell--non-numeric">Delete</th>
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

              <td data-label="Edit/View" class="mdl-data-table__cell--non-numeric ng-binding">
                <button class="mdl-button mdl-js-button mdl-button--fab  mdl-button--colored asssignbtn"
                  title="Edit/View Member" onclick='editdata(this.id,"update")' id="{{x.mid}}" for="kkk">
                  <div class="mdl-tooltip mdl-tooltip--large" for="kkk">Edit/View Member</div>
                  <i class="material-icons" id="kkk" style="outline:none">edit</i>
                </button>
              </td>

              <td data-label="Delete" class="mdl-data-table__cell--non-numeric ng-binding">
                <button class="mdl-button mdl-js-button mdl-button--fab  mdl-button--colored asssignbtn"
                  title="Delete Member" onclick='deletemember(this.id)' id="{{x.mid}}" for="deletemember">
                  <div class="mdl-tooltip mdl-tooltip--large" for="deletemember">Delete Member</div>
                  <i class="material-icons" id="deletemember" style="outline:none">delete</i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <dialog class="mdl-dialog">
        <form method="post" action="addmemberinsertupdate.php" onsubmit="return valid();" enctype="multipart/form-data">

          <h4 id="membertxt">Add Member</h4>

          <hr>
          <input type="hidden" name="mid" id="mid">

          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" name="membername" id="membername" placeholder=""
                  required>
                <label class="mdl-textfield__label" for="productname">Member Name*</label>

              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="email" name="email" id="email" placeholder="" required>
                <label class="mdl-textfield__label" for="email">Email*</label>

              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <textarea class="mdl-textfield__input" id="address" name="address" placeholder="" required rows="1.5"
                  cols="100" required></textarea>
                <label class="mdl-textfield__label" for="address">Address*</label>

              </div>
            </div>
          </div>

          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" name="mobno" id="mobno" placeholder="" maxlength="10"
                  onkeypress='return event.charCode >=48 && event.charCode<=57' required>
                <label class="mdl-textfield__label" for="mobileno">Mobile Number*</label>

              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="date" name="date" id="date" placeholder="" required>
                <label class="mdl-textfield__label" for="date">DOB*</label>

              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="file" name="memberphoto" id="photo" placeholder="" value="">
                <label class="mdl-textfield__label" for="photo">Photo</label>

              </div>

              <div id="pic">

              </div>
            </div>
          </div>

          <hr>

          <div class="mdl-dialog__actions" id="btnaction">

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored forwhitecolor"
              onclick="colsepup()" type="button">

              <i class="material-icons forwhitecolor">close</i> Close

            </button>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored forwhitecolor" type="submit"
              value="submit" id="insertdata" name="submit">
              <i class="material-icons forwhitecolor">send</i>Add
            </button>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored forwhitecolor" type="submit"
              value="update" id="updatedata" name="updatedata">
              <i class="material-icons forwhitecolor">send</i>Update
            </button>

          </div>

        </form>
      </dialog>
    </main>
  </div>
  <script>
    function colsepup() {

      // membername
      //       email
      //       address
      //       mobno
      //date
      //photo
      dialog.close();
      document.getElementById("mid").value = "";
      document.getElementById("membername").value = "";
      document.getElementById("email").value = "";
      document.getElementById("address").value = "";
      document.getElementById("mobno").value = "";
      document.getElementById("date").value = "";
      document.getElementById("photo").value = "";
      document.getElementById("insertdata").style.visibility = "visible";
      document.getElementById("updatedata").style.visibility = "visible";
      document.getElementById("pic").style.backgroundImage = "";

      document.getElementById("membertxt").innerHTML = document.getElementById("membertxt").innerHTML.replace(
        'Update Member Information', 'Add Member');

    }

    function openopup(val, val2) {
      if (val2 == "insert") {
        dialog.showModal();
        document.getElementById("updatedata").style.visibility = "hidden";
        document.getElementById("pic").style.backgroundImage = "";
      }

    }
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#show-dialog');
    if (!dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function () {
      dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function () {
      dialog.close();
    });


    function editdata(val, val1) {
      if (val1 == "update") {
        dialog.showModal();
        fillvalues(val);
        document.getElementById("insertdata").style.visibility = "hidden";
        document.getElementById("membertxt").innerHTML = document.getElementById("membertxt").innerHTML
          .replace('Add Member', 'Update Member Information');

      }
    }

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
        $http.get('addmemberjson.php').success(function (data) {

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
<!DOCTYPE html>
<html>
<?php
    require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $pickQuery = mysqli_query($conn,"SELECT * FROM login");
  
  if(isset($_GET['loginId']))
  {
    echo "string";
    $loginId = $_GET['loginId'];
    $query="DELETE FROM login where loginId=$loginId;";
    $result = $conn->query($query);
    header("Refresh:0; url=adminAddDeleteUser.php");
  }
  if (isset($_GET['userName']) && isset($_GET['password'])) {
      $userName = $_GET['userName'];
      $password = $_GET['password'];

    $query="INSERT INTO login(`userName`, `password`) VALUES ('$userName', '$password');";
    $result = $conn->query($query);
    header("Refresh:0; url=adminAddDeleteUser.php");
  }
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paradise Admin</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <script src="../js/index.js"></script>
    <style type="text/css">
        table
        {
            border-collapse: collapse;
            width: 60%;
            margin: auto;
        }
        th, td
        {
            text-align: left;
            padding: 8px;
            text-align: center;
            font-size: 120%;
        }
        tr
        {
            background-color: #8998A3;
        }
        tr:hover
        {
            filter: brightness(85%);
        }
        th{
            background-color: #214761;
            color: white;
        }
        /* style the submit button */
        input[type=submit] {
          background-color: #214761;
          color: white;
          cursor: pointer;
          width: 50%;
          padding: 5px;
        }

        input[type=submit]:hover {
          background-color: #060638;
        }
    </style>
</head>
<body>
     
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">              
                <span class="logout-spn" >
                  <a href="admin.php" style="color:#fff;">LOGOUT</a>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
   
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" style="margin: 0;">
        <button type="button" style="color:white; background-color: #214761;margin-top: 40px;float: left;padding: 10px 20px;font-weight: bold;font-size: 17px;" onclick="location.href = 'adminMainMenu.php'"> Back to Main Menu </button>
        <br><h2 style="text-align: center; font-weight: bold; color: #214761; width: 85%;">Add/Delete User</h2>


        <div style="text-align: center;margin-top: 10%;">
            
                <?php 
                    $headers = "<th> Id </th> <th> Username </th> <th> Password </th> <th> Delete </th>";
                    $col = "";
                    while ($pickResults = mysqli_fetch_assoc($pickQuery)) {
                        $loginId=$pickResults['loginId'];
                        $col .= "<tr><td> {$loginId} </td>";
                        $col .= "<td> {$pickResults['userName']} </td>";
                        $col .= "<td> {$pickResults['password']} </td>";
                        $col .= "<td>
                                <form action='adminAddDeleteUser.php' target='post'>
                                    <input type='hidden' name='loginId' value='$loginId'> </input> 
                                    <input type='submit' value='Delete' > </input>
                                </form>
                                </td>";
                    }
                    echo "<table> <tr>$headers</tr><tr>$col</tr></table>";
                ?>

          </div>


          <div style="float: right;">
            <button type="button" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;" onclick="openForm()"> Add user</button>
          </div>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
    </div>
          
<div class = "bg-modal">
    <div class = "modal-contents">
          <div onclick="closeForm()" class = "close">+</div>
              <form action="adminAddDeleteUser.php" target="post">
                <div class="w3-row-padding" style="margin:0 -16px;">
                    <br><br>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i>Username</label>
                    <input class="w3-input w3-border"  style="width: 80%; border: 1px solid black;" type="text" name="userName" required>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i>Password</label>
                    <input class="w3-input w3-border"  style="width: 80%; border: 1px solid black;" type="text" name="password" required>
                  </div>
                </div>
                
                <button type="submit" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;">Add </button>
              </form>
    </div>
  </div>
   
</body>
</html>

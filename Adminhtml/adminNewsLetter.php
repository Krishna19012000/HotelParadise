<!DOCTYPE html>
<html>
<?php
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $pickQuery = mysqli_query($conn,"SELECT * FROM newsletter");

  if(isset($_GET['sendEmail']))
  {
    $sendEmail = $_GET['sendEmail'];
    $subject = "Paradise Newsletter";
    $message = "Welcome to Paradise Hotel.";
    if($sendEmail == 1)
    {
        while ($pickResults = mysqli_fetch_assoc($pickQuery)) {
            mail($pickResults['subscriptionEmail'],$subject,$message);
        }
        echo "<script>alert(\"Newsletter has been sent\")</script>";
        header("Refresh:0; url=adminNewsLetter.php");
    }
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
        <br><h2 style="text-align: center; font-weight: bold; color: #214761; width: 85%;">NewsLetter</h2>

        <div style="text-align: center;margin-top: 10%;">
            
                <?php 
                    $headers = "<th> Email </th> <th> Subscription Date/Time </th>";
                    $col = "";
                    while ($pickResults = mysqli_fetch_assoc($pickQuery)) {
                        $col .= "<tr><td> {$pickResults['subscriptionEmail']} </td>";
                        $col .= "<td> {$pickResults['createdDate']} </td>";
                    }
                    echo "<table> <tr>$headers</tr><tr>$col</tr></table>";
                ?>

          </div>


          <div style="float: right;">
            <form action="adminNewsLetter.php" target='post'> 
                <button type="submit" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;" name="sendEmail" value="1"> Send Newsletter </button>
            </form>
           
          </div>

        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
        </div>
          
</body>
</html>

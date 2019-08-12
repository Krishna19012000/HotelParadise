<!DOCTYPE html>
<html>
<?php
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $pickQuery = mysqli_query($conn,"SELECT DISTINCT roomDescription, COUNT(*) FROM `room` GROUP BY roomDescription");

  if(isset($_GET['delete'])) {
    $deleteRoom = $_GET['deleteRoom'];
    if(mysqli_query($conn,"DELETE FROM room WHERE roomId = '$deleteRoom';")){
        echo "<script> alert('Room Deleted'); </script>";
    }
    header("Refresh:0; url=adminRooms.php");
  }

  if(isset($_GET['roomDescription']) &&
     isset($_GET['type'])  &&
     isset($_GET['beds']) &&
     isset($_GET['price'])  &&
     isset($_GET['status']) &&
     isset($_GET['tv'])  &&
     isset($_GET['kitchen']) &&
     isset($_GET['bar'])
     ){
    $roomDescription = $_GET['roomDescription'];
    $type = $_GET['type'];
    $beds = $_GET['beds'];
    $price = $_GET['price'];
    $status = $_GET['status'];
    $tv = $_GET['tv'];
    $kitchen = $_GET['kitchen'];
    $bar = $_GET['bar'];
    if(mysqli_query($conn,"INSERT INTO room (`roomDescription`, `type`, `beds`, `price`, `status`, `tv`, `kitchen`, `bar`) VALUES
                           ('$roomDescription', '$type', $beds, $price, '$status', $tv, $kitchen, $bar);")){
        echo "<script> alert('Room Inserted'); </script>";
    }
    else
    {
        echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }
    header("Refresh:0; url=adminRooms.php");
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
    <script type="text/javascript">
     function openForm1()
      {
        document.querySelector(".bg-modal1").style.display = "flex";
      }
      function closeForm1()
      {
        document.querySelector(".bg-modal1").style.display = "none";
      }
    </script>
    <style type="text/css">

        .bg-modal1 {
            display: none;
            background-color: rgba(0, 0, 0, 0.8);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 10%;
            justify-content: center;
            align-items: center;
        }
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
          
            <br><h2 style="text-align: center; font-weight: bold; color: #214761; width: 85%;">Rooms</h2>

            <br><h4 style="font-weight: bold; color: #214761; padding-left: 20%;">List of Rooms</h4>
            <div style="text-align: center;">
                <?php 
                    $headers = "<th> Rooms </th> <th> Available </th>  <th> Occupied </th>";
                    $col = "";
                    while ($pickResults = mysqli_fetch_assoc($pickQuery)) {
                        $desc = $pickResults['roomDescription'];
                        $col .= "<tr><td> {$pickResults['roomDescription']} </td>";

                        $availableQuery = "SELECT COUNT(*) FROM room WHERE roomDescription='$desc' AND status='Available'";
                        $occupiedQuery = "SELECT COUNT(*) FROM room WHERE roomDescription='$desc' AND status!='Available'";
                        #echo $availableQuery;
                        $availableResult = $conn->query($availableQuery);
                        $occupiedResult = $conn->query($occupiedQuery);
                        #echo $availableResult;
                        $available = $availableResult->fetch_assoc();
                        $Occupied = $occupiedResult->fetch_assoc();
                        #echo $available['COUNT(*)'];
                        $col .= "<td> {$available['COUNT(*)']} </td>";
                        $col .= "<td> {$Occupied['COUNT(*)']} </td></tr>";
                    }
                    echo "<table> <tr>$headers</tr><tr>$col</tr></table>";
                ?>
            </div>

            <div style="float: right;">
                <button type="submit" onclick="openForm()" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;" name="addRoom" value="1"> Add Room </button>
                <button type="submit" onclick="openForm1()" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;" name="deleteRoom" value="1"> Delete Room </button>
            </div>

        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
        </div>
          
<div class = "bg-modal">
    <div class = "modal-contents"  style="height: 500px;">
          <div onclick="closeForm()" class = "close">+</div>
              <form action="adminRooms.php" target="post">
                <div class="w3-row-padding" style="margin:0 -16px;"><h3>Add Room</h3>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i>Room Description</label>
                    <input class="w3-input w3-border"  style="width: 70%; border: 1px solid black;" type="text" name="roomDescription" placeholder="Eg: Classic King room, Mid Floor, Balcony, Beach View" required>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i>Type</label>
                    <select name="type"> <option>SingleRoom</option><option>DoubleRoom</option><option>DeluxeRoom</option> </select>
                  </div>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i>Beds</label>
                    <select name="beds"> <option>1</option><option>2</option><option>3</option></select>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i>Price</label>
                    <input class="w3-input w3-border"  style="width: 70%; border: 1px solid black;" type="number" name="price" placeholder="Eg: 50" required>
                  </div>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i>Status</label>
                    <select name="status"> <option>Available</option><option>Occupied</option> </select>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i>Tv</label>
                    <select name="tv"> <option>0</option><option>1</option> </select>
                  </div>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i>Kitchen</label>
                    <select name="kitchen"> <option>0</option><option>1</option> </select>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i>Bar</label>
                    <select name="bar"> <option>0</option><option>1</option> </select>
                  </div>
                </div>
                
                <button type="submit" name="add" value="Add Room" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;">Add </button>
              </form>
    </div>
</div>

<div class = "bg-modal1">
    <div class = "modal-contents" >
          <div onclick="closeForm1()" class = "close">+</div>
              <form action="adminRooms.php" target="post">
                <div class="w3-row-padding" style="margin:0 -16px;"><h3>Delete Room</h3><br><br>
                  <div class="w3-half" style="font-size: 130%;">
                    <label><i class="fa fa-calendar-o"></i>Select Room to delete: </label>
                    <select name="deleteRoom">
                        <?php
                            $deleteRoomQuery = mysqli_query($conn,"SELECT roomDescription, roomId FROM room;");
                            while ($pickResults = mysqli_fetch_assoc($deleteRoomQuery)) { ?>
                                <option value='<?php echo $pickResults["roomId"]; ?>'><?php echo $pickResults["roomDescription"]; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                  </div>
                </div>
                <button type="submit" name="delete" value="Delete Room" style="color:white; background-color: #214761;margin-top: 40px;padding: 10px 20px;font-weight: bold;font-size: 17px;">Delete</button>
              </form>
    </div>
</div>
   
</body>
</html>
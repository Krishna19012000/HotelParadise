<!DOCTYPE html>
<html>

<?php
    require_once '../login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $pickQuery = mysqli_query($conn,"SELECT DISTINCT status, COUNT(*) FROM `room` GROUP BY status");
    $trying = "[";
    while ($pickResults = mysqli_fetch_assoc($pickQuery)) {
        $status = $pickResults['status'];
        if($trying != "[")
            $trying .= ", ";
        $trying .= "['" . "{$pickResults['status']}" . "', ";

        $availableQuery = "SELECT COUNT(*) FROM room WHERE status='$status'";
        $availableResult = $conn->query($availableQuery);
        $available = $availableResult->fetch_assoc();
        $tem = $available["COUNT(*)"];
        $trying .= "$tem";
        $trying .= "]";
    }
    $trying .= "]"; 
    #$trying = "[['Available', 3], ['Occupied', 1]]";


    $pickQuery2 = mysqli_query($conn,"SELECT DISTINCT type, COUNT(*) FROM `room` GROUP BY type");
    $trying2 = "[";
    while ($pickResults2 = mysqli_fetch_assoc($pickQuery2)) {
        $type = $pickResults2['type'];
        if($trying2 != "[")
            $trying2 .= ", ";
        $trying2 .= "['" . "{$pickResults2['type']}" . "', ";

        $availableQuery2 = "SELECT COUNT(*) FROM room WHERE type='$type'";
        $availableResult2 = $conn->query($availableQuery2);
        $available2 = $availableResult2->fetch_assoc();
        $tem2 = $available2["COUNT(*)"];
        $trying2 .= "$tem2";
        $trying2 .= "]";
    }
    $trying2 .= "]"; 
    #$trying2 = "[['Available', 3], ['Occupied', 1]]";
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
        .flexContainer {
          display: flex;
          flex-wrap: wrap;
          align-content: space-between;
          background-color: #214761;
        }

        .flexContainer > div {
          background-color: #f1f1f1;
          margin: 20px auto;
          text-align: center;
          line-height: 75px;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Number');

        var myVal = "<?php echo $trying; ?>";
        //alert(myVal);

        data.addRows(
          <?php echo $trying; ?>
        );

        // Set chart options
        var options = {'title':'Statistics of Rooms Available and Empty',
                       'width':550,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      function drawChart1() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Number');

        var myVal = "<?php echo $trying; ?>";
        //alert(myVal);

        data.addRows(
          <?php echo $trying2; ?>
        );

        // Set chart options
        var options = {'title':'Statistics of Rooms Available and Empty',
                       'width':550,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
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
        <br><h2 style="text-align: center; font-weight: bold; color: #214761; width: 85%;">Reports</h2><br>
        <div class="flexContainer">
            <div id="chart_div" ></div>
            <div id="chart_div2" ></div>
        </div>
        

        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
        </div>
          

   
</body>
</html>

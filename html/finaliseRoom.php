<!DOCTYPE html>
<html>
<?php 
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_GET['roomId'])     &&
      isset($_GET['CheckIn'])    &&
      isset($_GET['CheckOut'])   &&
      isset($_GET['adults'])     &&
      isset($_GET['kids'])       &&
      isset($_GET['breakfast']))
  {
    $roomId    = $_GET['roomId'];
    $checkIn   = $_GET['CheckIn'];
    $checkOut  = $_GET['CheckOut'];
    $adults    = $_GET['adults'];
    $kids      = $_GET['kids'];
    $breakfast = $_GET['breakfast'];
    $roomDescription = $_GET['roomDescription'];
    $price = 0;

    $date1 = "$checkIn"; 
    $date2 = "$checkOut"; 
      
    $dateTimestamp1 = strtotime($date1); 
    $dateTimestamp2 = strtotime($date2); 
    $currentDate = date('m/d/Y');
    $currentStringDate = strtotime($currentDate); 

    if ($dateTimestamp1 >= $dateTimestamp2){
        echo "<script> 
                alert('CheckOut date cannot be on or before the CheckIn date.'); 
                window.location.href='index.php';
              </script>";
      }
       
    if($dateTimestamp1 > $currentDate)
    {
       echo "<script> 
                alert('CheckIn date cannot be before today's date.'); 
                window.location.href='index.php';
              </script>";
    }   

    if ($breakfast == 1) {
      $price = $_GET['price'] + 20;
    } else {
      $price = $_GET['price'];
    }

  }
  else
  {
    echo "Please fill out the required details and then come to this page";
    header("Location: index.php");
  }
  if(isset($_GET['diffDays']))
  {
    $diffDays = $_GET['diffDays'];
    $priceForNoOfNights = $price * $diffDays;
    $serviceCharge = $priceForNoOfNights * 0.10;
    $totalTax = $priceForNoOfNights * 0.13;
    $totalPrice = $priceForNoOfNights + $serviceCharge + $totalTax;
    $cancellationFee = $totalPrice * 0.8;
  }
 
    $imageName = $_GET['imageName'];
?>

<title>Paradise</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../js/index.js"></script>
<script type="text/javascript">

  function callThis()
  {
    <?php if(!isset($_GET['diffDays'])){?>

    var date3 = new Date("<?php echo $checkIn ?>");
    var date4 = new Date("<?php echo $checkOut ?>");

    var diffTime = Math.abs(date4.getTime() - date3.getTime());
    var diffDays = Math.ceil(diffTime/(1000 * 60 * 60 * 24));

    var url = window.location.href;
    var myURL=url.concat("&diffDays=").concat(diffDays);
    window.location.href = myURL;
    <?php } ?>
  }

</script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>

<body class="w3-light-grey" onload="callThis()">

<!-- Navigation Bar -->
<div style="background-color: grey; color: white; ">
  <div style="text-align:center; ">
    <h3>Paradise Hotel</h3>
  </div>
  <div class="w3-row-padding w3-large w3-center">
    <div class="w3-third"><i class="fa fa-map-marker w3-text-red"></i> 423 Some adr, Toronto, ON Canada</div>
    <div class="w3-third"><i class="fa fa-phone w3-text-red"></i> Phone: +1 (999) 999-9999</div>
    <div class="w3-third"><i class="fa fa-envelope w3-text-red"></i> Email: hotelparadise012@gmail.com</div>
  </div>
</div>
<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px;">
  <br>
  <div class="allInfoDisplay">
    <div class="leftAllInfoDisplay">
      <div>
        Dates<br>
        <b><?php echo "$checkIn" . " - " . "$checkOut"; ?></b>
      </div>
      <div>
        Guests<br>
        <b><?php echo "$adults" . " Adults, " . "$kids" ." Kids"; ?></b>
      </div>
      <div>
        Total for stay<br>
        <b><?php echo $totalPrice; ?>USD</b>
      </div>
    </div>
    <div class="rightAllInfoDisplay" >
      <form action="customerInfo.php" target="POST">
        <input type="hidden" name="roomId" value="<?php echo "$roomId"; ?>">
        <input type="hidden" name="CheckIn" value="<?php echo "$checkIn"; ?>">
        <input type="hidden" name="CheckOut" value="<?php echo "$checkOut"; ?>">
        <input type="hidden" name="adults" value="<?php echo "$adults"; ?>">
        <input type="hidden" name="kids" value="<?php echo "$kids"; ?>">
        <input type="hidden" name="breakfast" value="0">
        <input type="hidden" name="totalPrice" value="<?php echo "$totalPrice"; ?>">
        <input type="hidden" name="cancellationFee" value="<?php echo "$cancellationFee"; ?>">
        <input type="submit" name="select" class="SelectButton" value="Continue" style="background-color: darkblue;"/>
      </form>
      
    </div>
  </div>
<br>
  <div class="flexContainer">
    <div class="col-md-4">  
      <div style="background-color:white; border-radius:5px; padding:16px; height:760px">  
          <h2 class="text-info" style="text:align:left; font-weight: bold">Review Reservation Details</h2>
          <div class="flexSelectRoom">
            <div class="leftSelection">
              <img alt="This is an image of hotel room" src="../Images/<?php echo $imageName ?>" width="100%" ><br>
            </div>
            <div class="rightSectionRoom" style="text-align: center; margin: auto;">
              <h4><b><?php echo "$roomDescription"; ?></h4></b>
              <h4 class="text-danger" ><b>Check in: </b><?php echo $checkIn; ?></h4>
              <h4 class="text-danger" ><b>Check out: </b><?php echo $checkOut; ?></h4>
              <h4 class="text-danger" ><b>Total Number of Guest(s): </b><?php echo $adults+$kids; ?></h4>
              <br><br><br>
            </div>
            <div class="bigLine"></div><br>
            <div>
              <h3>Summary of Charges</h3>
            </div>

            <div style="width: 100%;">
              <div class"leftInRight" style="float:left;">
              </div>
              <h4 class="text-danger" style="text-align:right">
              </h4>


              <div class="bigLine"></div><br>
              <div style="float:left; clear:right;">
                <?php echo "1 room for ".$diffDays." night(s)" ?>
              </div>
              <div class="text-danger" style="text-align:right;">
                Price in USD
              </div>
              <br>
              <div class="bigLine"></div><br>
              <div style="float:left; margin: auto; text-align: left">
                Total Rate
              </div>
              <div  style="float:right; text-align: right; margin: auto;">
                <?php echo $price ?> USD/night * <?php echo $diffDays; ?> = <?php echo $priceForNoOfNights; ?> 
              </div>
              <br>
              <div style="float:left; margin: auto; text-align: left">
                Service Charge
              </div>
              <div  style="float:right; text-align: right; margin: auto;">
                <?php echo $serviceCharge; ?>
              </div>
              <br>
              <div style="float:left; margin: auto; text-align: left">
                Estimated Government Taxes and Funds
              </div>
              <div  style="float:right; text-align: right; margin: auto;">
                <?php echo $totalTax; ?>
              </div>
              <br>
              <br>
              <div style="float:left; margin: auto; text-align: left; font-size: 120%;">
                Total for stay
              </div>
              <div  style="float:right; text-align: right; margin: auto;">
                <?php echo $totalPrice; ?> USD
              </div>
              <div class="bigLine"></div><br>

              <br>
              <div style="float:left; margin: auto; text-align: left">
                <br>Additional Charges<br>
                Complimentary on-site parking<br>
                Changes in taxes after booking will affect the total room price.
              </div>
              <div class="bigLine"></div><br>

              </div>
            </div>
            <br>
            
          </div>
          <br>
          <div style="background-color:white; border-radius:5px; padding:16px; height:240px">  
          <h2 class="text-info" style="text:align:left; font-weight: bold">Hotel Cancellation Policy</h2>
          <div class="flexSelectRoom">
            About this reservation:<br>
            You may cancel your reservation for no charge withing 24hrs of your booking. Please note that
            we will assess a fee of <?php echo $cancellationFee ?> USD if you must cancel after the deadline.<br><br> 
            <form action="customerInfo.php" target="POST">
              <input type="hidden" name="roomId" value="<?php echo "$roomId"; ?>">
              <input type="hidden" name="CheckIn" value="<?php echo "$checkIn"; ?>">
              <input type="hidden" name="CheckOut" value="<?php echo "$checkOut"; ?>">
              <input type="hidden" name="adults" value="<?php echo "$adults"; ?>">
              <input type="hidden" name="kids" value="<?php echo "$kids"; ?>">
              <input type="hidden" name="breakfast" value="0">
              <input type="hidden" name="totalPrice" value="<?php echo "$totalPrice"; ?>">              
              <input type="hidden" name="cancellationFee" value="<?php echo "$cancellationFee"; ?>">
              <input type="submit" name="select" class="SelectButton" value="Continue" style="background-color: darkblue;"/>
            </form>
      </div>  
    </div>
  </div>
</header>
<p style="visibility:hidden;">hi</p>
<!-- Page content -->
<div class="w3-content" style="max-width:1532px;">
  <div class="w3-container w3-padding-32 w3-black w3-opacity w3-card w3-hover-opacity-off" style="margin:32px 0;">
    <h2>Get the best offers first!</h2>
    <p>Join our newsletter.</p>
    <label>E-mail</label>
    <input class="w3-input w3-border" type="text" placeholder="Your Email address">
    <button type="button" class="w3-button w3-red w3-margin-top">Subscribe</button>
  </div>
  <div class="w3-container" id="contact">
    <h2>Contact</h2>
    <p>If you have any questions, do not hesitate to ask them.</p>
    <i class="fa fa-map-marker w3-text-red" style="width:30px"></i> Chicago, US<br>
    <i class="fa fa-phone w3-text-red" style="width:30px"></i> Phone: +1 (999) 999-9999<br>
    <i class="fa fa-envelope w3-text-red" style="width:30px"> </i> Email: hotelparadise012@gmail.com<br>
    <form action="index.php" method="post">
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message" required name="Message"></p>
      <p><button class="w3-button w3-black w3-padding-large" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>

<!-- End page content -->
</div>
<!-- Footer -->
<footer class="w3-padding-32 w3-black w3-center w3-margin-top">
  <h5>Find Us On</h5>
  <div class="w3-xlarge w3-padding-16">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>

  <div class = "bg-modal">
    <div class = "modal-contents">
          <div onclick="closeForm()" class = "close">+</div>
              <form action="hotelRooms.php" target="post">
                <div class="w3-row-padding" style="margin:0 -16px;">

                    <br><br>
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-calendar-o"></i> Check In</label>
                    <input class="w3-input w3-border" type="text" id="datepicker" value="<?php echo $_GET['CheckIn'] ?>" name="CheckIn" required>
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-calendar-o"></i> Check Out</label>
                    <input class="w3-input w3-border" type="text" id="datepicker1" value="<?php echo $_GET['CheckOut'] ?>" name="CheckOut" required>
                  </div>
                </div>
                <div class="w3-row-padding" style="margin:8px -16px;">
                  <div class="w3-half w3-margin-bottom">
                    <label><i class="fa fa-male"></i> Adults</label>
                    <input class="w3-input w3-border" type="number" value="<?php echo $_GET['adults'] ?>" name="Adults" min="1" max="6">
                  </div>
                  <div class="w3-half">
                    <label><i class="fa fa-child"></i> Kids</label>
                  <input class="w3-input w3-border" type="number" value="<?php echo $_GET['kids'] ?>" name="Kids" min="0" max="6">
                  </div>
                </div>
                <button class="w3-button w3-dark-grey" type="submit" ><i class="fa fa-search w3-margin-right"></i> Search availability</button>
              </form>
    </div>
  </div>

</body>

<?php
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

</html>
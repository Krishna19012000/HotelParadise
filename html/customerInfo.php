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
    $totalPrice = $_GET['totalPrice'];
    $cancellationFee = $_GET['cancellationFee'];
    if ($breakfast == 1) {
      $price = $_GET['price'] + 20;
    } else {
      $price = $_GET['price'];
    }
  }
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
<style type="text/css">

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

</style>
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
    <div class="rightAllInfoDisplay">
    </div>
  </div>
<br>
  <div class="flexContainer">
    <div class="col-md-4">  
      <div style="background-color:white; border-radius:5px; padding:16px; height:1300px">             
              <h3>Add information below:</h3>
              <div class="bigLine"></div><br>
              <form action="successfullBooking.php" target="POST">

                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Your name.." required>

                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>

                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your email.." required>

                <label for="lname">Phone No.</label>
                <input type="text" id="phoneNo" name="phoneNo" placeholder="Your Phone number.." required>
                <br><br>
                <h3>Address</h3>
                <div class="bigLine"></div><br>

                <label for="country">Country</label>
                <select id="country" name="country" required>
                  <option value="canada">Canada</option>
                  <option value="usa">USA</option>
                </select>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Your Address.." required>

                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Your City.." required>

                <label for="state">State/Province</label>
                <select id="state" name="state" required>
                  <option value="Alberta">Alberta</option>
                  <option value="British Columbia">British Columbia</option>
                  <option value="Manitoba">Manitoba</option>
                  <option value="New Brunswick">New Brunswick</option>
                  <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                  <option value="Nova Scotia">Nova Scotia</option>
                  <option value="Ontario">Ontario</option>
                  <option value="Prince Edward Island">Prince Edward Island</option>
                  <option value="Quebec">Quebec</option>
                  <option value="Saskatchewan">Saskatchewan</option>
                </select>

                <label for="zipCode">Zip code</label>
                <input type="text" id="zipCode" name="zipCode" placeholder="Your Zip Code.." required>

                <br><br>
                <h3>Select Payment Option</h3>
                <div class="bigLine"></div><br>

                Payment System yet to arrive<br><br><br><br>
                You may cancel your reservation for no charge withing 24hrs of your booking.<br>Please note that
                we will assess a fee of <?php echo $cancellationFee ?> USD if you must cancel after the deadline.<br><br> 

                <input type="hidden" name="roomId" value=<?php echo "$roomId";?>>
                <input type="hidden" name="breakfast" value=<?php echo "$breakfast";?>>
                <input type="hidden" name="checkIn" value=<?php echo "$checkIn";?>>
                <input type="hidden" name="checkOut" value=<?php echo "$checkOut";?>>
                <input type="submit" value="Book Now" style="background-color: darkblue;">

              </form>

              </div>
            </div>
            <br>
            
          </div>
          <br>

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
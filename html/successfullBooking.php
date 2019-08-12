<!DOCTYPE html>
<html>
<?php 
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_GET['firstname'])      &&
      isset($_GET['lastname'])      &&
      isset($_GET['email'])      &&
      isset($_GET['phoneNo'])    &&
      isset($_GET['country'])    &&
      isset($_GET['address'])    &&
      isset($_GET['city'])      &&
      isset($_GET['state'])      &&
      isset($_GET['zipCode'])    &&
      isset($_GET['roomId'])      &&
      isset($_GET['checkIn'])     &&
      isset($_GET['checkOut'])    &&
      isset($_GET['breakfast']))
  {
    $fname     = $_GET['firstname'];
    $lname     = $_GET['lastname'];
    $email     = $_GET['email'];
    $phoneNo   = $_GET['phoneNo'];
    $country   = $_GET['country'];
    $address   = $_GET['address'];
    $city      = $_GET['city'];
    $state     = $_GET['state'];
    $zipCode   = $_GET['zipCode'];
    $created_date = "CURRENT_TIMESTAMP";

    $query    = "INSERT INTO customerInfo(`firstName`, `lastName`, `email`, `phoneNo`, `address`, `city`, `state`, `postalCode`, `country`, `created_date`) VALUES" . "('$fname', '$lname', '$email', '$phoneNo', '$country', '$address', '$city', '$state', '$zipCode', $created_date)";

    $result    = $conn->query($query);

    if (!$result)
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";

    $query    = "SELECT customerId FROM customerInfo WHERE created_date=" . "$created_date";

    $result    = $conn->query($query);
    $row = mysqli_fetch_array($result);
    $customerId = $row['customerId'];

    $roomId         = $_GET['roomId'];
    $checkIn        = $_GET['checkIn'];
    $checkOut       = $_GET['checkOut'];
    $breakfast      = $_GET['breakfast'];
    $checkInn = date("Y-m-d", strtotime($checkIn));
    $checkOutt = date("Y-m-d", strtotime($checkOut));

    $query    = "INSERT INTO roomReservation(`customerId`, `roomId`, `checkIn`, `checkOut`, `meal`, `reserveTime`) VALUES" . "('$customerId', '$roomId', '$checkInn', '$checkOutt', '$breakfast', $created_date)";

    $result    = $conn->query($query);

    if (!$result) 
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    else{
      UPDATE room
      SET status = 'Occupied'
      WHERE roomId = $roomId;

      $to      = '$email';
      $subject = 'Room Reservation';
      $message = 'Thank you for choosing Paradise Hotel.';
      $headers = 'From: webmaster@example.com' . "\r\n" .
          'Reply-To: webmaster@example.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);

      $confirmation = "Your room has successfully been booked. You will receive the email confirmation shortly. Thanks for choosing Paradise.";
            echo "<script>alert(\"Your message has been successfully saved and we will get back to you shortly\")</script>";

    }
    $notConfirmed = "Sorry, it didn't went through. Please try again.";
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
  <br><br>
  <h3 style="width:80%; background-color: white; margin: auto; text-align: center;">
    <?php if(isset($confirmation)){
      echo $confirmation;
    }
    else
      echo $notConfirmed;
    ?>
  </h3>
  

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
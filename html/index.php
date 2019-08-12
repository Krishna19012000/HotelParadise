<!DOCTYPE html>
<html>
<?php
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['Name'])   &&
      isset($_POST['Email'])    &&
      isset($_POST['Message']))
  {
    $Name   = get_post($conn, 'Name');
    $Email     = get_post($conn, 'Email');
    $Message     = get_post($conn, 'Message');
    $created_date = "CURRENT_TIMESTAMP";
    $query    = "INSERT INTO contact VALUES" . "('$Name', '$Email', '$Message', $created_date)";
    $result   = $conn->query($query);

    if (!$result) 
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
     else
      echo "<script>alert(\"Your message has been successfully saved and we will get back to you shortly\")</script>";
  }
  if(isset($_POST['subscriptionEmail']))
  {
    $subscriptionEmail = get_post($conn, 'subscriptionEmail');
    $created_date = "CURRENT_TIMESTAMP";

    $query = "INSERT INTO newsletter VALUES" . "('$subscriptionEmail', $created_date)";
    $result1 = $conn->query($query);
     if (!$result1) 
      echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
     else
      echo "<script>alert(\"You have been subscribed to our newsletter\")</script>";
  }
?>

<title>Paradise</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../js/index.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
<body class="w3-light-grey">

<!-- Navigation Bar -->
  <div class="w3-bar w3-white w3-large">
    <a href="#" class="w3-bar-item w3-button w3-red w3-mobile" style="padding: 0 0;"><img src="../Images/logo1.png" alt="Paradise Logo" width="80" height="40"></a>
    <a href="#rooms" class="w3-bar-item w3-button w3-mobile">Rooms</a>
    <a href="#about" class="w3-bar-item w3-button w3-mobile">About</a>
    <a href="#contact" class="w3-bar-item w3-button w3-mobile">Contact</a>
    <a href="#rooms" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Book Now</a>
  </div>
<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px;">
  <img class="w3-image" src="../Images/bg1.jpg" alt="The Hotel" style="min-width:1000px" width="1500" height="800">
  <div class="w3-display-left w3-padding w3-col l6 m8">

    <div id="arrow">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-bed w3-margin-right"></i>Hotel Name</h2>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form action="hotelRooms.php" target="post">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-calendar-o"></i> Check In</label>
            <input class="w3-input w3-border" type="text" id="datepicker" placeholder="MM/DD/YYYY" name="CheckIn" required>
          </div>
          <div class="w3-half">
            <label><i class="fa fa-calendar-o"></i> Check Out</label>
            <input class="w3-input w3-border" type="text" id="datepicker1" placeholder="MM/DD/YYYY" name="CheckOut" required>
          </div>
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-male"></i> Adults</label>
            <input class="w3-input w3-border" type="number" value="1" name="Adults" min="1" max="6">
          </div>
          <div class="w3-half">
            <label><i class="fa fa-child"></i> Kids</label>
          <input class="w3-input w3-border" type="number" value="0" name="Kids" min="0" max="6">
          </div>
        </div>
        <button class="w3-button w3-dark-grey" type="submit"><i class="fa fa-search w3-margin-right"></i> Search availability</button>
      </form>
    </div>
    </div>
  </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1532px;">
  <div class="w3-row-padding w3-large w3-center" style="margin: 32px 0; padding: 10px 0; background-color: grey; color: white; line-height=120%;">
    <div class="w3-third"><i class="fa fa-map-marker w3-text-red"></i> 423 Some adr, Toronto, ON Canada</div>
    <div class="w3-third"><i class="fa fa-phone w3-text-red"></i> Phone: +1 (999) 999-9999</div>
    <div class="w3-third"><i class="fa fa-envelope w3-text-red"></i> Email: hotelparadise012@gmail.com</div>
  </div>
  <div class="w3-row-padding" id="about">
    <div class="w3-col l4 12">
      <h3>About</h3>
      <h6>Our hotel is one of a kind. It is truely amazing. Immerse yourself in the excitement of the city at Paradise Hotel. Perfectly situated in the heart of downtown's Financial and Entertainment districts, our hotel is ideal for every visitor. Business travelers will appreciate our setting near the Convention Centre and local corporate offices as well as our full-service business center and expansive meeting and event venues. All of Toronto's attractions, from Eaton Centre to CN Tower, are within easy reach of our family-friendly hotel. The subway is also close at hand for added convenience. Go for a swim in our heated outdoor pool, or enjoy the amazing view near the lake.  Enjoy delicious food in our restaurant or stop by our cafe for freshly-prepared coffee and treats to take along on your adventures. Whether staying with us for work or fun, we look forward to welcoming you to our downtown Toronto hotel.
    <p>We accept: <i class="fa fa-credit-card w3-large"></i> <i class="fa fa-cc-mastercard w3-large"></i> <i class="fa fa-cc-amex w3-large"></i> <i class="fa fa-cc-cc-visa w3-large"></i><i class="fa fa-cc-paypal w3-large"></i></p>
    </div>
    <div class="w3-col l8 12">
      <!-- Image of location/map -->
      <img src="../Images/about1.jpg" class="w3-image" style="width:100%;">
    </div>
  </div>
  <br>
  <div class="w3-container" id="rooms">
    <h3>Rooms</h3>
    <p>Make yourself at home is our slogan. We offer the best beds in the industry. Sleep well and rest well.</p>
  </div>
  
  <form action="hotelRooms.php" target="post">
    <div class="w3-row-padding">
      <div class="w3-col m3">
        <label><i class="fa fa-calendar-o"></i> Check In</label>
        <input class="w3-input w3-border" type="text" id="datepicker2" placeholder="MM/DD/YYYY" name="CheckIn" required>
      </div>
      <div class="w3-col m3">
        <label><i class="fa fa-calendar-o"></i> Check Out</label>
        <input class="w3-input w3-border" type="text" id="datepicker3" placeholder="MM/DD/YYYY" name="CheckOut" required>
      </div>
      <div class="w3-col m2">
        <label><i class="fa fa-male"></i> Adults</label>
        <input class="w3-input w3-border" type="number"  value="1" name="Adults" min="1" max="6">
      </div>
      <div class="w3-col m2">
        <label><i class="fa fa-child"></i> Kids</label>
        <input class="w3-input w3-border" type="number"  value="0" name="Kids" min="0" max="6">
      </div>
      <div class="w3-col m2">
        <label><i class="fa fa-search"></i> Search</label>
        <button class="w3-button w3-block w3-black">Search</button>
      </div>
    </div>
  </form>
  <div class="w3-row-padding w3-padding-16">
    <div class="w3-third w3-margin-bottom" >
        <img src="../Images/single1.jpg" alt="Norway" style="width:100%;">
      <div class="w3-container w3-white">
        <h3>Single Room</h3>
        <h6 class="w3-opacity">From $99</h6>
        <p>Single bed</p>
        <p>15m<sup>2</sup></p>
        <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i></p>
        <button onclick=window.location.href="hotelRooms.php?room=SingleRoom" class="w3-button w3-block w3-black w3-margin-bottom">Choose Room</button>
      </div>
    </div>
    <div class="w3-third w3-margin-bottom" >
        <img src="../Images/double1.jpg" alt="Norway" style="width:100%;">
      <div class="w3-container w3-white">
        <h3>Double Room</h3>
        <h6 class="w3-opacity">From $149</h6>
        <p>Queen-size bed</p>
        <p>25m<sup>2</sup></p>
        <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i></p>
        <button onclick=window.location.href="hotelRooms.php?room=DoubleRoom" class="w3-button w3-block w3-black w3-margin-bottom">Choose Room</button>
      </div>
    </div>
    <div class="w3-third w3-margin-bottom" >
        <img src="../Images/deluxe3.jpg" alt="Norway" style="width:100%;">
      <div class="w3-container w3-white">
        <h3>Deluxe Room</h3>
        <h6 class="w3-opacity">From $199</h6>
        <p>King-size bed</p>
        <p>40m<sup>2</sup></p>
        <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i> <i class="fa fa-glass"></i> <i class="fa fa-cutlery"></i></p>
        <button onclick=window.location.href="hotelRooms.php?room=DeluxeRoom" class="w3-button w3-block w3-black w3-margin-bottom">Choose Room</button>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <h3>Our Hotels</h3>
    <h6>You can find our hotels anywhere in the world:</h6>
  </div>
  
  <div class="w3-row-padding w3-padding-16 w3-text-white w3-large">
    <div class="w3-half w3-margin-bottom">
      <div class="w3-display-container">
        <img src="../Images/cinqueterre.jpg" alt="Cinque Terre" style="width:100%">
        <span class="w3-display-bottomleft w3-padding">Cinque Terre</span>
      </div>
    </div>
    <div class="w3-half">
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="../Images/newyork2.jpg" alt="New York" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">New York</span>
          </div>
        </div>
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="../Images/sanfran.jpg" alt="San Francisco" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">San Francisco</span>
          </div>
        </div>
      </div>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="../Images/pisa.jpg" alt="Pisa" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">Pisa</span>
          </div>
        </div>
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="../Images/paris.jpg" alt="Paris" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">Paris</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="w3-container w3-padding-32 w3-black w3-opacity w3-card w3-hover-opacity-off" style="margin:32px 0;">
    <h2>Get the best offers first!</h2>
    <p>Join our newsletter.</p>
    <label>E-mail</label>
    <form action="index.php" method="post"> 
      <input class="w3-input w3-border" type="text" placeholder="Your Email address" required name="subscriptionEmail">
      <button type="submit" class="w3-button w3-red w3-margin-top">Subscribe</button>
    </form>
    
  </div>
  <div class="w3-container" id="contact">
    <h2>Contact</h2>
    <p>If you have any questions, do not hesitate to ask them.</p>
    <i class="fa fa-map-marker w3-text-red" style="width:30px"></i> Toronto, Canada<br>
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
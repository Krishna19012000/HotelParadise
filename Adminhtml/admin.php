<!DOCTYPE html>
<html>
<?php 
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

if(isset($_GET['userName']) && isset($_GET['password'])) {
  $result = mysqli_query($conn,"SELECT * FROM login WHERE userName='" . $_GET["userName"] . "' and password='". $_GET["password"]."';");
  $count  = mysqli_num_rows($result);
  if($count==0) {
    $message = "Invalid Username or Password!";
  } else {
    $message = "You are successfully authenticated!";
    header('Location:adminMainMenu.php');
  }
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>


<div class="container">
  <form action="admin.php">
    <div class="row">
      <h2 style="text-align:center">Admin Login</h2>
      <div class="col">
        <input type="text" name="userName" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
        <?php echo $message; ?>
      </div>
    </div>
  </form>
</div>

<?php
  $result->close();
  $conn->close();
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
</body>
</html>


<?php
require_once("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {

  $conn = getConn();

  if(isset($_POST['email'],$_POST['pitch'])){
    
    $email = $_POST['email'];
    $pitch = $_POST['pitch'];
    
    $stmt = $conn->prepare("INSERT INTO application(email,pitch,status) VALUES (?, ?, 'PENDING')");
    $stmt->bind_param("ss",$email,$pitch);
    $res = $stmt->execute();

    if($res == false) $msg="Something went wrong";
    else  $msg="Thank you for your submission, you will recieve an email once it's been processed 😊";

  } else {

    $msg="Invalid arguments given, please fill out the form as intended";

  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Pitch Submitter 9000 ™</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <main>
    <h1>Super Pitch Submitter 9000 ™</h1>
    <form class="form" method="post">
      
      <label for="email">Email:</label>
      <input type="email" id="email1" name="email" required>

      <label for="pitch">Your marvelous pitch:</label>
      <textarea name="pitch" id="pitch" required></textarea>

      <input type="submit" value="Submit">
      
    </form>

    <?php if(isset($msg)):?> <h2><?=$msg?></h2> <?php endif;?>
  </main>
</body>
</html>

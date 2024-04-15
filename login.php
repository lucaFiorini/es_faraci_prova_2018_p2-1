<?php

require_once("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {

  $conn = getConn();

  if(isset($_POST['email'],$_POST['password'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT UserID,level FROM user WHERE email = ? AND password = PASSWORD(?)");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res->num_rows == 1) {
      
      $row = $res->fetch_assoc();
      $_SESSION['UserID'] = $row['UserID'];
      $_SESSION['level'] = $row['level'];

      //TODO: header('redirect');

    } else $msg="Invalid email or password";

  } else {

    $msg="Invalid arguments given, please fill out the form";

  }

}

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Private login area</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
  <main>
    <h1>Private login area</h1>
    <form class="form" method="post">
      
      <label for="email">Email:</label>
      <input type="email" id="email1" name="email" required>

      <label for="password">Password:</label>
      <input name="password" id="password" type="password" required>

      <input type="submit" value="Submit">
      
    </form>

    <?php if(isset($msg)):?> <h2><?=$msg?></h2> <?php endif;?>
  </main>
</body>
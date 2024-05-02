<?php
session_start();

  if(!isset($_SESSION['UserID'],$_SESSION['level']) || $_SESSION['level'] != 'ADMIN'){
    echo "Forbidden, please log in before viewing this page";
    die(403);
  }

  require_once "functions.php";

  $conn = getConn();
  $stmt = $conn->prepare("SELECT ApplicationID,email,pitch,status FROM application");
  $stmt->execute();
  $res = $stmt->get_result();
  $applications = $res->fetch_all(MYSQLI_ASSOC);

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Pitch Submitter 9000 ™</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <table>
    <tr>
      <th>ID</th>
      <th>email</th>
      <th>pitch</th>
      <th>status</th>
    </tr>
    
    <?php foreach($applications as $application):?>
      <tr>
        <td><?=$application['ApplicationID']?></td>
        <td><?=$application['email']?></td>
        <td><?=$application['pitch']?></td>
        <td>
          <?php if($application['status'] == 'PENDING'):?>
            <input type="button" value="approve">
            <input type="button" value="reject">
          <?php else:?>
            <?=$application['status']?>
          <?php endif?>
        </td>
      </tr>
    <?php endforeach;?>

  </table>
</body>
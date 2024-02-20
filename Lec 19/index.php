<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>

  <?php
  //crud operation 
  //c ==> Create 
  //reading r
  //update u 
  //delete d
  include("db.php");
  $page = "All";
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = "All";
  }


  if ($page == "All") {
    $statment = $connect->prepare("SELECT * FROM customers");
    $statment->execute();
    $resultCount = $statment->rowCount();
    $result = $statment->fetchAll();
    echo "<h1>Number Of Row:  $resultCount </h1>";
    foreach ($result as $x) {
  ?>
      <div class="item">
        <?php
        echo "<h2><span>ID:</span> " . $x['Id'] . "</h2>";
        echo "<h2><span>Name:</span> " . $x['Name'] . "</h2>";
        echo "<h2><span>City:</span> " . $x['City'] . "</h2>";
        echo "<h2><span>Phone:</span> " . $x['Phone'] . "</h2>";
        echo "<a class='show' href='index.php?page=profile&user_id=" . $x['Id'] . "'>" . "show" . "</a>";
        echo "<a class='delete' href='index.php?page=delete&user_id=" . $x['Id'] . "'>" . "Delete" . "</a>";
        ?>
      </div>
    <?php
    }
  } elseif ($page == "profile") {
    $user_id = "";
    if (isset($_GET['user_id'])) {
      $user_id = $_GET['user_id'];
    } else {
      $user_id = "";
    }
    $statment = $connect->prepare("SELECT * FROM customers where Id=?");
    $statment->execute(array($user_id));
    $resultCount = $statment->rowCount();
    $result = $statment->fetchAll();
    echo "<h1>Number Of Rows:  $resultCount </h1>";
    foreach ($result as $x) {
    ?>
      <div class="item">
        <?php
        echo "<h2><span>ID:</span> " . $x['Id'] . "</h2>";
        echo "<h2><span>Name:</span> " . $x['Name'] . "</h2>";
        echo "<h2><span>City:</span> " . $x['City'] . "</h2>";
        echo "<h2><span>Phone:</span> " . $x['Phone'] . "</h2>";
        echo "<a class='show' href='index.php'>" . "Back" . "</a>";
        echo "<a class='delete' href='index.php?page=delete&user_id=" . $x['Id'] . "'>" . "Delete" . "</a>";
        ?>
      </div>
  <?php
    }
  } elseif ($page == "delete") {

    $user_id = "";
    if (isset($_GET['user_id'])) {
      $user_id = $_GET['user_id'];
    } else {
      $user_id = "";
    }
    $statment = $connect->prepare("DELETE  FROM customers where Id=?");
    $statment->execute(array($user_id));
    // $result = $statment->fetchAll();
    header("Location: index.php");
  }

  ?>
</body>

</html>
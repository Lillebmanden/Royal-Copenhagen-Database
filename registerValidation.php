<!DOCTYPE html>
<html>
<style>
table {
  border:1px solid black;
}
</style>
<body onload="reDirect()">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "royal";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (! str_contains($_GET["fname"], "'")){
  $injection = FALSE;
} else{
  $injection = TRUE;
}
// Execute the SQL query

if (!$injection){
  $sql = "SELECT Brugernavn FROM bruger";
  $unameList = mysqli_query($conn, $sql);
  $taken = FALSE;

  while ($row = mysqli_fetch_array($unameList, MYSQLI_BOTH)){
    if($_GET["uname"] == $row["Brugernavn"]) {
      $taken = TRUE;
    }
  }
 

  if ($taken!=TRUE){
    $sql = "INSERT INTO `medlem`(`Navn`, `Efternavn`, `Status`) VALUES ('" . $_GET["fname"] ."','" . $_GET["lname"] . "','Uverificeret')";
    mysqli_query($conn, $sql);

    $sql = "SELECT Medlemsnummer FROM medlem x WHERE Medlemsnummer >= ALL (SELECT Medlemsnummer FROM medlem)";
    $memberNumber = mysqli_fetch_array(mysqli_query($conn, $sql));

    //echo $memberNumber[0];

    $sql = "INSERT INTO `bruger`(`Medlemsnummer`, `Password`, `Brugernavn`) VALUES ('" . $memberNumber[0] . "','" . $_GET["pass"] . "','" . $_GET["uname"] . "')";
    mysqli_query($conn, $sql);
  }
  mysqli_close($conn);
}
/*
$url = "http://localhost/royal.php";
header('Location: '.$url);
die();*/

if ($taken == true) {
  echo '<form action= "/register.php" method = "POST" id="form3">';
  echo '<input type="text" hidden id="feedbackRegister" value="'. $_POST["fname"] . '"><br>';
  echo '<input type="text" hidden id="feedbackRegister" value="'. $_POST["lname"] . '"><br>';
  echo '<input type="text" hidden id="feedbackRegister" value="'. $_POST["uname"] . '"><br>';
  echo '<input type="text" hidden id="feedbackRegister" value="'. $_POST["pass"] . '"><br>';
  
} else {
  echo '<form action="/Royal.php" method = "POST" id="form3">';
  echo '<input type="text" hidden id="feedbackRegister" value="hurray"><br>';
}
echo '</form>'


?>



<script>
function reDirect() {

  document.getElementById("form3").submit();

}
</script>

</body>
</html>
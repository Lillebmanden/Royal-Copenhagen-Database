<!DOCTYPE html>
<html>
<style>
table {
  border:1px solid black;
}
</style>
<body>

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
  $unameList = mysqli_fetch_array(mysqli_query($conn, $sql));
  $taken = FALSE;

  for ($i = 0; $i <= count($unameList)-2; $i++) { //Vi trækker 2 fra fordi vi regner med at titlen er med som et extra element
    if($_GET["uname"] == $unameList[$i]) {
      $taken = TRUE;
    }
  }
 
  $sql = "INSERT INTO `medlem`(`Navn`, `Efternavn`, `Status`) VALUES ('" . $_GET["fname"] ."','" . $_GET["lname"] . "','Uverificeret')";
  mysqli_query($conn, $sql);

  $sql = "SELECT Medlemsnummer FROM medlem x WHERE Medlemsnummer >= ALL (SELECT Medlemsnummer FROM medlem)";
  $memberNumber = mysqli_fetch_array(mysqli_query($conn, $sql));

  echo $memberNumber[0];

  $sql = "INSERT INTO `bruger`(`Medlemsnummer`, `Password`, `Brugernavn`) VALUES ('" . $memberNumber[0] . "','" . $_GET["pass"] . "','" . $_GET["uname"] . "')";
  mysqli_query($conn, $sql);
  
  mysqli_close($conn);
}

$url = "http://localhost/royal.php";
header('Location: '.$url);
die();
?>


</body>
</html>
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

if (! str_contains($_GET["name"], "'")){
  $injection = FALSE;
} else{
  $injection = TRUE;
}
// Execute the SQL query

if (!$injection){

  $sql = "UPDATE `serv` SET `Navn`='" . $_GET["name"] . "',`Farve`='" . $_GET["color"] . "',`Pris`='" . $_GET["price"] . "' WHERE Produktionsnummer =" . $_GET["item"];
  mysqli_query($conn, $sql);
  mysqli_close($conn);
}

$url = "http://localhost/browse.php";
header('Location: '.$url);
die();
?>



<script>
function reDirect() {

  document.getElementById("form3").submit();

}
</script>

</body>
</html>
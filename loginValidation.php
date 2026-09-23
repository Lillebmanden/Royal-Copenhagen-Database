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

if (! str_contains($_POST["uname"], "'")){
  $injection = FALSE;
} else{
  $injection = TRUE;
}
// Execute the SQL query

if (!$injection){
  $sql = "SELECT `Password` FROM bruger WHERE Brugernavn = '" . $_POST["uname"] . "'";
  $password = mysqli_fetch_array(mysqli_query($conn, $sql));
  
  if (! $password){
    echo "Username not fount";
    $url = "http://localhost/royal.php";
    header('Location: '.$url);
    die();
  } else{
    if ($_POST["pass"] == $password[0]){
      echo "Logget ind";
      
      
    } else{
      echo "Wrong password";
      $url = "http://localhost/royal.php";
      header('Location: '.$url);
      die();
    }
  }
  
  mysqli_close($conn);
}
?>

<form action="/browse.php" method = "POST" id="form2">
  <input type="text" id="uname" name="uname" value="<?php echo $_POST["uname"]?>"><br>
  <input type="text" id="pass" name="pass" value="<?php echo $_POST["pass"]?>"><br>
</form>


<script>
function reDirect() {

  document.getElementById("form2").submit();

}
</script>


</body>
</html>
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


// Execute the SQL query
//$result = mysqli_query($conn, $sql);



mysqli_close($conn);
?>

<form action="/registerValidation.php" method="get" id="form1">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value=""><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value=""><br><br>
  <label for="lname">Username:</label><br>
  <input type="text" id="uname" name="uname" value=""><br><br>
  <label for="lname">Password:</label><br>
  <input type="password" id="pass" name="pass" value=""><br><br>

  <input type="hidden" id="action">
</form> 

<button onclick="myFunction()">Submit</button>

<p id="test">test</p>

<script>
function myFunction() {
  if(document.getElementById("fname").value.includes("'")) {
    document.getElementById("test").innerHTML = "error"
  } else {
    document.getElementById("form1").submit();
  }
 //document.getElementById("test").innerHTML = document.getElementById("vers").value;
}

</script>


</body>
</html>
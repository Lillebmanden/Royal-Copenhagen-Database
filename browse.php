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
if ($_GET){
  if (! str_contains($_GET["name"], "'")){
    $sql = "SELECT serv.Navn AS sNavn,Stel.Navn AS setNavn,serv.Farve,serv.Pris,medlem.Navn AS mNavn,medlem.Efternavn,Stel.`Årgang` FROM serv 
    LEFT JOIN stel ON serv.Stelnummer = stel.Stelnummer
    LEFT JOIN medlem ON serv.Medlemsnummer = medlem.Medlemsnummer
    WHERE (medlem.Navn LIKE '%" . $_GET["member"] . "%' OR medlem.Efternavn LIKE '%" . $_GET["member"] . "%' OR medlem.Navn IS NULL) AND
    serv.Navn LIKE '%" . $_GET["name"] . "%'"; //Vi skal entenlig lave if statements til hvad vi leder efter (om værdierne er null)
  }else{
    $sql = "SELECT serv.Navn,Stel.Navn,serv.Farve,serv.Pris,medlem.Navn,medlem.Efternavn,Stel.`Årgang` FROM serv 
    LEFT JOIN stel ON serv.Stelnummer = stel.Stelnummer
    LEFT JOIN medlem ON serv.Medlemsnummer = medlem.Medlemsnummer";
  }
}else{
  $sql = "SELECT serv.Navn AS sNavn,Stel.Navn AS setNavn,serv.Farve,serv.Pris,medlem.Navn AS mNavn,medlem.Efternavn,Stel.`Årgang` FROM serv 
  LEFT JOIN stel ON serv.Stelnummer = stel.Stelnummer
  LEFT JOIN medlem ON serv.Medlemsnummer = medlem.Medlemsnummer";
}
// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Process the result set
if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  echo "<h2>Her er din information<br></h2>";
  echo '<table style="width:30%">';
  echo '<tr><td><h3>Navn</h3></td><td><h3>Spilnummer</h3></td><td><h3>Version</h3></td></tr>';
  while($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td style="width:30%">' . $row["sNavn"] . '</td><td style="width:30%">' . $row["setNavn"] . '</td><td style="width:30%">' . $row["Farve"] . "</td></tr>";
    //echo "Navn: " . $row["Navn"]. " - Nummer: " . $row["Spilnummer"]. " - Version: " . $row["Version"]. "<br>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

mysqli_close($conn);
?>

<form action="/browse.php" method="get" id="form1">
<label for="Navn">Navn:</label>
<input type="text" name="name" id="name">

<label for="Stel">Stel:</label>
<input type="text" name="set" id="set">

<label for="Medlem">Medlem:</label>
<input type="text" name="member" id="member">
</form>

<button onclick="myFunction()">Submit</button>

<p id="test">test</p>

<script>
function myFunction() {
  if(document.getElementById("name").value.includes("'")) {
    document.getElementById("test").innerHTML = "error"
  } else {
    document.getElementById("form1").submit();
  }
 //document.getElementById("test").innerHTML = document.getElementById("vers").value;
}

</script>


</body>
</html>
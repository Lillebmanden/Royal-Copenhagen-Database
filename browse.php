<!DOCTYPE html>
<html>
<style>
table {
  border:5px groove;
}
td {
  border:1px dotted grey;
}
</style>
<body>

<h2>Royal CPH Database</h2>
<h3>Vælg søge kriterier</h3>

<form action="/browse.php" method="get" id="form1">
<label for="Navn">Navn:</label>
<input type="text" name="name" id="name" value="<?php if ($_GET){if($_GET["name"]){echo $_GET["name"];}}?>">

<label for="Stel">Stel:</label>
<input type="text" name="set" id="set" value="<?php if ($_GET){if($_GET["set"]){echo $_GET["set"];}}?>">

<label for="Medlem">Medlem:</label>
<input type="text" name="member" id="member"  value="<?php if ($_GET){if($_GET["member"]){echo $_GET["member"];}}?>"> <br> <br>

<label for="Farve">Farve:</label>
<select name="color" id="color">
<?php 
$items = ["None","Grøn","Blå","Orange","Sort"];
for ($x = 0; $x <= count($items)-1; $x++) {
  echo '<option value="' . $items[$x] . '"';
  if ($_GET["color"] == $items[$x]){
    echo " selected ";
  }
  echo '>' . $items[$x] . '</option>';
}
?>
</select>

<label for="Pris">Max Pris:</label>
<input type="number" name="price" id="price" value="<?php if ($_GET){if($_GET["price"]){echo $_GET["price"];}}?>">

<label for="Årgang">Årgang:</label>
<input type="number" name="year" id="year" value="<?php if ($_GET){if($_GET["year"]){echo $_GET["year"];}}?>">
</form>

<button onclick="myFunction()">Submit</button>

<p id="test"></p>

<br>

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
    WHERE 1 ";
    if ($_GET["member"]){
      $sql = $sql . " AND (medlem.Navn LIKE '%" . $_GET["member"] . "%' OR medlem.Efternavn LIKE '%" . $_GET["member"] . "%')";
    }
    if ($_GET["name"]){
      $sql = $sql . " AND serv.Navn LIKE '%" . $_GET["name"] . "%'";
    }
    if ($_GET["set"]){
      $sql = $sql . " AND stel.Navn LIKE '%" . $_GET["set"] . "%'";
    }
    if ($_GET["color"] != "None"){
      $sql = $sql . " AND serv.Farve = '" . $_GET["color"] . "'";
    }
    if ($_GET["price"]){
      $sql = $sql . " AND serv.Pris < " . $_GET["price"];
    }
    if ($_GET["year"]){
      $sql = $sql . " AND Stel.`Årgang` = '" . $_GET["year"] . "'";
    }
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
  echo "<h3>Resultater:<br></h3>";
  echo '<table style="width:50%">';
  echo '<tr><td><h3>Produkt Navn</h3></td><td><h3>Stel</h3></td><td><h3>Farve</h3></td><td><h3>Eger</h3></td><td><h3>Pris</h3></td><td><h3>Årgang</h3></td></tr>';
  while($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td style="width:15%">' . $row["sNavn"] . '</td><td style="width:15%">' . $row["setNavn"] . '</td><td style="width:10%">' . $row["Farve"] . '</td><td style="width:20%">' . $row["mNavn"] . " " . $row["Efternavn"] . '</td><td style="width:10%">' . $row["Pris"] . '</td><td style="width:10%">' . $row["Årgang"] . '</td></tr>';
    //echo "Navn: " . $row["Navn"]. " - Nummer: " . $row["Spilnummer"]. " - Version: " . $row["Version"]. "<br>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

mysqli_close($conn);
?>

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
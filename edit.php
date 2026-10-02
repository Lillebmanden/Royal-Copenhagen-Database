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

  if (! str_contains($_GET["item"], "'")){
    $sql = "SELECT serv.Navn AS sNavn,Stel.Navn AS setNavn,serv.Farve,serv.Pris,Stel.`Årgang` FROM serv 
    LEFT JOIN stel ON serv.Stelnummer = stel.Stelnummer
    LEFT JOIN medlem ON serv.Medlemsnummer = medlem.Medlemsnummer
    LEFT JOIN har_lavet ON serv.Produktionsnummer = har_lavet.Produktionsnumre
    LEFT JOIN kunst ON har_lavet.Kunstnernumre = kunst.Kunstnernumre 
    WHERE serv.Produktionsnummer = " . $_GET["item"];
    $sql = $sql . " GROUP BY serv.Produktionsnummer ";
  }else{
      $url = "http://localhost/browse.php";
      header('Location: '.$url);
      die();
  }

// Execute the SQL query
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);


echo '<h2>Royal CPH Database</h2>';
echo '<h3>Opdater Service Egenskaber</h3>';

echo '<form action="/update.php" method="get" id="form1">';
echo '<label for="Navn">Navn:</label>';
echo '<input type="text" name="name" id="name" value="' . $row["sNavn"] . '">';

/*echo '<label for="Stel">Stel:</label>';
echo '<input type="text" name="set" id="set" value="' . $row["setNavn"] . '">';*/

echo '<label for="Farve">Farve:</label>';
echo '<select name="color" id="color">';

$items = ["None","Grøn","Blå","Orange","Sort"];
for ($x = 0; $x <= count($items)-1; $x++) {
  echo '<option value="' . $items[$x] . '"';
  if ($_GET){
    if ($row["Farve"]){
      if ($row["Farve"] == $items[$x]){
        echo " selected ";
      }
    }
  }
  echo '>' . $items[$x] . '</option>';
}

echo '</select>';

echo '<label for="Pris">Max Pris:</label>';
echo '<input type="number" name="price" id="price" value="' . $row["Pris"] . '">';

echo '<input hidden type="number" name="item" id="item" value="' . $_GET["item"] . '">';
?>
</form>

<p id="test"></p>

<br>

<form action="/edit.php" method="get" id="form2">
<input hidden name="item" id="item">
</form>

<button onclick="myFunction()">Update</button>

<script>
function myFunction() {
  if(document.getElementById("name").value.includes("'")) {
    document.getElementById("test").innerHTML = "error"
  } else {
    document.getElementById("form1").submit();
  }
 //document.getElementById("test").innerHTML = document.getElementById("vers").value;
}

function toEdit(pressed) {
  document.getElementById("item").value = pressed
  document.getElementById("form2").submit();
}
</script>


</body>
</html>
<!DOCTYPE html>
<html>
<style>
table {
  border:1px solid black;
}
</style>
<body>

<form action="/loginValidation.php" method = "POST">
  <label for="uname">Username:</label><br>
  <input type="text" id="uname" name="uname"><br>
  <label for="pass">Password:</label><br>
  <input type="text" id="pass" name="pass">
  <button type="submit">Log in</button>
</form>

<form action="/register.php">
<button type="submit">Create acount</button>
</form>

<p id="test">test</p>

<script>
function myFunction() {
  if(document.getElementById("vers").value.includes("'")) {
    document.getElementById("test").innerHTML = "error"
  } else {
    document.getElementById("form1").submit();
  }
 //document.getElementById("test").innerHTML = document.getElementById("vers").value;
}

</script>


</body>
</html>
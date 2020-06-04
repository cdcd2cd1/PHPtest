<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','root','','cep');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cep");
$sql="SELECT * FROM tcep WHERE cep = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
  echo "<input type=text id=cepH name=cepH value=" . $row['cep'] . ">";
  echo "<input type=text id=bairroH name=bairroH value=" . $row['bairro'] . ">";
}

mysqli_close($con);
?>
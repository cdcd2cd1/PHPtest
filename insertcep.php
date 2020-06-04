<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cep";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$rcep = $_GET["rcep"];
$rlogradouro = $_GET["rlogradouro"];
$rbairro = $_GET["rbairro"];
$rlocalidade = $_GET["rcidade"];
$restado = $_GET["restado"];
$ribge = $_GET["ribge"];

$sql = "INSERT INTO tcep (cep, logradouro, bairro, localidade, uf, ibge)
VALUES ('$rcep', '$rlogradouro', '$rbairro', '$rlocalidade', '$restado', '$ribge')";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
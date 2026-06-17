<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <?php include "../Includes/header.php"; ?>

</head>
<body class="paars">
    <br><br><br>
</body>
</html>


<?php

session_start();
session_destroy();

echo '<p style="font-size: 50px; font-family: "Norwester";">Je bent uitgelogd.</p> <a href="index.php" id="startpage_btn" style="background-color: white;">Start pagina.</a> <br><br>';


?>
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

echo 'Je bent uitgelogd. <a href="index.php">Start pagina.</a> <br><br>';


?>
<button type="submit" onClick="refreshPage()">Refresh Button</button>
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>
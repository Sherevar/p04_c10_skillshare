<?php
// dashboard.php
// Dit is een placeholder. Studenten bouwen hier later hun eigen dashboard.
// We beveiligen deze pagina: alleen toegankelijk als je ingelogd bent.

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Niet ingelogd? terug naar login
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h1>Dashboard</h1>
    <p>Welkom, <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong>!</p>
    <p>Opdracht: bouw hier je eigen dashboard 😊</p>
  </div>
</body>
</html>
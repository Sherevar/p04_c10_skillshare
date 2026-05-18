<?php include "../Includes/header.php"; ?>

<?php
// login.php
// Deze pagina toont het loginformulier én verwerkt de login.
// Als de login klopt -> doorsturen naar dashboard.php

session_start();          // Nodig om later in te loggen via session
require_once "../Includes/db.php";    // PDO verbinding

$error = "";

// Als er op de knop "Inloggen" is gedrukt, komt er een POST-request binnen
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1) Lees de input uit het formulier
    // trim() haalt spaties weg aan begin/eind
    $username = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // 2) Basis validatie (is er iets ingevuld?)
    if ($username === "" || $password === "") {
        $error = "Vul een overeenkomende gebruikersnaam én wachtwoord in.";
    } else {

        // 3) Haal de gebruiker op uit de database met een prepared statement
        // Zo voorkom je SQL-injectie.
        $stmt = $pdo->prepare("SELECT id, email, user_password, permission_role FROM tb_users WHERE email = :email LIMIT 1");
        $stmt->execute([":email" => $username]);

        $user = $stmt->fetch(); // false als niets gevonden
		
		// HOTFIX als wachtwoord niet klopt... dumpt Array!
		var_dump($_SESSION);
		// exit;

        
        // 4) Controleer:
        // - bestaat de user?
        // - klopt het wachtwoord met password_verify?
        if ($user && password_verify($password, $user["user_password"])) {

            // 5) Login is gelukt -> zet sessievariabelen
            $_SESSION["logged_in"] = true;
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["permission_role"] = $user["permission_role"];
            // IS THIS CORRECT OR NOT?!

            var_dump($_SESSION);
            // 6) Doorsturen naar dashboard
            header("Location: index.php");
            exit;

        } else {
            $error = "Onjuiste gebruikersnaam of wachtwoord.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/header.css">    
</head>


</head>
<body>
  <div class="card">
    <h1>Login</h1>

    <form method="POST" action="inloggen.php">
      <label for="email">Gebruikersnaam</label>
      <input id="email" name="email" type="text" placeholder="bijv. admin" required>

      <label for="password">Wachtwoord</label>
      <input id="password" name="password" type="password" placeholder="bijv. admin" required>

      <button type="submit">Inloggen</button>
    </form>

    <form action="registratie.php"> <!-- Needs a link to a new user form, linked to database -->
      <br>
    <input type="submit" value="Registreer als nieuwe gebruiker" />
</form>


    <?php if ($error): ?>
      <div class="msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </div>
<button type="submit" onClick="refreshPage()">Refresh Button</button>
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>
<!-- <script src="Javascript/invullen.js"></script> What does this do?-->
</body>
</html>





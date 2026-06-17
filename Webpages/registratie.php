<?php
    include "../Includes/header.php";
    require "../Includes/db.php";

// =======================================
// FORM VERWERKING (STUREN NAAR DATABASE)
// =======================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['user_password'] ?? '';
    $email = $_POST['email'] ?? '';

    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "<br>";
    if ($username && $password && $email) {


    try {
        $pdo->beginTransaction();       // zorgt ervoor dat alle queries volledig moeten ingevuld zijn

        $sql = "
            INSERT INTO tb_users (username, user_password, email)
            VALUES (:username, :password, :email)
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hash,
            ':email' => $email,
        ]);
         
        $pdo->commit();
        $melding = "U hebt een account aangemaakt!";
    } catch(Exception $e) {
        $pdo->RollBack();
        $melding = "Registratie mislukt: " . $e->getMessage();
    }
}
}
// ============================
// FORM VERWERKING EINDE
// ============================

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
    
</head>

<?php if (!empty($melding)) echo "<p>$melding</p>"; ?>
<br><br><br><br>
    <h2 id="home_headtext1">REGISTREREN</h2>
<div id="login_card_styling">
    <div class ="form-container">
    <!--REGISTRATIE-FORM-->
    <form method="POST" action="registratie.php" id="form_positioning">
        <h4>Gebruikersnaam</h4>
        <input type="username" id="username" name="username" placeholder="Gebruikersnaam" required>
        <h4>E-mail</h4>
        <input type="email" id="email" name="email" placeholder="Email adres" required>
        <h4>Password</h4>
        <input type="password" id="password" name="user_password" placeholder="Wachtwoord" required>
        <br>
        <br>
        <!--BUTTONS-->
        <button type="submit" class="headerbutton">Verzenden</button>
        <button href="inloggen.php" class="headerbutton">Ga naar inloggen</button>
    </form>
    </div>
</div>

</body>
</html>



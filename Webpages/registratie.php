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
    <h2 style="left: 30px; margin-left: 80px;"> Gebruiker registreren </h2>
<div class ="form-container">
<form method="POST" action="registratie.php">

    <div id="MainContainer" style="display: flex; height: 500px; width: 100vw;">
        <div id="PaddingContainer" style="display: flex; flex-direction: justify-content: center; align-items: center; column; gap: 5px; width: 60px; height: 100%;"> </div>
            <div id="LeftContainer" style="display: flex; flex-direction: column; gap: 5px; width: 15%; height: 100%;"></div>
        <div id="MiddleContainer"  style="display: flex; flex-direction: column; gap: 5px; width: 18%; height: 100%;">
            <input type="username" id="username" name="username" placeholder="Gebruikersnaam" required>
            <input type="email" id="email" name="email" placeholder="Email adres" required>
            <input type="password" id="password" name="user_password" placeholder="Wachtwoord" required>
            <button type="submit" style="margin-top: 20px; width: 100px;" id="VerzendBtn">Verzenden</button>
        </div>
        <div id="RightContainer" style="display: flex; flex-direction: column: gap: 5px; width: 60%; height: 100%;">
                <a href="inloggen.php" class="button">Ga naar inloggen</a>
        </div>
        </div>
    </div>
</div>
</form>



</body>
</html>



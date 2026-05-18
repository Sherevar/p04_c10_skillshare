<?php
    include "../Includes/header.php";
    require "../Includes/db.php";

// =======================================
// FORM VERWERKING (STUREN NAAR DATABASE)
// =======================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $city = $_POST['city'] ?? '';

    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "<br>";
    if ($username && $password && $firstname && $lastname && $phone && $address && $zipcode && $city) {


    try {
        $pdo->beginTransaction();       // zorgt ervoor dat alle queries volledig moeten ingevuld zijn

        $sql = "
            INSERT INTO tb_users (email, user_password)
            VALUES (:email, :password)
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $username,
            ':password' => $hash,
        ]);

        // Haalt de variabele van de users.id op en zet deze in $userId, eerst een string, dan veranderen in een integer.
        $userId = $pdo->lastInsertId();
        $userId = intval($userId);
        // echo gettype($userId);       Checks type
        // echo $userId;                Checks value
     
     
        $sql2 = "
            INSERT INTO tb_userdata (user_id, firstname, lastname, phone, address, zipcode, city)
            VALUES (:user_id, :firstname, :lastname, :phone, :address, :zipcode, :city)
        ";

        //  var_dump($firstname);
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([
            ':user_id' => $userId,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':phone' => $phone,
            ':address' => $address,
            ':zipcode' => $zipcode,
            ':city' => $city,
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
    <h2 style="left: 30px; margin-left: 80px;"> Registreren </h2>
<div class ="form-container">
<form method="POST" action="registratie.php">

    <div id="MainContainer" style="display: flex; height: 500px; width: 100vw;">
        <div id="PaddingContainer" style="display: flex; flex-direction: justify-content: center; align-items: center; column; gap: 5px; width: 60px; height: 100%;"> </div>
            <div id="LeftContainer" style="display: flex; flex-direction: column; gap: 5px; width: 15%; height: 100%;">
            <input type="email" id="email" name="email" placeholder="Email adres" required>
            <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
            <button type="submit" style="margin: 20px;" id="VerzendBtn">Verzenden</button>
            </div>
            <H1> EDIT DEZE GEGEVENS!!! </H1>
        <div id="MiddleContainer"  style="display: flex; flex-direction: column; gap: 5px; width: 18%; height: 100%;">
            <input type="text" id="firstname" name="firstname" placeholder="Voornaam" required>
            <input type="text" id="lastname" name="lastname" placeholder="Achternaam" required>
            <input type="number" id="phone" name="phone" placeholder="Telefoon nummer" required>
            <input type="text" id="address" name="address" placeholder="Adres" required>
            <input type="text" id="zipcode" name="zipcode" placeholder="Postcode" required>
            <input type="text" id="city" name="city" placeholder="Stad" required>

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



<!DOCTYPE html>
<html>
    <title>Overzicht</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <?php include "../Includes/header.php"; ?>
<body>
<br><br>

<?php

include '../Includes/db.php'; // Database connection

$id = $_GET['id'] ?? null;
// if (!$id) die("<br>&#10060; Geen ID opgegeven");
echo "\n";
echo "\n";


// Opslaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE tb_userdata
            SET
                firstname = :firstname,
                lastname = :lastname,
                phone = :phone,
                address = :address,
                zipcode = :zipcode,
                city = :city,
                
            WHERE id = :id";
        //     echo $sql;
            

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':firstname' => $_POST['firstname'],
        ':lastname' => $_POST['lastname'],
        ':phone' => $_POST['phone'],
        ':address' => $_POST['address'],
        ':zipcode' => $_POST['zipcode'],
        ':city' => $_POST['city'],                   
        ':id' => $id
    ]);
        // echo "test5";
    header("Location: ../Webpages/index.php");
    exit;
}

// Data ophalen
$stmt = $pdo->prepare("SELECT * FROM tb_userdata WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();
?>

<div class="form-container">
    <h2>Record aanpassen</h2>
<form method="post">
    <div class="input-container">

        <label for="firstname">Voornaam:</label>
                <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($data['firstname']) ?>"><br><br>
        <label for="lastname">Achternaam:</label>
                <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($data['lastname']) ?>"><br><br>
        <label for="phone">Telefoon:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($data['phone']) ?>"><br><br>
        <label for="address">Straat:</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($data['address']) ?>"><br><br>
        <label for="zipcode">Postcode:</label>
                <input type="text" id="zipcode" name="zipcode" value="<?= htmlspecialchars($data['zipcode']) ?>"><br><br>
        <label for="city">Stad:</label>
                <input type="text" id="city" name="city" value="<?= htmlspecialchars($data['city']) ?>"><br><br>


<!-- 
<form>
  <label for="birthdaytime">Birthday (date and time):</label>
  <input type="datetime-local" id="birthdaytime" name="birthdaytime">
</form>

<form>
  <label for="email">Enter your email:</label>
  <input type="email" id="email" name="email">
</form>


 -->


    </div>
    <button type="submit" id="btnOpslaan">Opslaan</button>
</form>
</div>

</body>
</html>

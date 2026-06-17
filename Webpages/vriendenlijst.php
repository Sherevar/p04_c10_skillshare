<?php
require "../Includes/db.php";
session_start();
include "../Includes/header.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: inloggen.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id, username FROM tb_users WHERE id != :self_id");
$stmt->execute([':self_id' => $_SESSION['user_id']]);
$userlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch friends of the current user (join to users to get usernames)
$stmt = $pdo->prepare(
    "SELECT f.friend_id AS id, u.username
     FROM tb_friends f
     JOIN tb_users u ON f.friend_id = u.id
     WHERE f.user_id = :user_id"
);
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$friendlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

$melding = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $friend_id_string = $_POST['friend_id'] ?? '';
    $friend_nr = intval($friend_id_string);

    if ($friend_nr > 0) {
        try {
            $pdo->beginTransaction();
            $sql = "INSERT INTO tb_friends (user_id, friend_id) VALUES (:user_id, :friend_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $_SESSION["user_id"],
                ':friend_id' => $friend_nr,
            ]);
            $pdo->commit();
            $melding = "Vriend toegevoegd!";
        } catch (Exception $e) {
            $pdo->rollBack();
            $melding = "Het is niet gelukt: " . $e->getMessage();
        }
    } else {
        $melding = "Kies eerst een vriend voordat je verzendt.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vriendenlijst</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<h3 id="home_headtext1">Vriend toevoegen</h3>
<?php if ($melding): ?>
    <p class="notification"><?php echo htmlspecialchars($melding); ?></p>
<?php endif; ?>
<div class="textcard_styling">
    <form method="POST" action="vriendenlijst.php">
        <label for="friend_id">Selecteer een gebruiker:</label>
        <select name="friend_id" id="friend_id">
            <?php foreach ($userlist as $user): ?>
                <option value="<?php echo $user['id']; ?>">
                    <?php echo htmlspecialchars($user['username']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="headerbutton" style="margin: 20px;">Vriend toevoegen</button>
    </form>



<h3>Vriendenlijst</h3>
<ul id="friend_list">
    <?php if (!empty($friendlist)): ?>
        <?php foreach ($friendlist as $friend): ?>
            <li><?php echo htmlspecialchars($friend['username']); ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Geen vrienden gevonden.</li>
    <?php endif; ?>
</ul>
</div>
</body>
</html>

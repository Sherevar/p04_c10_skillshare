<?php
require "../Includes/db.php";
include "../Includes/header.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: inloggen.php");
    exit;
}



        $stmt = $pdo->prepare("SELECT id, username FROM tb_users");
        $stmt->execute();
        $userlist = $stmt->fetchAll(PDO::FETCH_ASSOC); // alle rijen ophalen



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


<ul> Other users
    <li></li>
    <li></li>
    <li></li>
    <li></li>



<ul name="friendlist" id="friend_selector">
    <?php foreach ($userlist as $users): ?>
        <option value="<?php echo $users['id']; ?>">
            <li><?php echo $users['username']; ?></li>
        </option>
    <?php endforeach; ?>
    </ul>










    

</ul>




    
</body>
</html>
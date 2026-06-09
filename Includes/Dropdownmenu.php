<?php

require_once "../Includes/db.php"; 

        $stmt = $pdo->prepare("SELECT id, skill FROM tb_skills");
        $stmt->execute();
        $skillArray = $stmt->fetchAll(PDO::FETCH_ASSOC); // alle rijen ophalen
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<label for="skillSelect">Kies een skill:</label>
    <select name="skills" id="skill-select">
        <?php foreach ($skillArray as $skillCounter): ?>
            <option value="<?php echo $skillCounter['id']; ?>">
                <?php echo $skillCounter['skill']; ?>
            </option>
        <?php endforeach; ?>
    </select>


</body>
</html>
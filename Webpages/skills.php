<?php
// CHECK IF THE PERSON LOGGED IN IS AN ADMIN
// IF SO ALLOW THEM TO CONTINUE TO THIS PAGE
// OTEHRWISE BOOT THEM BACK TO THE MAIN MENU OR SOMETHING
    include "../Includes/header.php";
    require "../Includes/db.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = $_POST['skill'] ?? '';
    $description = $_POST['description'] ?? '';

    
    echo "<br><br>";
    if ($skill && $description) {
// MAAK ECHO/MELDINGEN OVER WAT WORDT DOORGESTUURD!
    try {
        $sql = "
            INSERT INTO tb_skills (skill, description)
            VALUES (:skill, :description)
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':skill' => $skill,
            ':description' => $description,
        ]);

        $melding = "Een nieuwe skill is toegevoegd";
    } catch(Exception $e) {
                echo "test try catch ELSE.";
        $melding = "Toevoeging mislukt: " . $e->getMessage();
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills toevoegen</title>
        <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    
    <p id="skill_headtext1">Skill toevoegen</p>
<div class ="form-container">
<form method="POST" action="skills.php">
    <!-- SKILL FIELD: Insert new skills and descriptions here. -->
<!-- Could use an already existing skill list or be able to edit certain items (new page?) -->

                
<div id="textcard_styling_skills">
    <!--NAAMBOX-->
    <h2 style="font-family: 'norwester'">NAAM SKILL</h2>        
    <input type="text" id="skill_input" name="skill" placeholder="Naam, max 50 tekens" required>

    <!--TEXTAREA-->
    <h2 style="font-family: 'norwester'">BESCHRIJVING</h2>
    <textarea type="text" id="description_skillpage" name="description" placeholder="Beschrijving, max 60.000 tekens" required></textarea>
    
    <!--VERZENDKNOP-->
    <br>
    <button type="submit" style="margin: 20px;" class="headerbutton">Verzenden</button>
</div>




</body>
</html>
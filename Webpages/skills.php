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
        echo "test try catch.";
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
    
    <h2 style="left: 30px; margin-left: 80px;"> Skill toevoegen </h2>
<div class ="form-container">
<form method="POST" action="skills.php">
    <!-- CHECK DIT NOG LATER -->

    <div id="MainContainer" style="display: flex; height: 500px; width: 100vw;">
        <div id="PaddingContainer" style="display: flex; flex-direction: justify-content: center; align-items: center; column; gap: 5px; width: 60px; height: 100%;"> </div>
            <div id="LeftContainer" style="display: flex; flex-direction: column; gap: 5px; width: 25%; height: 100%;">
            <input type="text" id="skill" name="skill" placeholder="Naam, max 50 tekens" required>
            <input type="text" id="description" name="description" placeholder="Beschrijving, max 60.000 tekens" style="width: 300px; height: 500px;" required>
            <button type="submit" style="margin: 20px;" id="VerzendBtn">Verzenden</button>
            </div>
            <H1> Edit deze pagina </H1>
        <div id="MiddleContainer"  style="display: flex; flex-direction: column; gap: 5px; width: 18%; height: 100%;">
                <h2> Lijst van bestaande skills hieronder </h2>
                <h3> Lijst met edit mogelijkheid? </h3>
        </div>
        <div id="RightContainer" style="display: flex; flex-direction: column: gap: 5px; width: 50%; height: 100%;">

        </div>
        </div>
    </div>
</div>



</body>
</html>
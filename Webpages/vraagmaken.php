<?php
    include "../Includes/header.php";
    require "../Includes/db.php";

        $stmt = $pdo->prepare("SELECT id, skill FROM tb_skills");
        $stmt->execute();
        $skillArray = $stmt->fetchAll(PDO::FETCH_ASSOC); // alle rijen ophalen



// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $skill = $_POST['skill'] ?? '';
//     $description = $_POST['description'] ?? '';

    
//     echo "<br><br>";
//     if ($skill && $description) {
//         echo "test try catch.";
// // MAKE THIS INTO PROPER QUESTION FORM, RADIO BUTTON ANSWER INCLUDED
// // EDIT THIS FOR QUESTIONS TO BE CORRECTLY CREATED IN DATABASE
//     try {
//         $sql = "
//             INSERT INTO tb_questions (skill, description)
//             VALUES (:skill, :description)
//         ";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([
//             ':skill' => $skill,
//             ':description' => $description,
//         ]);

//         $melding = "Een nieuwe vraag is toegevoegd.";
//     } catch(Exception $e) {
//         $melding = "Toevoeging mislukt: " . $e->getMessage();
//     }
// }
// }

// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL
// ^ ALL OF THIS REQURIES EDITING STILL

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vragen Maken</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    

    
    <h2 style="left: 30px; margin-left: 80px;"> Vraag toevoegen </h2>
<div class ="form-container">
<form method="POST" action="vraagmaken.php">
    <!-- CHECK DIT NOG LATER -->

    <div id="MainContainer" style="display: flex; height: 500px; width: 100vw;">
        <div id="PaddingContainer" style="display: flex; flex-direction: justify-content: center; align-items: center; column; gap: 5px; width: 60px; height: 100%;"> </div>
            <div id="LeftContainer" style="display: flex; flex-direction: column; gap: 5px; width: 25%; height: 100%;">


            <textarea type="text" id="vraag" name="vraag" placeholder="Beschrijf de vraag" style="align-items: flex-start; width: 300px; height: 500px;" required></textarea>
           <br>
            <!--  Loop which gives a dropdown menu of already created skills. -->
           <label for="skillSelect">Kies een skill:</label>
    <select name="skills" id="skill-select">
        <?php foreach ($skillArray as $skillCounter): ?>
            <option value="<?php echo $skillCounter['id']; ?>">
                <?php echo $skillCounter['skill']; ?>
            </option>
        <?php endforeach; ?>
    </select>

        <!-- Radio menu for answer selection -->

          <p>Welk antwoord is correct?</p>
            <input type="radio" id="answer1" name="answer" value="answer1">
            <label for="answer1">Antwoord 1</label>
            <input type="radio" id="answer2" name="answer" value="answer2">
            <label for="answer2">Antwoord 2</label>
            <input type="radio" id="answer3" name="answer" value="answer3">
            <label for="answer3">Antwoord 3</label>
            <input type="radio" id="answer4" name="answer" value="answer4">
            <label for="answer4">Antwoord 4</label>

            <button type="submit" style="margin: 20px;" id="VerzendBtn">Verzenden</button>
            </div>

            <!-- Four answer containers. CSS styling can be ported over to style.css -->
        <div id="MiddleContainer"  style="display: flex; flex-direction: column; gap: 5px; width: 38%; height: 100%;">         
                <textarea type="text" id="answer1" name="answer1" placeholder="Antwoord 1" style="width: 500px; height: 500px;" ></textarea>
                <textarea type="text" id="answer2" name="answer2" placeholder="Antwoord 2" style="width: 500px; height: 500px;" ></textarea>

        </div>
        <div id="RightContainer" style="display: flex; flex-direction: column; gap: 5px; width: 38%; height: 100%;">
                <textarea type="text" id="answer3" name="answer3" placeholder="Antwoord 3" style="width: 500px; height: 500px;" ></textarea>
                <textarea type="text" id="answer4" name="answer4" placeholder="Antwoord 4" style="width: 500px; height: 500px;" ></textarea>
        </div>
        </div>
    </div>
</div>

<?php
// echo $_POST['skills'];
// echo '\n';
// echo var_dump($_POST);
echo "\n";
echo "\n";
print_r ($skillArray);
echo "\n";
echo "\n";
// echo $skill_id = intval($skillArray);
// echo gettype($skill_id);


?>
</body>









<!-- 
<?php


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $question = $_POST['vraag'] ?? '';
//     $skills_id = $_POST[$skillCounter['id']] ?? '';
//             // ASK IF THIS IS CORRECT


//     $question = $_post['vraag']
//     $answer1 = $_POST['answer1'] ?? '';
//     $answer2 = $_POST['answer2'] ?? '';
//     $answer3 = $_POST['answer3'] ?? '';
//     $answer4 = $_POST['answer4'] ?? '';
//     $answer_true = $_POST['answer_true'] ?? '';


//     $hash = password_hash($password, PASSWORD_DEFAULT);
//     echo "<br>";
//     if ($skills_id 
//      && $question
//       && $answer1 && $answer2 && $answer3 && $answer4 && $answer_true) {


//     try {
//         $pdo->beginTransaction();       // zorgt ervoor dat alle queries volledig moeten ingevuld zijn

//         $sql = "
//             INSERT INTO tb_questions (skills_id, question)
//             VALUES (:email, :password)
//         ";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([
//             ':skills_id' => $skills_id,
//             ':question' => $question,
//         ]);

//         // Haalt de variabele van de users.id op en zet deze in $userId, eerst een string, dan veranderen in een integer.
//         $question_id = $pdo->lastInsertId();
//         $question_id = intval($question_id);
//         // echo gettype($userId);       Checks type
//         // echo $userId;                Checks value
     
     
//         $sql2 = "
//             INSERT INTO tb_answers (question_id, answer1, answer2, answer3, answer4, answer_true)
//             VALUES (:question_id, :answer1, :answer2, :answer3, :answer4, :answer_true)
//         ";

//         //  var_dump($firstname);
//         $stmt2 = $pdo->prepare($sql2);
//         $stmt2->execute([
//             ':user_id' => $userId,
//             ':firstname' => $firstname,

//         ]);
    
//         $pdo->commit();
//         $melding = "U hebt een account aangemaakt!";
//     } catch(Exception $e) {
//         $pdo->RollBack();
//         $melding = "Registratie mislukt: " . $e->getMessage();
//     }
// }
// }


?> -->
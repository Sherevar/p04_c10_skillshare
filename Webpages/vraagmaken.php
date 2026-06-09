<?php
    include "../Includes/header.php";
    require "../Includes/db.php";

        $stmt = $pdo->prepare("SELECT id, skill FROM tb_skills");
        $stmt->execute();
        $skillArray = $stmt->fetchAll(PDO::FETCH_ASSOC); // alle rijen ophalen


// Retrieves the correct skill_id from the select menu and turns it into an integer able to be used.
// Several checks regarding the value and data type of the information sent through the post.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loop_id_string = $_POST['skills'];
    // echo "Skill id: " . $loop_id . "\n";
    // echo gettype($loop_id);
    $loop_nr = intval($loop_id_string);
    // echo gettype($loop_nr);
}

// echo $answer_true;

// Conditional debug output: append ?debug=1 to the URL to inspect GET/POST
if (isset($_GET['debug']) && $_GET['debug'] == '1') {
    echo '<pre style="background:#f6f8fa;padding:10px;border:1px solid #ddd;">';
    echo "GET:\n";
    var_dump($_GET);
    echo "\nPOST:\n";
    var_dump($_POST);
    echo "\nSERVER:\n";
    // limit noisy output when not needed
    $server_subset = array_intersect_key($_SERVER, array_flip(['REQUEST_METHOD','REQUEST_URI','HTTP_HOST','REMOTE_ADDR']));
    var_dump($server_subset);
    echo "\nDerived variables:\n";
    echo 'loop_id: ';
    var_dump($loop_id ?? null);
    echo 'answer_true: ';
    var_dump($_POST['answer_true'] ?? null);
    echo '</pre>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['vraag'] ?? '';
    $skills_id = $loop_nr;
    // 2 items for tb_questions.
    // Could expand with allowing a "points to be earned" function, maybe later

    $answer1 = $_POST['answer1'] ?? '';
    $answer2 = $_POST['answer2'] ?? '';
    $answer3 = $_POST['answer3'] ?? '';
    $answer4 = $_POST['answer4'] ?? '';
    $answer_true = $_POST['answer_true'] ?? '';
    // echo $answer_true;
    // Checks if the true answer value is given correctly.


    if ($skills_id && $question
      && $answer1 && $answer2 && $answer3 && $answer4 && $answer_true) {


    try {
        $pdo->beginTransaction();       // zorgt ervoor dat alle queries volledig moeten ingevuld zijn

        $sql = "
            INSERT INTO tb_questions (skills_id, question)
            VALUES (:skills_id, :question)
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':skills_id' => $skills_id,
            ':question' => $question,
        ]);

        // Haalt de variabele van de users.id op en zet deze in $userId, eerst een string, dan veranderen in een integer.
        $question_id = $pdo->lastInsertId();
        $question_id = intval($question_id);
        // echo gettype($userId);       Checks type
        // echo $userId;                Checks value
     
     
        $sql2 = "
            INSERT INTO tb_answers (question_id, answer1, answer2, answer3, answer4, answer_true)
            VALUES (:question_id, :answer1, :answer2, :answer3, :answer4, :answer_true)
        ";

        //  var_dump($firstname);
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([
            ':question_id' => $question_id,
            ':answer1' => $answer1,
            ':answer2' => $answer2,
            ':answer3' => $answer3,
            ':answer4' => $answer4,
            ':answer_true' => $answer_true,

        ]);
    
        $pdo->commit();
        $melding = "Een nieuwe vraag is gemaakt!";
    } catch(Exception $e) {
        $pdo->RollBack();
        $melding = "Vraag registratie mislukt: " . $e->getMessage();
    }
}
}

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
<!-- <style>
    #select_style {
        width: 150px;
    }
</style> -->

<body>
    

    

<p id="vraag_headtext1"> Vraag toevoegen</p>

<div class ="form-container">
<form method="POST" action="vraagmaken.php">
    <!-- CHECK DIT NOG LATER -->

    <div id="MainContainer" style="display: flex; height: 500px; width: 100vw;">
        <div id="PaddingContainer" style="display: flex; flex-direction: justify-content: center; align-items: center; column; gap: 5px; width: 60px; height: 100%;"> </div>
            <div id="LeftContainer" style="display: flex; flex-direction: column;">

    <p id="vraag_headtext2">Vul de vraag in:</p>


            <textarea type="text" id="poep" name="vraag" placeholder="Beschrijf de vraag" required></textarea>
           <br>


            <!--  Loop which gives a dropdown menu of already created skills. -->
           <label for="skillSelect" id="vraag_headtext3">Kies een skill:</label>
           
    <select name="skills" id="select_style">
        <?php foreach ($skillArray as $skillCounter): ?>
            <option value="<?php echo $skillCounter['id']; ?>">
                <?php echo $skillCounter['skill']; ?>
            </option>
        <?php endforeach; ?>
    </select>

          <p id="vraag_headtext2">Welk antwoord is correct?</p>
            <div>
                <input type="radio" id="answer1" name="answer_true" value="answer1">
                <label for="answer1" class="norwester_font">Antwoord 1</label>
                <br>
            </div>  
            
            <div>
                <input type="radio" id="answer2" name="answer_true" value="answer2">
                <label for="answer2" class="norwester_font">Antwoord 2</label>
                <br>
            </div>
            
            <div>
                <input type="radio" id="answer3" name="answer_true" value="answer3">
                <label for="answer3" class="norwester_font">Antwoord 3</label>
                <br>
            </div>

            <div>
                <input type="radio" id="answer4" name="answer_true" value="answer4">
                <label for="answer4" class="norwester_font">Antwoord 4</label>
                <br>
            </div>
            

            <button type="submit" style="margin: 20px;" class="headerbutton">Verzenden</button>
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
// print_r ($skillArray);
echo "\n";
echo "\n";
// echo $skill_id = intval($skillArray);
// echo gettype($skill_id);


?>
</body>

<?php

?>
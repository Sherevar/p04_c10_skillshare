<?php

    require "../Includes/db.php";
    session_start();
    include "../Includes/header.php";

    if (!isset($_SESSION["user_id"])) {
    header("Location: inloggen.php");
    exit;
    }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     var_dump($_POST); // inspect names and values
// }


    $stmt = $pdo->prepare("SELECT id, question FROM tb_questions");
    $stmt->execute();
    $questions = $stmt->fetchAll();

    $stmt2 = $pdo->prepare("SELECT question_id, answer1, answer2, answer3, answer4, answer_true FROM tb_answers");
    $stmt2->execute();
    $answers = $stmt2->fetchAll();

    $stmt3 = $pdo->prepare(
        "SELECT question, answer1, answer2, answer3, answer4, answer_true 
        FROM tb_questions 
        INNER JOIN tb_answers 
        ON tb_questions.id = tb_answers.question_id");
    $stmt3->execute();
    $question_list = $stmt3->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
</head>
<body>


<form method="post" action="quiz.php">
<?php foreach ($question_list as $i => $q): ?>
  <div class="question">
    <p><?php echo htmlspecialchars($q['question']); ?></p>

    <?php for ($a = 1; $a <= 4; $a++):
      $ansKey = "answer{$a}";
      $inputName = "q{$i}";                // group name per question
      $inputId   = "q{$i}_a{$a}";         // unique id per answer
    ?>
      <input type="radio" id="<?php echo $inputId; ?>" name="<?php echo $inputName; ?>" value="<?php echo $a; ?>">
      <label for="<?php echo $inputId; ?>"><?php echo htmlspecialchars($q[$ansKey]); ?></label><br>
    <?php endfor; ?>
  </div>
<?php endforeach; ?>

<input type="submit" value="Submit">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($question_list as $i => $q) {
    $field = "q{$i}";
    if (!isset($_POST[$field])) {
        continue;
    }
    $selected = (string) $_POST[$field];           // "1","2","3","4"
        $correct  = substr($q['answer_true'], 6);      // "1","2","3","4"
        if ($selected === $correct) {
            $score++;
        }
    }
   
    $totalscore = $score / count($question_list) * 100;
    $totalscore = round($totalscore, 0);

    $userId = (int) $_SESSION['user_id'];
    // $skillId = (int) $skill_id;
    $totalscore  = (int) $totalscore;

$skillId = 1; // brute force for "Algemene skills"


$stmt = $pdo->prepare( 
  "INSERT INTO tb_user_skills (user_id, skill_id, points_earned)
   VALUES (?, ?, ?)
   ON DUPLICATE KEY UPDATE points_earned = GREATEST(points_earned, VALUES(points_earned))"
);
$stmt->execute([$userId, $skillId, $totalscore]);
    echo "<p>Your score: {$totalscore}%" .  "</p>";

}
?>

</body>
</html>
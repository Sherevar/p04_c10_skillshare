<?php
    include "../Includes/header.php";
    require "../Includes/db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = $_POST['skill'] ?? '';
    $description = $_POST['description'] ?? '';

    
    echo "<br><br>";
    if ($skill && $description) {
        echo "test try catch.";
// MAKE THIS INTO PROPER QUESTION FORM, RADIO BUTTON ANSWER INCLUDED
    try {
        $sql = "
            INSERT INTO tb_questions (skill, description)
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


            <input type="text" id="skill" name="skill" placeholder="Beschrijf de vraag" style="width: 300px; height: 500px;" required>
            <input type="text" id="description" name="description" placeholder="DROP DOWN MENU VOOR SKILLSET" required>



            <p> Radio Button voor welk antwoord goed is. </p>



            <button type="submit" style="margin: 20px;" id="VerzendBtn">Verzenden</button>
            </div>
        <!-- <div id="MiddleContainer"  style="display: flex; flex-direction: column; gap: 5px; width: 38%; height: 100%;">         
                <input type="text" id="answer1" name="answer1" placeholder="Antwoord 1" style="width: 500px; height: 500px;" required>
                <input type="text" id="answer2" name="answer2" placeholder="Antwoord 2" style="width: 500px; height: 500px;" required>

        </div>
        <div id="RightContainer" style="display: flex; flex-direction: column; gap: 5px; width: 38%; height: 100%;">
                <input type="text" id="answer3" name="answer3" placeholder="Antwoord 3" style="width: 500px; height: 500px;" required>
                <input type="text" id="answer4" name="answer4" placeholder="Antwoord 4" style="width: 500px; height: 500px;" required>
        </div>
        </div> -->
    </div>
</div>





<?php

    $sql2 = "SELECT * FROM tb_skills";
    $all_categories = mysqli_query($sql2);
    
    if(isset($_POST['submit']))
    {
        // Store the Product name in a "name" variable
        $name = mysqli_real_escape_string($con,$_POST['Product_name']);
       
        // Store the Category ID in a "id" variable
        $id = mysqli_real_escape_string($con,$_POST['Category']); 
       
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert = 
        "INSERT INTO `product`(`product_name`, `category_id`)
            VALUES ('$name','$id')";
         
          // The following code attempts to execute the SQL query
          // if the query executes with no errors 
          // a javascript alert message is displayed
          // which says the data is inserted successfully
          if(mysqli_query($sql_insert))
        {
            echo '<script>alert("Product added successfully")</script>';
        }
    }







?>

    <form method="POST">
        <label> Skill categorie:>/label>
        <input type="text" name="Product_name" required><br>
        <label>Selecteer een categorie.</label>
        <select name="skill">
                <?php
                    while ($skill = mysqli_fetch_array(
                        $all_categories,MSQLI_ASSOC)):;
                ?>
                    <option value="<?php echo $skill["id"];
                    ?>">
                        <?php echo $skill["skill"];
                        ?>
                </option>
            <?php
                endwhile;
        ?>
        </select>
        <br>
        <input type="submit" value="submit" name="submit">
    </form>
    <br>
























</body>
</html>
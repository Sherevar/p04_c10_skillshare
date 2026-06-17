<?php 
    include "../Includes/header.php";
    require "../Includes/db.php";
//  Medals.png shown in table

$stmt = $pdo->prepare("SELECT id, skill FROM tb_skills ");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare("SELECT id, username FROM tb_users ");
$stmt2->execute();
$userlist = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $pdo->prepare("SELECT id, user_id, skill_id, points_earned,
    CASE
        WHEN (points_earned >= 90) THEN 'gold'
        WHEN (points_earned >= 70) THEN 'silver'
        WHEN (points_earned >= 50) THEN 'bronze'
        ELSE 'blank'
    END AS Medailles

 FROM tb_user_skills");
$stmt3->execute();
$medallist = $stmt3->fetchAll(PDO::FETCH_ASSOC);


// Check de array van de medailles
// var_dump ($medallist);
// die();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/header.css">   
</head>
<body>
<p id="home_headtext1">MEDAILLES</p>
<table border="1" id="table_positioning">
    <tr>
        <th class="th_style">Gebruikers</th>
            <?php foreach ($data as $column)
                {?> <th class="th_style"> <?php echo $column['skill']; ?>
            <?php } ?>
        </th>
    </tr>
<?php foreach($userlist as $row) {?>
    <tr><td class="td_style"><?php echo $row['username']; ?></td>
    <?php for ($i = 0; $i < count($data); $i++) { ?>
        <td class="td_style">
        <?php foreach($medallist as $medal) {
            if ($medal["user_id"] == $row["id"] && $medal["skill_id"] == $data[$i]["id"]) {?>
                <img class="medalgrade" src="../Media/Medals/<?php echo $medal["Medailles"]?>.png">  
            <?php } ?>    
        <?php } ?>
        </td>   
    <?php }  ?>
    </tr>
<?php } ?>
</table>


</body>
</html>
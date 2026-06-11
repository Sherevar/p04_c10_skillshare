<?php 
    include "../Includes/header.php";
    require "../Includes/db.php";
/*
Grab user
Grab friendlist
Grab skilllist
Grab medals earned
Throw user+friendlist / skilllist in a table
Throw medals in there as well
*/

$stmt = $pdo->prepare("SELECT id, skill FROM tb_skills ");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// GET USER SELF HERE FIRST



$stmt2 = $pdo->prepare("SELECT id, username FROM tb_users ");
$stmt2->execute();
$userlist = $stmt2->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>





<table border="1">
    <tr>
        <th>Gebruikers</th>
        
            
            <?php foreach ($data as $column)
                {?> <th> <?php echo $column['skill']; ?>
            <?php } ?>
        </th>
    </tr>
    
            
        <?php
        //  for $i = 1; $i <= var_dump(count($userlist)); $i++) {
        //     echo $i;
        // }

        ?>

        
        <?php foreach($userlist as $row)
            {?> <tr><td> <?php echo $row['username']; 
            ?></td>
            <?php for ($i = 1; $i <= count($data); $i++) { ?>
                <td></td>   
            <?php } ?>
                </tr>
            <?php }?>
        
</table>
<!-- 


for (loop) {
    echo "item"

    
    for (loop) {
            echo "items"

            echo "cell products"

}
echo "</tr>
}

echo /table

 -->




</body>
</html>
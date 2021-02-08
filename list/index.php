<?php require_once('../includes/config.php');

try {
    $stmt = $db->prepare('SELECT * FROM lists WHERE link = ?');

    $stmt->bindParam(1, $_GET['q']);  
    $stmt->execute(); 
    
    $list = $stmt->fetch();

} catch(PDOException $e) {
    echo $e->getMessage();
} 

    


    $breeds = json_decode($list['data'], true);


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>My Favourite Dogs</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='http://localhost/~tahoe/myfavoritedogs/css/style.css'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css">

</head>

<body class="savedList">

    <header>
        <h1>myfavoritedogs</h1>
        <div id="addList">
            <img src='http://localhost/~tahoe/myfavoritedogs/images/new.svg'>
        </div>
    </header>

    <div class="hero">
        <h2><?php echo $list['name'] ?>'s favorite dogs list</h2>
    </div>

    <?php
    
        foreach ($breeds as $breed) {  

            try {
                $stmt = $db->prepare('SELECT * FROM dogbreeds WHERE slug = ?');

                $stmt->bindParam(1, $breed);  
                $stmt->execute(); 
                
                $breedData = $stmt->fetch();

                
    
            } catch(PDOException $e) {
                echo $e->getMessage();
            }



            echo $breedData["title"];

            ?>
            
            <div class="breedBlock <?php echo $breedData['slug']?>">
                <img src='http://localhost/~tahoe/myfavoritedogs/images/<?php echo $breedData['image']?>'>
                

                <h3><?php echo $breedData['title']?></h3>
            </div>
        <?php
        }
    ?>

</body>

</html>  




















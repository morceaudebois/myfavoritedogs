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



try {
    $stmt = $db->prepare('SELECT image FROM dogbreeds WHERE slug = ?');

    $stmt->bindParam(1, $breeds[0]);  
    $stmt->execute(); 
    
    $mainImage = $stmt->fetch();

} catch(PDOException $e) {
    echo $e->getMessage();
}

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
    <div class="toScreen">
    <?php @include '../header.php'; ?>
    
    <div class="hero">     
        <div class="titleCard" style="background-image: url('<?php echo 'http://localhost/~tahoe/myfavoritedogs/images/' . $mainImage[0]?>')">
            <div class="gradient"></div>
            <h1 class="title"><?php echo $list['name'] ?>'s favorite dogs list</h1>
        </div>
        
    </div>

    <main>
        <div class="breedGrid">
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
        ?>

            <div class="breedBlock <?php echo $breedData['slug']?>">
                <img src='http://localhost/~tahoe/myfavoritedogs/images/<?php echo $breedData['image']?>'>

                

                <h3><?php echo $breedData['title']?></h3>
                <span class="medal"></span>

                
            </div>

            <?php } ?>
        </div>
    </main>

    <!-- <button onclick="screen()">Screenshot</button>
    </div> -->
    

    <div class="screenshotContainer"></div>

    <div class="overlay"></div>
    <?php @include '../footer.php' ?>

    <script src='../includes/html2canvas.min.js'></script>
    <script src='http://localhost/~tahoe/myfavoritedogs/list/list.js'></script>
  

</body>

</html>  




















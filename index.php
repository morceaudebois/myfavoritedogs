<?php require_once('includes/config.php');

try {
    $stmt = $db->prepare('SELECT * FROM dogtags');

    $stmt->execute(array());
    
    $tags = $stmt->fetchAll();

} catch(PDOException $e) {
    echo $e->getMessage();
} 

$index = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>My Favorite Dogs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo $homeURL . "/css/style.css" ?>'>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css"> -->

</head>
<body>
    
    <?php @include 'header.php'; ?>


    <section class="allDogs">

        <div class="bigTitle">
            <h2>All the dogs</h2> <div class="hr"></div>
            <p>Select your favorite dog breeds.</p>
        </div>
            
        <?php foreach ($tags as $tag) { ?>

        <button class="accordion">
            
            <span><?php echo $tag['name'] ?></span>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.8 59.3"><path d="M41,57.2,2,18.2A6.8,6.8,0,0,1,2,8.5H2L8.5,2a6.8,6.8,0,0,1,9.7,0h0L45.9,29.7,73.5,2a6.8,6.8,0,0,1,9.7,0h.1l6.4,6.5a6.9,6.9,0,0,1,.1,9.7h-.1l-39,39a6.8,6.8,0,0,1-9.6.1Z" transform="translate(0 0)" fill="#505050"/></svg>
        </button>
        

        <div class="accordion-content">

            <div class="breedGrid">
            <?php 
            
                try {
                    // Va chercher les infos textes
                    $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN dogbreeds_meta ON dogbreeds.id = dogbreeds_meta.breed_id WHERE dogbreeds_meta.tag_id =' . $tag['tag_id']);
        
                    $stmt->execute(array());
                    
                    $breeds = $stmt->fetchAll();

                    // va chercher les photos
                    $stmt = $db->prepare('SELECT breed_id, photo_url FROM photos');
                    $stmt->execute(array());
                    $breedPhotos = $stmt->fetchAll();

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                
                // va chercher l'URL de la photo correspondante
                foreach ($breeds as $breed) { 
                    foreach($breedPhotos as $breedPhoto) {
                        if ($breedPhoto['breed_id'] === $breed['breed_id']) {
                            $photo_url = $breedPhoto['photo_url'];
                        }
                    }
                ?>

                    <div class="breedBlock <?php echo $breed['slug']?>">
                        
                        <img src='<?php echo $homeURL . "/images/" . $photo_url ?>'>
                        <label><input type="checkbox" value="<?php echo $breed['slug']?>"><span class="checkmark"></span></label>

                        <h3><?php echo $breed['title']?></h3>
                    </div>

                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </section>

    <?php @include 'pannel.php' ?>



    <div class="overlay"></div>

    



<?php @include 'footer.php' ?>
     
</body>
</html>
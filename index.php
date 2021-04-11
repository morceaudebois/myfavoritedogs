<?php require_once('includes/config.php');

try {
    $stmt = $db->prepare('SELECT * FROM dogtags ORDER BY name');

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
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>My Favorite Dogs · Make your list</title>
    <meta name="description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends."/>

    <!-- Open graph for social media -->
	<meta property="og:type" content="tool">
	<meta property="og:title" content="My Favorite Dogs · Make your list">
	<meta property="og:url" content="<?php echo $homeURL ?>">
	<meta property="og:image" content="<?php echo $homeURL . "/images/tarkan.jpg"?>">
    
    <meta name="twitter:card" content="summary_large_image"></meta>
    <meta name="twitter:title" content="My Favorite Dogs · Make a list of your favorite dog breeds"></meta>
    <meta name="twitter:creator" content="@morceaudebois" />
    <meta name="twitter:description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends!"></meta>
    <meta name="twitter:image" content="<?php echo $homeURL . "/images/tarkan.jpg"?>" />


    
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $homeURL . '/images/favicons/apple-touch-icon.png' ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $homeURL . '/images/favicons/favicon-32x32.png' ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $homeURL . '/images/favicons/favicon-16x16.png' ?>">
    <link rel="manifest" href="<?php echo $homeURL . '/images/favicons/site.webmanifest' ?>">
    <link rel="mask-icon" href="<?php echo $homeURL . '/images/favicons/safari-pinned-tab.svg' ?>" color="#9dc88d">
    <link rel="shortcut icon" href="<?php echo $homeURL . '/images/favicons/favicon.ico' ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="<?php echo $homeURL . '/images/favicons/browserconfig.xml' ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo $homeURL . "/css/style.css" ?>'>

</head>
<body class="noSelection">
    
    <?php @include 'header.php'; ?>


    <section class="allDogs">

        <div class="bigTitle">
            <h2>All the dogs</h2> <div class="hr"></div>
            <p>Select your favorite dog breeds and share the list with your friends!</p>
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
                    $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN dogbreeds_meta ON dogbreeds.id = dogbreeds_meta.breed_id WHERE dogbreeds_meta.tag_id =' . $tag['tag_id'] . ' ORDER BY title');
        
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
                        
                        <img draggable='false' loading="lazy" src='<?php echo $homeURL . "/images/small/" . $photo_url ?>'>
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
<?php require_once('../src/php/config.php');
    $db = new PDO('sqlite:../myfavoritedogs.db');

    try {
        $stmt = $db->prepare('SELECT * FROM lists WHERE link = :link');
        $stmt->execute(array(':link' => $_GET['q']));
        $list = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $breeds = json_decode(stripslashes($list['data']));

    try {
        $stmt = $db->prepare('SELECT photo_url FROM photos 
            INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id 
            WHERE dogbreeds.slug = :slug');
        $stmt->execute(array(':slug' => $breeds[0]));

        $mainImage = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title><?php echo $list['name'] ?>'s favorite dogs list · My Favorite Dogs</title>
    <meta name="description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends."/>

    <!-- Open graph for social media -->
	<meta property="og:type" content="tool">
	<meta property="og:title" content="<?php echo $list['name'] ?>'s favorite dogs list">
	<meta property="og:url" content="<?php echo $escaped_url ?>">
	<meta property="og:image" content="<?php echo $homeURL . "/src/images/" . $mainImage['photo_url'] ?>">
    
    <meta name="twitter:card" content="summary_large_image"></meta>
    <meta name="twitter:title" content="<?php echo $list['name'] ?>'s favorite dogs list · My Favorite Dogs"></meta>
    <meta name="twitter:creator" content="@morceaudebois" />
    <meta name="twitter:description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover <?php echo $list['name'] ?>'s favorite dogs!"></meta>
    <meta name="twitter:image" content="<?php echo $homeURL . "/src/images/" . $mainImage['photo_url'] ?>" />



    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $homeURL . '/src/images/favicons/apple-touch-icon.png' ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $homeURL . '/src/images/favicons/favicon-32x32.png' ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $homeURL . '/src/images/favicons/favicon-16x16.png' ?>">
    <link rel="manifest" href="<?php echo $homeURL . '/src/images/favicons/site.webmanifest' ?>">
    <link rel="mask-icon" href="<?php echo $homeURL . '/src/images/favicons/safari-pinned-tab.svg' ?>" color="#9dc88d">
    <link rel="shortcut icon" href="<?php echo $homeURL . '/src/images/favicons/favicon.ico' ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="<?php echo $homeURL . '/src/images/favicons/browserconfig.xml' ?>">

    
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo $homeURL . "/src/styles/style.css" ?>'>

</head>

<body class="savedList">
    <div class="toScreen">
    <?php @include '../header.php'; ?>
    
    <div class="hero">     
        <div class="titleCard" style="background-image: url('<?php echo $homeURL . "/src/images/" . $mainImage['photo_url'] ?>')">

            <div class="gradient"></div>
            <h1 class="title"><?php echo $list['name'] ?>'s favorite dogs list</h1>
        </div>
    </div>

    <main>
        <div class="breedGrid">
        <?php 
        
            foreach ($breeds as $breed) { 
                try {
                    $stmt = $db->prepare('SELECT * FROM dogbreeds WHERE slug = :slug');
                    $stmt->execute(array(':slug' => $breed)); 
                    
                    $breedData = $stmt->fetch();

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

                try {
                    $stmt = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds WHERE dogbreeds.id = photos.breed_id AND dogbreeds.slug = ?');

                    $stmt->bindParam(1, $breed);  
                    $stmt->execute(); 
                    
                    $breedPhoto = $stmt->fetch();

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
        ?>

            <div class="breedBlock <?php echo $breedData['slug']?>">
                <img src='<?php echo $homeURL . "/src/images/small/" . $breedPhoto['photo_url']?>'>

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

    <script src='/src/js/html2canvas.min.js'></script>
    <script src='<?php echo $homeURL . "/src/js/list.js" ?>'></script>

</body>

</html>
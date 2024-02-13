<?php require_once('src/php/config.php');
    $db = new PDO('sqlite:myfavoritedogs.db');

    $query = isset($_GET['q']) ? $_GET['q'] : false;

    if (isset($query)) {
        try {
            $stmt = $db->prepare('SELECT * FROM lists WHERE link = :link');
            $stmt->execute(array(':link' => $query));
            $list = $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    if (!$list) {
        include '404.php';
        exit;
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

    $pageTitle = "{$list['name']}'s favorite dogs list";
    $thumbnail = $homeURL . "/src/images/medium/" . $mainImage['photo_url'] . '.webp';
    $bodyClasses = 'savedList';
    include 'header.php';
?>
    
<div class="hero">     
    <div class="titleCard" style="background-image: url('<?= $homeURL . "/src/images/large/" . $mainImage['photo_url'] ?>.jpg')">

        <div class="gradient"></div>
        <h1 class="title"><?= $list['name'] ?>'s favorite dogs list</h1>
    </div>
</div>

<main>
    <div class="breedGrid">
    <?php 
    
        foreach ($breeds as $key=>$breed) { 
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
            } ?>

            <div class="breedBlock <?= $breedData['slug']?>">
                <img src='<?= $homeURL . "/src/images/medium/" . $breedPhoto['photo_url']?>.webp'>

                <h4><?= $breedData['title']?></h4>
                <span class="medal"><?= $key + 1 ?></span>
                
            </div>

        <?php } ?>
    </div>

    <?php include 'notice.php' ?>
</main>

<div class="overlay"></div>

<?php include 'footer.php' ?>
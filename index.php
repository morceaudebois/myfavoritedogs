<?php require_once('src/php/config.php');
    $db = new SQLite3('myfavoritedogs.db');
    $tags = $db->query('SELECT * FROM dogtags ORDER BY name');

    $index = 0;
    
    $bodyClasses = 'noSelection homepage';
    include 'header.php';
?>

<main class="allDogs">

    <div class="bigTitle">
        <h2>All the dogs</h2>
        <div class="hr"></div>
        <p>Select your favorite dog breeds and share the list with your friends!</p>
    </div>

    <?php $iBreed = 0; while ($tag = $tags->fetchArray()) { ?>
        <section>
            <button class="accordion <?= $iBreed === 0 ? 'isOpen init' : '' ?>">
                <h3><?= $tag['name'] ?></h3>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.8 59.3">
                    <path d="M41,57.2,2,18.2A6.8,6.8,0,0,1,2,8.5H2L8.5,2a6.8,6.8,0,0,1,9.7,0h0L45.9,29.7,73.5,2a6.8,6.8,0,0,1,9.7,0h.1l6.4,6.5a6.9,6.9,0,0,1,.1,9.7h-.1l-39,39a6.8,6.8,0,0,1-9.6.1Z" transform="translate(0 0)" fill="#505050" />
                </svg>
            </button>

            <div class="accordion-content" <?= $iBreed === 0 ? 'style="max-height: 100%;"' : '' ?>>
                <div class="breedGrid">
                    <?php

                    // va chercher toutes les races
                    $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN dogbreeds_meta ON dogbreeds.id = dogbreeds_meta.breed_id WHERE dogbreeds_meta.tag_id = :tag_id ORDER BY title');
                    $stmt->bindValue(':tag_id', $tag['tag_id'], SQLITE3_INTEGER);
                    $breeds = $stmt->execute();

                    // va chercher les photos des races
                    $breedPhotos = $db->query('SELECT breed_id, photo_url FROM photos');


                    // va chercher l'URL de la photo correspondante
                    $iDog = 0;
                    while ($breed = $breeds->fetchArray()) {
                        while ($breedPhoto = $breedPhotos->fetchArray()) {
                            if ($breedPhoto['breed_id'] === $breed['breed_id']) {
                                $photo_url = $breedPhoto['photo_url'];
                            }
                        } ?>

                        <div class="breedBlock <?= $breed['slug'] ?>">

                            <img draggable='false' <?= ($iBreed === 0 && $iDog < 3) ? '' : 'loading="lazy"' ?> src='<?= $homeURL . "/src/images/medium/" . $photo_url ?>.webp' width='300px' height='300px'>
                            <label><input type="checkbox" autocomplete="off" value="<?= $breed['slug'] ?>"><span class="checkmark"></span></label>

                            <h4><?= $breed['title'] ?></h4>
                        </div>
                    <?php $iDog++; } ?>

                </div>
            </div>
        </section>
        
    <?php $iBreed++; } ?>
</main>

<div class="overlay"></div>

<?php 
    include 'panel.php';
    include 'footer.php';
?>
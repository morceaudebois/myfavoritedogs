<?php require_once('includes/config.php');

try {
    $stmt = $db->prepare('SELECT * FROM dogtags');

    $stmt->execute(array());
    
    $tags = $stmt->fetchAll();

} catch(PDOException $e) {
    echo $e->getMessage();
} ?>

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
<body class="open">
    
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
                    $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN dogbreeds_meta ON dogbreeds.id = dogbreeds_meta.breed_id WHERE dogbreeds_meta.tag_id =' . $tag['tag_id']);
        
                    $stmt->execute(array());
                    
                    $breeds = $stmt->fetchAll();
        
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                
                foreach ($breeds as $breed) { ?>

                <div class="breedBlock <?php echo $breed['slug']?>">
                    <img src='http://localhost/~tahoe/myfavoritedogs/images/<?php echo $breed['image']?>'>

                    <label><input type="checkbox" value="<?php echo $breed['slug']?>"><span class="checkmark"></span></label>
                    

                    <h3><?php echo $breed['title']?></h3>
                </div>

                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </section>

    <div id="pannel">
        <div class="bottom">
            <div id="compteur">No breed selected.</div>
            <button onclick="document.body.classList.toggle('open');" class="niceBtn">my list</button>
        </div>

        <div class="list">
            <div class="bigTitle">
                <h2>My list</h2> <hr>
            </div>

            <ul id="items"></ul>
        </div>
        
        <div class="saveList">
            <div class="bigTitle">
                <h2>Save your list</h2> <hr>
            </div>
    

            <div class="doubleContainer nameContainer">
                <div class="half">
                    <div class="fieldContainer">
                        <label for="name">What's your name?</label>
                        <input type="text" id="name" name="name" minlength="4" maxlength="20" size="10" placeholder="Michael">

                    </div>
                </div>

                <div class="half">
                    <button id="genLink" class="niceBtn">Generate link</button>
                </div>
            </div>


            <div class="doubleContainer linkContainer">
                <div class="half">
                    <div class="fieldContainer">
                        <label for="link">Here's your link!</label>
                        <input type="text" id="link" name="link">
                    </div>
                </div>

                <div class="half">
                    <button id="copyLink" class="niceBtn" onclick='copyLink()'>Copy link</button>
                </div>
            </div>

            <span id="error"></span>
            

            
            <!-- <div id="result">
                <label for="link">Your permanent link</label>
                <input type="text" id="link" name="link" minlength="4" maxlength="20" size="20" placeholder="#">
                <button>Copy</button>
            </div> -->

            <br>


            <div id="share">
                <div class="bigTitle">
                    <h2>Share your list</h2> <hr>
                </div>

                <div class="socialContainer">
                    <a target="_blank" class="socialBlock" id="twitterBlock">
                        <img src="http://localhost/~tahoe/myfavoritedogs/images/twitter.svg">
                        <span>Twitter</span>
                    </a>

                    <a target="_blank" class="socialBlock" id="facebookBlock">
                        <img src="http://localhost/~tahoe/myfavoritedogs/images/facebook.svg">
                        <span>Facebook</span>
                    </a>

                    <a target="_blank" class="socialBlock" id="telegramBlock">
                        <img src="http://localhost/~tahoe/myfavoritedogs/images/telegram.svg">
                        <span>Telegram</span>
                    </a>
                </div>
            </div>

            

            

        </div>
        
        
    </div>



    <div class="overlay"></div>

    















<?php @include 'footer.php' ?>
     
</body>
</html>
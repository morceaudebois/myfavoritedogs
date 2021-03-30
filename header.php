<header>
    <div class="container">
        <a href="<?php echo $homeURL ?>"><h1>myfavoritedogs</h1></a>

        <?php
        $url = $_SERVER['REQUEST_URI'];    


        if (strpos($url, 'list') !== false) { ?>
            <a id="addList" title="Create my own list" href="<?php echo $homeURL ?>">
                <img src='http://localhost/~tahoe/myfavoritedogs/images/new.svg'>
            </a>
        <?php }  ?>
        
    </div>
    
</header>
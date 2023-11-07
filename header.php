<header>
    <div class="container">
        <a href="<?= $homeURL ?>"><h1>myfavoritedogs</h1></a>

        <?php $url = $_SERVER['REQUEST_URI'];    

        if (strpos($url, 'list') !== false) { ?>
            <a id="addList" title="Create my own list" href="<?= $homeURL ?>">
                <img src='<?= $homeURL . "/images/new.svg" ?>'>
            </a>
        <?php }  ?>
    </div>
</header>
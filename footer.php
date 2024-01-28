<?php if (!isset($bodyClasses) || (isset($bodyClasses) && !str_contains($bodyClasses, 'homepage'))) { 
    include 'notice.php'; 
} ?>


<footer>
    <div class="doubleContainer">
        <div class="half">
            <p>myfavoritedogs is an <a href="https://github.com/morceaudebois/myfavoritedogs">open source project</a> that relies on donations to keep on going.<br>If you like the idea, please consider <a href="https://ko-fi.com/tahoe">donating</a> 😊</p>
        </div>

        <div class="half">
            <p>Made in France by <a href="https://tahoe.be/">Tahoe Beetschen</a>
                <br>Check out the <a href="<?= $homeURL . "/credits.php" ?>">photo credits</a>
            </p>
        </div>
    </div>
</footer>

<script src='<?= $homeURL . "/src/js/scripts.js" ?>'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js'></script>

</body></html>
<div id="panel">
    <div class="bottom">
        <div id="compteur">No breed selected</div>
        <button id="myListBtn" class="niceBtn">my list</button>
    </div>

    <div class="list">
        <div class="bigTitle">
            <h2>My list</h2> <div class="hr"></div>
        </div>

        <ul id="items"></ul>
    </div>
    
    <div class="saveList">
        <div class="bigTitle">
            <h2>Save & share your list</h2> <div class="hr"></div>
        </div>

        <div class="doubleContainer nameContainer">
            <div class="half">
                <div class="fieldContainer">
                    <label for="name">What's your name?</label>
                    <input type="text" id="name" name="name" minlength="4" maxlength="20" size="10" placeholder="Jean-Pierre" autocomplete="off">
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
                    <input type="text" id="link" name="link" autocomplete="off">
                </div>
            </div>

            <div class="half">
                <button id="copyLink" class="niceBtn">Copy link</button>
            </div>
        </div>

        <span id="error"></span>
        
        <div id="share">
            <div class="bigTitle">
                <h2>Share your list</h2> <div class="hr"></div>
            </div>

            <div class="socialContainer">
                <a target="_blank" class="socialBlock" id="twitterBlock" title="Share on Twitter">
                    <img draggable='false' src="<?= $homeURL . "/src/images/twitter.svg" ?>">
                    <span>Twitter</span>
                </a>

                <a target="_blank" class="socialBlock" id="facebookBlock" title="Share on Facebook">
                    <img draggable='false' src="<?= $homeURL . "/src/images/facebook.svg" ?>">
                    <span>Facebook</span>
                </a>

                <a target="_blank" class="socialBlock" id="telegramBlock" title="Share on Telegram">
                    <img draggable='false' src="<?= $homeURL . "/src/images/telegram.svg" ?>">
                    <span>Telegram</span>
                </a>
            </div>
        </div>
    </div>
</div>
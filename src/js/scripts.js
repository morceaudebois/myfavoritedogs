id = name => document.getElementById(name)
cl = name => document.getElementsByClassName(name)
all = name => document.querySelectorAll(name)
const baseURL = window.location.origin + window.location.pathname
const list = id('items')

function addScreenWidthClasses() {
    if (window.innerWidth < 489) {
        document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop')
        document.body.classList.add('mobile')
    } else if (window.innerWidth < 768) {
        document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop')
        document.body.classList.add('smallTablet')
    } else if (window.innerWidth < 992) {
        document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop')
        document.body.classList.add('tablet')
    } else {
        document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop')
        document.body.classList.add('desktop')
    }
}

window.addEventListener('resize', function () {
    addScreenWidthClasses()
})

document.addEventListener("DOMContentLoaded", (event) => {

    addScreenWidthClasses()

    // homepage only
    if (event.target.activeElement.classList.contains('homepage')) {
        // retourne la place d'un li
        function getIndex(node) {
            let children = node.parentNode.children;

            for (i = 0; i < children.length; i++) {
                if (node == children[i]) break;
            }
            return i + 1;
        }

        window.onload = function () {
            // accordéon volé
            const accordionBtns = all('.accordion');
            let index = 0;
            accordionBtns.forEach((accordion) => {

                function toggleAccordion(e) {
                    if (!e.classList.contains('init')) {
                        e.classList.toggle('isOpen');

                        let content = e.parentNode.querySelector('.accordion-content')
                        if (content.style.maxHeight) {
                            //this is if the accordion is open
                            content.style.maxHeight = null;
                        } else {
                            //if the accordion is currently closed
                            content.style.maxHeight = content.scrollHeight + 'px';
                        }
                    } else e.classList.remove('init') // si c'est le premier, activé par défaut en PHP, n'y touche pas la première fois
                }

                accordion.onclick = function (e) {
                    // all('.accordion.isOpen').forEach(function (openAccordion) {
                    //     toggleAccordion(openAccordion)
                    // })

                    toggleAccordion(e.currentTarget)
                    // e.currentTarget.scrollIntoView({ inline: "start" })
                }

                // ouvre le premier au chargement 
                if (index === 0) { accordion.click(); } index++;

                // fix le responsive
                document.getElementsByTagName('body')[0].onresize = function () {
                    let areOpen = all('.isOpen');

                    areOpen.forEach((isOpen) => {
                        let content = isOpen.nextElementSibling;
                        content.style.maxHeight = content.scrollHeight + 'px';
                    })
                };

            });

            addScreenWidthClasses();

            let values = JSON.parse(localStorage.getItem("breeds"));

            // s'il y a quelque chose dans le storage, cocher + mettre dans la liste
            if (values) {
                values.forEach((value) => { check(value) })
            }


        };

        (function () {
            // when inputs get clicked on
            all('input[type="checkbox"]').forEach((checkbox) => {
                checkbox.onchange = function () {

                    // checks or unchecks everything at once
                    let toChecks = all('input[value="' + checkbox.value + '"');
                    toChecks.forEach((toCheck) => { toCheck.checked = this.checked; });

                    updatepanel(checkbox.value);

                };
            });
        })();





        function updatepanel(breedSlug) {

            // retire le li déjà existant si décoché
            if (document.querySelector('.list ul li.' + breedSlug)) {
                document.querySelector('.list ul li.' + breedSlug).remove();
                listIndexes(); sendToStorage(); counter();
                // va chercher les infos dans la bdd et ajoute le li
            } else {
                getData().then(function (response) {
                    let breedData = JSON.parse(response);

                    let fullLi = '<li class="' + breedData['slug'] + '"><div class="delete" onclick="check(\'' + breedData['slug'] + '\')"><img draggable="false" src="' + baseURL + 'src/images/moins.svg"></div><div class="breed"><img draggable="false" class="breedImage" width="300px" height="300px" src="' + baseURL + 'src/images/small/' + breedData['photo_url'] + '.jpg"><span><span class="place"></span><span> - ' + breedData['name'] + '</span></span><div class="dragZone"><img draggable="false" class="dragIcon" src="' + baseURL + 'src/images/drag.svg"></div></div></li>';
                    list.insertAdjacentHTML('beforeend', fullLi);

                    listIndexes(); sendToStorage(); counter();

                }).catch(function (req) {
                    console.log('Can\'t get data: ' + req);
                });
            }

            function getData() {
                return new Promise(function (resolve, reject) {

                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // resolve((baseURL + 'images/small/' + this.responseText).replace(/\s/g, ''));
                            resolve(this.responseText);
                        }
                    };

                    xhttp.open("GET", "getdata.php?q=" + breedSlug, true);
                    xhttp.send();
                });
            }
        }

        //compteur de races & panel behaviour
        function counter() {
            let elements = all('#items > li');

            // ajoute dans le compteur
            if (elements.length === 0) {
                document.body.classList.remove('open')
                document.body.classList.add('noSelection')
            } else if (elements.length === 1) {
                id('compteur').innerHTML = elements.length + ' breed selected'
                document.body.classList.remove('noSelection')
            } else {
                id('compteur').innerHTML = elements.length + ' breeds selected'
                document.body.classList.remove('noSelection')
            }

            if (elements.length > 5) {
                document.body.classList.add('longList')
            } else {
                document.body.classList.remove('longList')
            }
        }

        // donne leur place aux éléments de la liste
        function listIndexes() {
            // pour chaque li, trouver sa place
            all('#items > li').forEach((element) => {
                let place = element.querySelector('.place');
                place.innerHTML = '#' + getIndex(element);
            })
        }

        // liste drag and sort
        if (list) {
            Sortable.create(list, {
                animation: 150,
                delay: 100,
                delayOnTouchOnly: true,
                handle: '.breed',
                onEnd: function () {
                    listIndexes();
                    sendToStorage();

                    cl('nameContainer')[0].style.display = "flex";
                    cl('linkContainer')[0].style.display = "none";
                    id('copyLink').innerHTML = 'Copy link';
                    id('share').style.display = "none";
                }
            });
        }


        // retourne les slugs de la liste
        function getFullList() {
            let names = [];

            all('#items > li').forEach((element) => {
                names.push(element.classList.toString());
            })

            names = [...new Set(names)];

            return names;
        }

        function sendToStorage() {
            // reset le storage
            localStorage.clear();
            localStorage.setItem("breeds", JSON.stringify(getFullList()));
        }

        function panel() {
            document.body.classList.toggle('open');
            id('panel').scrollTop = 0; // For Safari
        }

        document.querySelector('.overlay').addEventListener('click', () => {
            panel()
        })

        id('myListBtn').addEventListener('click', () => {
            panel(this)
        })

        // enter dans l'input
        id('name').onkeyup = function (e) {
            if (e.keyCode == 13) {
                genLink(e);
            }
        }

        // clic sur le bouton de génération de lien
        id("genLink").addEventListener('click', (e) => {
            genLink(e);
        });

        // gère la génération de lien
        function genLink(e) {
            // si la liste est vide
            if (localStorage.getItem("breeds").length === 2) {
                id('error').style.display = "block";
                id('error').innerHTML = "Your list is empy!";
                // si aucun nom n'est entré
            } else if (!id("name").value) {
                id('error').style.display = "block";
                id('error').innerHTML = "Please enter your name.";
                // si nom entré + clic par humain
            } else if (e.isTrusted) {
                id('error').style.display = "none";

                let timerId;

                //Reset Timeout if function is called before it ends
                if (!(timerId == null)) {
                    clearTimeout(timerId);
                }

                timerId = setTimeout(function () {
                    //Place code that you don't want to get spammed here

                    // envoie les données en ajax dans la BDD
                    let values = localStorage.getItem("breeds");

                    var xhttp;

                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // document.getElementById("result").innerHTML = this.responseText;
                            cl('nameContainer')[0].style.display = "none";
                            cl('linkContainer')[0].style.display = "flex";

                            id('link').value = this.responseText;

                            id('share').style.display = "block";
                            id('twitterBlock').href = "https://twitter.com/intent/tweet?text=Here's%20a%20list%20of%20my%20favorite%20dog%20breeds! " + this.responseText;
                            id('facebookBlock').href = "https://www.facebook.com/sharer/sharer.php?u=" + this.responseText;
                            id('telegramBlock').href = "https://t.me/share/url?url=" + this.responseText + "&text=" + "Here's a list of my favorite dog breeds!";


                        }
                    };

                    xhttp.open("GET", "senddata.php?q=" + values + "|" + id("name").value, true);
                    xhttp.send();

                }, 200); //200ms Timeout
                // si pas clic par humain
            } else {
                id('error').style.display = "block";
                id('error').innerHTML = "Go away, bot.";
            }
        }

            // clean but doesn't work on Safari iOS
        // function copyToClipboard(text) {
        //     navigator.clipboard.writeText(text)
        //         .then(() => {
        //             console.log('Text copied to clipboard:', text)
    
        //             setTimeout(function () {
        //                 id('copyLink').innerHTML = 'Copy link'
        //             }, 3000);

        //             id('copyLink').innerHTML = 'Link copied!'
        //         })
        //         .catch(err => {
        //             console.error('Error copying text to clipboard:', err);
        //         })
        // }

            // gross ChatGPT version that works on Safari iOS
        function copyToClipboard(text) {
            const el = document.createElement('textarea')
            el.value = text;
            el.setAttribute('readonly', '')
            el.style.position = 'absolute'
            el.style.left = '-9999px'
            document.body.appendChild(el)

            el.select()
            document.execCommand('copy')
            document.body.removeChild(el)

            console.log('Text copied to clipboard:', text)

            setTimeout(function () {
                id('copyLink').innerHTML = 'Copy link'
            }, 3000)

            id('copyLink').innerHTML = 'Link copied!'
        }

        id('copyLink').addEventListener('click', () => {
            copyToClipboard(id('link').value)
        })
    }

    // bouton back to top
    document.querySelector('#backtotop').addEventListener("click", function () {
        window.scrollTo({ top: 0 })
    })
})

// clique sur une race 
function check(breed) {
    document.querySelector('input[value="' + breed + '"').click()
}













all('.breedBlock label').forEach(function(label) {
    // label.addEventListener('touchmove', function (event) {
    //     console.log(label)
    //     event.preventDefault()
    // });

    // label.addEventListener('touchend', function (event) {
    //     event.preventDefault();
    //     var checkbox = label.querySelector('input');
    //     checkbox.checked = !checkbox.checked; // Toggle checkbox state
    // });
})
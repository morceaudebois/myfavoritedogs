id = name => document.getElementById(name);
cl = name => document.getElementsByClassName(name);

const list = document.getElementById('items');

function resetList() { list.innerHTML = ''; }

// accordéon volé
const accordionBtns = document.querySelectorAll('.accordion');
accordionBtns.forEach((accordion) => {
  accordion.onclick = function () {
    
    this.classList.toggle('isOpen');
    let content = this.nextElementSibling;
    if (content.style.maxHeight) {
      //this is if the accordion is open
      content.style.maxHeight = null;
    } else {
      //if the accordion is currently closed
      content.style.maxHeight = content.scrollHeight + 'px';
    }
  };
});

// retourne les slugs de la liste
function getValues(origin) {
    let elements;
    let names = [];

    if (origin === "checkboxes") {
      elements = document.querySelectorAll('input[type="checkbox"]:checked');
      elements.forEach((element) => {
        names.push(element.value.toString());
      })
    } else if (origin === "list") {
      elements = document.querySelectorAll('#items > li');
      elements.forEach((element) => {
        names.push(element.classList.toString());
      })
    }
    
    names = [...new Set(names)];
    
    return names;
}



// retourne la place d'un li
function getIndex(node) {
    let children = node.parentNode.children;
  
    for (i = 0; i < children.length; i++) {
      if (node == children[i]) break;
    }
    return i + 1;
  }

  
// donne leur place aux éléments de la liste
function listIndexes() {
    let elements = document.querySelectorAll('#items > li');

    // pour chaque li, trouver sa place
    elements.forEach((element) => {
        let place = element.querySelector('.place');
        place.innerHTML = '#' + getIndex(element);
    })
}




// mise à jour de la liste
// c'est sûrement pas ouf mais je vois pas comment faire autrement
function sendToList(breedSlug) {
    let breedData = document.querySelector('.' + breedSlug).children;
    let breedName = breedData[2].innerHTML;
    let breedImage = breedData[0].currentSrc;

    let fullLi = '<li class="' + breedSlug + '"><div class="delete" onclick="del(this.parentNode)"><img src="http://localhost/~tahoe/myfavoritedogs/images/moins.svg"></div><div class="breed"><img class="breedImage" src="' + breedImage + '"><span><span class="place"></span> - ' + breedName + '</span><img class="dragIcon" src="http://localhost/~tahoe/myfavoritedogs/images/drag.svg"></div></li>'; 

    list.insertAdjacentHTML('beforeend', fullLi);
}



// Actions quand les checkbox changent 
let checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach((checkbox) => {

    // coche les checkbox identiques
    checkbox.addEventListener("change", checkToo);
    function checkToo() {
        // trouve toutes les checkbox qui ont la même valeur que celle cliquée
        let toCheck = document.querySelectorAll('input[value="' + checkbox.value + '"');

        toCheck.forEach((value) => {
            // clique sur les checkbox qui ne sont pas celle cliquée
            if (value != checkbox) {
              value.click();
            }
        });
    }

    // met à jour la liste
    checkbox.addEventListener("change", updateList);
});


function del(element) {
  let toUncheck = document.querySelectorAll('input[value="' + element.className + '"');

  // uncheck un input, les autres se décochent automatiquement grâce à checkToo()
  toUncheck[0].click();
}


function updateList() {
    resetList();

    getValues("checkboxes").forEach((value) => {
        sendToList(value);
    })

    listIndexes();
    counter();
    sendToStorage();
}



//compteur de races
function counter() {
  // ajoute dans le compteur
  if (getValues("checkboxes").length === 0) {
    id('compteur').innerHTML = 'No breed selected.';
  } else if (getValues("checkboxes").length === 1) {
    id('compteur').innerHTML = getValues("checkboxes").length + ' breed selected.';
  } else {
    id('compteur').innerHTML = getValues("checkboxes").length + ' breeds selected.';
  }
}


function sendToStorage() {
    // reset le storage
    localStorage.clear();
    localStorage.setItem("breeds", JSON.stringify(getValues("list")));
}


// liste drag and sort
let sortable = Sortable.create(list, {
    animation: 150,
    onEnd: function() {
        listIndexes();
        sendToStorage();
    }
});



window.onload = function() {
  
  let values = JSON.parse(localStorage.getItem("breeds"));

  // s'il y a quelque chose dans le storage, cocher + mettre dans la liste
  if (values) {
    values.forEach((value) => {
        // recoche les cases à partir du local storage
        checkboxes.forEach((checkbox) => {
          if (checkbox.value === value) {
            checkbox.checked = true;
          }
        });
        sendToList(value);
        counter();
        listIndexes();
      })
  }







  
};


// clic sur le bouton de génération de lien
id("genLink").addEventListener('click', (e) => {
  if (e.isTrusted) {
    let timerId;

    //Reset Timeout if function is called before it ends
    if (!(timerId == null)) {
      clearTimeout(timerId);
    }

    timerId = setTimeout(function () {
      //Place code that you don't want to get spammed here

      // envoie les données en ajax dans la BDD
      let values = localStorage.getItem("breeds");
      let name = id("name").value;

      var xhttp;

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("result").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "senddata.php?q=" + values + "|" + name, true);
      xhttp.send();

    }, 200); //200ms Timeout

  }
});







  

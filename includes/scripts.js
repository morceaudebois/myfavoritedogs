id = name => document.getElementById(name);
cl = name => document.getElementsByClassName(name);


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






// compteur de races
function countChecked() {
  let checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');

  // compte les valeurs et retire les dupliquées
  let values = [];
  checkedBoxes.forEach((checkedBox) => {
    values.push(checkedBox.value);
  });

  values = [...new Set(values)];
  
  // ajoute dans le compteur
  if (!values) {
    id('compteur').innerHTML = 'No breed selected.';
  } else if (values.length === 1) {
    id('compteur').innerHTML = values.length + ' breed selected.';
  } else {
    id('compteur').innerHTML = values.length + ' breeds selected.';
  }
}


// c'est sûrement pas ouf mais je vois pas comment faire autrement
function sendToList(breedSlug) {
  let breedData = document.querySelector('.' + breedSlug).children;
  let breedName = breedData[2].innerHTML;
  let breedImage = breedData[0].currentSrc;

  let fullLi = '<li class="' + breedSlug + '"><div class="delete"><img src="http://localhost/~tahoe/myfavoritedogs/images/moins.svg"></div><div class="breed"><img class="breedImage" src="' + breedImage + '"><span><span class="place"></span> - ' + breedName + '</span><img class="dragIcon" src="http://localhost/~tahoe/myfavoritedogs/images/drag.svg"></div></li>'; 

  list.insertAdjacentHTML('beforeend', fullLi);
  listIndexes();
}




let checkboxes = document.querySelectorAll('input[type="checkbox"]');

checkboxes.forEach((checkbox) => {
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

  checkbox.addEventListener("change", countChecked);




  



  checkbox.addEventListener("change", sendToStorage); 
  function sendToStorage() {
    localStorage.clear();

    let checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
    
    let values = [];
    checkedBoxes.forEach((checkedBox) => {
      values.push(checkedBox.value);
    });

    values = [...new Set(values)];
    

    localStorage.setItem("breeds", JSON.stringify(values));

    list.innerHTML = '';
    values.forEach((value) => {
      
      sendToList(value);
    })

  }
  
});






let list = document.getElementById('items');


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

// liste drag and sort
let sortable = Sortable.create(list, {
  animation: 150,
  onEnd: function() {
    listIndexes();
  }
});












window.onload = function() {

  let values = JSON.parse(localStorage.getItem("breeds"));
  if (values) {
    values.forEach((value) => {
        // recoche les cases à partir du local storage
        checkboxes.forEach((checkbox) => {
          if (checkbox.value === value) {
            checkbox.checked = true;
            countChecked();
          }
        });

        sendToList(value);
        
      })
  }

};



















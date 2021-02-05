id = name => document.getElementById(name);
cl = name => document.getElementsByClassName(name);

const list = document.getElementById('items');


// retourne la place d'un li
function getIndex(node) {
  let children = node.parentNode.children;

  for (i = 0; i < children.length; i++) {
    if (node == children[i]) break;
  }
  return i + 1;
}

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


// Actions quand les checkbox changent 
let checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach((checkbox) => {

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

  // coche les checkbox identiques
  checkbox.addEventListener("change", checkToo);

  // compte les checkbox cochées
  checkbox.addEventListener("change", countChecked);

  // Ajout dans le local storage + update de la liste
  // checkbox.addEventListener("change", sendToStorage); 

  checkbox.addEventListener("change", maybeSendToList);

  function maybeSendToList() {
    if (checkbox.checked) {
      
      // ajoute si la liste est vide
      if (getListValues().length === 0) {
        sendToList(checkbox.value);
      } 


      
    } else {
      getListValues().forEach((listValue) => {
        
        if (listValue === checkbox.value) {
          console.log(document.querySelector('#items li.' + listValue));
          document.querySelector('#items li.' + listValue).remove();
        }
        
      })
      
    }
  }
  
});

function getListValues() {
  let elements = document.querySelectorAll('#items > li');
  let names = [];
  elements.forEach((element) => {
    names.push(element.classList.toString());
  })

  names = [...new Set(names)];
  
  return names;
}


// mise à jour de la liste
// c'est sûrement pas ouf mais je vois pas comment faire autrement
function sendToList(breedSlug) {

  let breedData = document.querySelector('.' + breedSlug).children;
  let breedName = breedData[2].innerHTML;
  let breedImage = breedData[0].currentSrc;

  let fullLi = '<li class="' + breedSlug + '"><div class="delete"><img src="http://localhost/~tahoe/myfavoritedogs/images/moins.svg"></div><div class="breed"><img class="breedImage" src="' + breedImage + '"><span><span class="place"></span> - ' + breedName + '</span><img class="dragIcon" src="http://localhost/~tahoe/myfavoritedogs/images/drag.svg"></div></li>'; 

  list.insertAdjacentHTML('beforeend', fullLi);
  listIndexes();
  
}



// function sendToStorage() {

//   // reset le storage
//   localStorage.clear();

//   // trouve toutes les checkbox cochées
//   let checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
  
//   // ajoute toutes les checkbox cochées dans l'array values
//   let values = [];
//   checkedBoxes.forEach((checkedBox) => {
//     values.push(checkedBox.value);
//   });

//   // retire les doublons
//   values = [...new Set(values)];
  

//   // envoie dans le storage
//   localStorage.setItem("breeds", JSON.stringify(values));
//   console.log(values + "envoyés dans le storage")
//   // update la liste
//   // list.innerHTML = '';
//   // values.forEach((value) => {
//   //   sendToList(value);
    
//   // })

// }



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

  // s'il y a quelque chose dans le storage, cocher + mettre dans la liste
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



















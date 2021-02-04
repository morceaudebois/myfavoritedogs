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
  }
  
});






let list = document.getElementById('items');
let elements = document.querySelectorAll('#items > li');

// retourne la place d'un li
function getIndex(node) {
  let children = node.parentNode.children;

  for (i = 0; i < children.length; i++) {
    if (node == children[i]) break;
  }
  return i + 1;
}

// liste drag and sort
let sortable = Sortable.create(list, {
  animation: 150,
  onEnd: function() {

    // pour chaque li, trouver sa place
    elements.forEach((element) => {
      let place = element.querySelector('.place');
      place.innerHTML = '#' + getIndex(element);
    })

  }

});












window.onload = function() {
  let values = JSON.parse(localStorage.getItem("breeds"));

  values.forEach((value) => {
    checkboxes.forEach((checkbox) => {
      if (checkbox.value === value) {
        checkbox.checked = true;
      }
    });
  })

};



















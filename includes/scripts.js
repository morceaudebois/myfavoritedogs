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
    document.getElementById('compteur').innerHTML = values.length;
  }


  
});











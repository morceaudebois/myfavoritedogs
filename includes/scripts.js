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









let checkboxes = document.querySelectorAll('input[type="checkbox');

checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", checkToo);

  function checkToo() {
    let toCheck = document.querySelectorAll('input[value="' + checkbox.value + '"');
    
    toCheck.forEach((value) => {
      if (value != checkbox) {
        value.click();
      }
    });
  }
  
});
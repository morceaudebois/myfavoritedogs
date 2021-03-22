(function(){
    let medals = document.querySelectorAll('.medal');
    
    // trouve la position de chaque résultat
    medals.forEach((medal) => {
        let position = Array.from(medal.parentNode.parentNode.children).indexOf(medal.parentNode) +1;

        medal.innerHTML = position;
    })
    
})();


function screen() {
    document.body.classList.add("screenshot");

    html2canvas(document.querySelector('.toScreen')).then(canvas => {
        document.querySelector('.screenshotContainer').appendChild(canvas)
    });

    document.body.classList.remove("screenshot");
    document.body.classList.toggle('open');
}



// s'occupe de l'overlay et du screenshot
document.querySelector('.overlay').addEventListener('click', () => {
    document.body.classList.toggle('open');
  
    console.log(document.querySelector('.screenshotContainer canvas'));
  
    if (document.querySelector('.screenshotContainer canvas')) {
      
      document.querySelector('.screenshotContainer canvas').remove();
    }
  });
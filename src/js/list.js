(function(){
    let medals = document.querySelectorAll('.medal');
    
    // trouve la position de chaque résultat
    medals.forEach((medal) => {
        let position = Array.from(medal.parentNode.parentNode.children).indexOf(medal.parentNode) + 1;

        medal.innerHTML = position;
    })
    
})()
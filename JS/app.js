
const switchModeButton = document.querySelector("#theme-toggle-btn");
const header = document.querySelector('#header');
const switchMode = document.getElementById('switch-mode');

let isLight = true;
let dark_color='#1F2937';
let light_color='#ececec';
let main_color='#FFF';
let inverse_color = '#1e1e1e';

switchModeButton.addEventListener("click", toggleMode);

let mainLocalTheme = localStorage.getItem('isLight');
if(mainLocalTheme !== null){
    if( mainLocalTheme === 'true'){
        lightTheme(inverse_color,dark_color,light_color);
        switchMode.textContent='dark_mode';
    }else{
        darckTheme(main_color,light_color,dark_color);
        switchMode.textContent='light_mode';
    }
}

function toggleMode() {
    if(isLight){
        lightTheme(inverse_color,dark_color,light_color);
        switchMode.textContent='dark_mode';
        switchModeButton.classList.toggle('rotate');
        isLight = false;
        localStorage.clear('isLight');
        localStorage.setItem("isLight",true) 

    }else{
        darckTheme(main_color,light_color,dark_color);
        switchMode.textContent='light_mode';
        switchModeButton.classList.toggle('rotate');
        isLight = true;
        localStorage.clear('isLight');
        localStorage.setItem('islight',false);
    }
}
function lightTheme(inverse_color,dark_color,light_color){
    document.documentElement.style.setProperty('--main-color',inverse_color);
    document.documentElement.style.setProperty('--light-color',dark_color);
    document.documentElement.style.setProperty('--dark-color',light_color);
}
function darckTheme(main_color,light_color,dark_color){
    document.documentElement.style.setProperty('--main-color',main_color);
    document.documentElement.style.setProperty('--light-color',light_color);
    document.documentElement.style.setProperty('--dark-color',dark_color);
}


/// toggle menu
const mobileBtn = document.getElementById('mobile-cta');
const  nav = document.querySelector('nav')
const mobileBtnExit = document.getElementById('mobile-exit');

mobileBtn.addEventListener('click', () => {
    nav.classList.add('menu-btn');    
});

mobileBtnExit.addEventListener('click', () => {
    nav.classList.remove('menu-btn');
});
// close btn 
document.addEventListener("click",(e)=>{
    if(e.target !== mobileBtn && e.target !== nav ){
       /// check if nav open 
       if(nav.classList.contains('menu-btn')){
            nav.classList.remove('menu-btn');        
       }
    }
})
nav.onclick = function(e){
    e.stopPropagation();
}

/* images display */
let displayedImages = document.querySelectorAll('.container .cards img');
displayedImages.forEach(img => {
    img.addEventListener('click', (e) =>{
        if(document.querySelector('.close-popup-btn')){// image been created => remove it
            document.querySelector('.close-popup-btn').parentNode.remove();
        }
        createPopUpImage(img);
    })

});
//close popup 
document.addEventListener("click", (e)=>{
    if(e.target.className =='close-popup-btn'){
        e.target.parentNode.remove();
    }
    if(document.querySelector('.close-popup-btn')){
        if(e.target.className !== 'popup-holder' && e.target.className !== 'img-tag' && e.target.className !== 'popup-text'){
            document.querySelector('.close-popup-btn').parentNode.remove();
        }
    }
})

function createPopUpHolder(holderPopUpChild){

    let popupHolder = document.createElement("div");
    popupHolder.className ='popup-holder';

    let closeBtn = document.createElement("span");
    let closeBtnText = document.createTextNode("X");
    closeBtn.appendChild(closeBtnText);
    closeBtn.className = 'close-popup-btn';

    popupHolder.appendChild(closeBtn);

    
    popupHolder.appendChild(holderPopUpChild);
    document.body.appendChild(popupHolder);
        
}
function createPopUpImage(img){

    let popupImage = document.createElement('img');
    popupImage.className ='img-tag';
    popupImage.src = img.src;

    createPopUpHolder(popupImage);
}

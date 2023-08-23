
function createTextPopUpHolder(holderPopUpChild){

    let popupHolder = document.createElement("div");
    popupHolder.className ='popup-text';

    let closeBtn = document.createElement("span");
    let closeBtnText = document.createTextNode("X");
    closeBtn.appendChild(closeBtnText);
    closeBtn.className = 'close-popup-btn';

    popupHolder.appendChild(closeBtn);

    
    popupHolder.appendChild(holderPopUpChild);
    document.body.appendChild(popupHolder);
        
}

let isHover=false;

const approvedCheck = document.getElementById('approved-check');

approvedCheck.addEventListener("mouseenter", createPopUpText);


/*create texte */
function createPopUpText(){
    if(!isHover){
        setTimeout(function(){
            let popupText = document.createElement('p');
            popupText.innerHTML =`
                🔍 Information Verification in Progress! 🔍<br><br>

                Congratulations on your submission! Your top score is now under review by our diligent moderators. We take pride in upholding fair play and maintaining the integrity of our leaderboards.<br>

                Rest assured, your skill and dedication will not go unnoticed. Once the validation process is complete, your name will be celebrated among the elite players. <br>

                Keep your chess skills sharp and your spirit resolute, for the road to victory is paved with determination. Soon, the world will witness your triumph on Chess-Warriors!<br><br>

                👑 Chess-Warriors Moderation Team 👑<br>
            ` ;
            createTextPopUpHolder(popupText);
        },1500);
        isHover=true;
    }
}
document.addEventListener("click", (e)=>{
    if(e.target.className =='close-popup-btn'){
        e.target.parentNode.remove();
        isHover=false;
    }
    if(document.querySelector('.close-popup-btn')){
        if(e.target.className !== 'popup-holder' && e.target.className !== 'img-tag' && e.target.className !== 'popup-text'){
            document.querySelector('.close-popup-btn').parentNode.remove();
            isHover=false;
        }
    }
})
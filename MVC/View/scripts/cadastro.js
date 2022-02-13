const cadastro = document.querySelector(".cadastro");
const inputSide = cadastro.querySelector(".input-side");
const inputDiv = inputSide.querySelector(".input-div");
const cadastroNav = cadastro.querySelector(".cadastro-nav");
const btnBack = cadastroNav.querySelector(".btnVoltar");
const btnProx = cadastroNav.querySelector(".btnContinuar");
const parte1 = inputDiv.querySelector(".parte1");
const parte2 = inputDiv.querySelector(".parte2");
const parte3 = inputDiv.querySelector(".parte3");
const sessão = [parte1,parte2,parte3];
var i=0;

function proximo(){
   
    sessão[i].style.display="none";
    sessão[i+1].style.display="block";
    i++;
    if(i==1){
        btnBack.style.display="block";
    }
    if(i==2){
        btnProx.style.display="none";
    }
}
function voltar(){
    for(let z=i-1; z<=2; z++){
        sessão[z].style.display="block";
        for(let z=i; z<=2; z++){
            sessão[z].style.display="none";  
        }
        
    }
    if(i==0){
        btnBack.style.display="none";
    }
    if(i==1){
        btnProx.style.display="block";
    }
    i--;
}
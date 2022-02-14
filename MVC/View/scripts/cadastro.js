const cadastro = document.querySelector(".cadastro");
const inputSide = cadastro.querySelector(".input-side");
const inputDiv = inputSide.querySelector(".input-div");

const columnPassos = cadastro.querySelector(".column-passos");
const caixa1 = columnPassos.querySelector("#caixa1");
const caixa2 = columnPassos.querySelector("#caixa2");
const caixa3 = columnPassos.querySelector("#caixa3");
const caixa = [caixa1,caixa2,caixa3];

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
    caixa[i + 1].style.background= "#3DC9C4";
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
    for(let z=i; z<=2; z++){
        caixa[z].style.background="#b9b9b9";  
    }
    if(i==0){
        btnBack.style.display="none";
       
    }
    if(i==1){
        btnProx.style.display="block";;
    }
    i--;
}
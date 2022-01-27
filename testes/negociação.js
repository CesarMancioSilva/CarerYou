    
    const footer = document.querySelector("#modal-footer");
    const modalContent = document.querySelector("#modal-content");
    const passo1 = footer.querySelector("#passo1");
    const passo2 = footer.querySelector("#passo2");
    const passo3 = footer.querySelector("#passo3");
    const passo4 = footer.querySelector("#passo4");
    const button = footer.querySelector("#button");
    const buttonBack = footer.querySelector("#button-back");
    const content1 = modalContent.querySelector("#content1");
    const content2 = modalContent.querySelector("#content2");
    const content3 = modalContent.querySelector("#content3");
    const content4 = modalContent.querySelector("#content4");
    const passos = [passo1,passo2,passo3,passo4];
    const content = [content1,content2,content3,content4]
    var i = 0;

function acao(){
    let modal = document.querySelector(".modal")
    modal.style.display="block";
}
function buttonClick(){
passos[i].style.backgroundColor="blue";
content[i].style.display="none";
content[i+1].style.display="block";
i++
if(i==1){
    buttonBack.style.display="block";
}
if(i==3){
    button.style.display="none";
    }
}
function buttonBackClick(){
    for(let a=i-1;a<=3;a++){
        passos[a].style.backgroundColor="white";
        content[a].style.display="block";
        for(a=i;a<=3;a++){
            content[a].style.display="none";
        }
    }
    if(i==1){
        buttonBack.style.display="none";
    }
    if(i==3){
        button.style.display="block";
    }
     i--;
}
function enviar(){
    let input1 = modalContent.querySelector("#input1");
    let input2 = modalContent.querySelector("#input2");
    let input3 = modalContent.querySelector("#input3");
    let input4 = modalContent.querySelector("#input4");
    let text1 = input1.value;
    let text2 = input2.value;
    let text3 = input3.value;
    let text4 = input4.value;
    if(text1 == ""  || text2 == ""  || text3 == ""  || text4 == ""){

        console.log("campo faltando");
        console.log(text1);
        console.log(text2);
        console.log(text3);
        console.log(text4);
        const aviso = modalContent.querySelector("#aviso");
        aviso.style.display = "block";
    }else{
        console.log(text1);
        console.log(text2);
        console.log(text3);
        console.log(text4);
        const buttonModal = document.querySelector(".btn");
        buttonModal.disabled = true;
    }

}
function fmodal(){
    let modal = document.querySelector(".modal")   
    modal.style.display="none";
    i=0;
    for(let a=0;a<3;a++){
        passos[a].style.backgroundColor="white";
    }
    for(let b=1;b<=3;b++){
        content[b].style.display="none";
    }
    content[0].style.display="block";
    button.style.display="block";
    aviso.style.display = "none";
}


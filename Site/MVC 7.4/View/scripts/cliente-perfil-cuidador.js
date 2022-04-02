const esfumaçado1 = document.querySelector(".esfumaçado1");
const modalForm = document.querySelector(".modal-form");

function sairForm(){
    esfumaçado1.style.display="none";
    modalForm.style.display="none";
    esfumaçado2.style.display="none"
    modalFormDenuncia.style.display="none";
}
function abrirForm(){
    esfumaçado1.style.display="block"
    modalForm.style.display="block"
}

const etapa1 = document.querySelector(".etapa-um");
const etapa2 = document.querySelector(".etapa-dois");
const btnVoltar = document.querySelector(".btnVoltar");
const btnProximo = document.querySelector(".btnProximo");
const btnEnviar = document.querySelector(".btnEnviar");

function proxEtapa(){
    etapa1.style.display="none";
    etapa2.style.display="block";
    btnVoltar.style.display="block";
    btnProximo.style.display="none";
    btnEnviar.style.display="block";
}
function voltEtapa(){
    etapa1.style.display="block";
    etapa2.style.display="none";
    btnVoltar.style.display="none";
    btnProximo.style.display="block";
    btnEnviar.style.display="none";
}
const esfumaçado2 = document.querySelector(".esfumaçado2");
const modalFormDenuncia = document.querySelector(".modal-form-denuncia");
function abrirDenuncia(){
    esfumaçado2.style.display="block";
    modalFormDenuncia.style.display="block";
}
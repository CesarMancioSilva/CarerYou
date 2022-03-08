const latNav = document.querySelector('.lateral-navegação');
const analise = latNav.querySelector("#analise");
const analiseCntnt = document.querySelector(".Content-analise");
const listaCuid = latNav.querySelector("#listaCuid");
const cuidadores = latNav.querySelector(".Cuidadores");
i=0;
let show = true;

cuidadores.addEventListener("click", () => {
    cuidadores.classList.toggle("on", show);
    analise.classList.toggle("on", show);
    listaCuid.classList.toggle("on", show);
    latNav.classList.toggle("on", show);
    show = !show;
})

function analiseF(){
    analiseCntnt.style.display="flex";
}

function listaF(){
    analiseCntnt.style.display="none";
}

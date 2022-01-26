
let show = true;

const nav = document.querySelector(".navbar")
const hamburger = nav.querySelector(".hamburger")
const footer = document.querySelector(".footer")

hamburger.addEventListener("click", () => {

    
    footer.classList.toggle("on", show)
    show = !show;
})
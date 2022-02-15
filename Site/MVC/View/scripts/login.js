
let show = true;

const nav = document.querySelector(".navbar")
const hamburger = nav.querySelector(".hamburger")
const main = document.querySelector("#main")

hamburger.addEventListener("click", () => {

    document.body.style.overflow = show ? "hidden" : "initial"
    main.classList.toggle("on", show)
    show = !show;
})

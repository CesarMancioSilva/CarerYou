const form = document.querySelector("form");
const responseArea = document.querySelector("#responseArea");


form.onsubmit = e => {
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controller/php/Logar.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                var response = xhr.response;
                if(response==="Sucesso"){
                    responseArea.innerHTML = response;
                    location.href="#"
                } else if(response!==""){
                    responseArea.style.display = "block";
                    responseArea.innerHTML = response;
                }
            }
        }
    }
    var formInfo = new FormData(form);
    xhr.send(formInfo);
}
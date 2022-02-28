const errorArea = document.querySelector("#parte1-Span");

const formCadastro = document.querySelector("form");

formCadastro.onsubmit = e => {
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open("POST","../Controller/php/Cadastrar.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            console.log("DONE");
            if(xhr.status === 200){
                var response = xhr.response;
                if(response!==""){
                    errorArea.style.display = "block";
                    errorArea.innerHTML = response;
                } else {
                    errorArea.style.display = "none";
                }
            }
        }
    }
    var formInfo = new FormData(formCadastro);
    xhr.send(formInfo);
}

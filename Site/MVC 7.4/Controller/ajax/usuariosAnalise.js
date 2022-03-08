let globalId;

const Content = document.querySelector(".cuidador-content");
function closeContent(){
    Content.style.display="none";
    globalId = null;
}
function viewContent(id){
    Content.style.display="block";
    globalId = id;
    var xhr = new XMLHttpRequest;
    xhr.open("POST", "../Controller/php/AnalisarUsuario.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                var response = JSON.parse(xhr.response);
                console.log(response);
                document.querySelector("#imgU").src = "./assets/img/profile pic/" + response.FOTO;
                document.querySelector("#nomeU").textContent = response.NOME;
                document.querySelector("#cidadeU").textContent = response.CIDADE + " - " + response.ESTADO;
                document.querySelector("#emailU").textContent = response.EMAIL;
                document.querySelector("#generoU").textContent = response.GENERO;
                document.querySelector("#rgU").textContent = response.RG;
                document.querySelector("#certificadoU").textContent = response.CERTIFICADO;
            }
        }
    }
    xhr.setRequestHeader("Content-type" , "application/x-www-form-urlencoded");
    xhr.send("id="+id);
}

function PermitirU(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controller/php/AnalisarUsuario.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                location.reload();
            }
        }
    }
    xhr.setRequestHeader("Content-type" , "application/x-www-form-urlencoded");
    xhr.send("idPermicao="+globalId);
}
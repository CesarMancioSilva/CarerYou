const cadastro = document.querySelector(".cadastro");
const inputSide = cadastro.querySelector(".input-side");
const inputDiv = inputSide.querySelector(".input-div");

const columnPassos = cadastro.querySelector(".column-passos");
const caixa1 = columnPassos.querySelector("#caixa1");
const caixa2 = columnPassos.querySelector("#caixa2");
const caixa3 = columnPassos.querySelector("#caixa3");
const caixa = [caixa1,caixa2,caixa3];

const columnPassos2 = inputDiv.querySelector(".column-passos2");
const caixa1mb = columnPassos2.querySelector("#caixa1mb");
const caixa2mb = columnPassos2.querySelector("#caixa2mb");
const caixa3mb = columnPassos2.querySelector("#caixa3mb");
const caixamb = [caixa1mb,caixa2mb,caixa3mb];

const cadastroNav = cadastro.querySelector(".cadastro-nav");
const btnBack = cadastroNav.querySelector(".btnVoltar");
const btnProx = cadastroNav.querySelector(".btnContinuar");
const cadastrar = cadastroNav.querySelector(".cadastrar");

const parte1 = inputDiv.querySelector(".parte1");
const parte2 = inputDiv.querySelector(".parte2");
const parte3 = inputDiv.querySelector(".parte3");
const sessão = [parte1,parte2,parte3];
var i=0;


function proximo(){
   
    let nomeUsuario = parte1.querySelector("#nomeUsuario");
    let emailUsuario = parte1.querySelector("#emailUsuario");
    let senhaUsuario = parte1.querySelector("#senhaUsuario");
    let senhaConfirmUsuario = parte1.querySelector("#senhaConfirmUsuario");
    let rgUsuario = parte1.querySelector("#rgUsuario");
    if (i==0){
        if(nomeUsuario.value.length!=0 && emailUsuario.value.length!=0 && senhaUsuario.value.length!=0 && rgUsuario.value.length!=0 && senhaConfirmUsuario.value.length!=0){
            sessão[i].style.display="none";
            sessão[i+1].style.display="block";
            caixa[i + 1].style.background= "#3DC9C4";
            caixamb[i + 1].style.background= "#3DC9C4";
            i++;
        
            btnBack.style.display="block";
        
        }else{
            let parte1Span = parte1.querySelector("#parte1-Span").style.display="block";
        }
    }
    else if(i==1){
        
        if(parte2.querySelector('#OPcliente').checked){
            alert("cliente");
            if(fotoArquivo.files.length == 0){
                let clienteAviso = parte2.querySelector("#confirmação").style.display="block";
                
            }else{
                alert("to com foto cliente");
                alert("pode passar cliente");
                sessão[i].style.display="none";
                sessão[i+1].style.display="block";
                caixa[i + 1].style.background= "#3DC9C4";
                caixamb[i + 1].style.background= "#3DC9C4";
                i++;
            }
        }else if(parte2.querySelector('#OPcuidador').checked){
           alert("cuidador");

           if(fotoArquivo.files.length == 0){
            let clienteAviso = parte2.querySelector("#confirmação2").style.display="block";
            }else{
                let clienteAviso = parte2.querySelector("#confirmação2").style.color="green";
            }

            if(parte2.querySelector("#certif-Input").files.length == 0){
                let pdfAviso = parte2.querySelector("#file-upload-filename");
                pdfAviso.innerText="Nenhum arquivo selecionado!";
                pdfAviso.style.color="red";
            }else{
                alert("compdf");
            }

            if(fotoArquivo.files.length != 0 && parte2.querySelector("#certif-Input").files.length != 0){
                alert("pode passar cuidador");
                sessão[i].style.display="none";
                sessão[i+1].style.display="block";
                caixa[i + 1].style.background= "#3DC9C4";
                caixamb[i + 1].style.background= "#3DC9C4";
                i++;
            }
        }
        
        

    }
    
}

const clienteDiv = parte2.querySelector(".clienteDiv");
const cuidadorDiv = parte2.querySelector(".cuidadorDiv");

function OPcl(){
    clienteDiv.style.display="block";
    cuidadorDiv.style.display="none";
}
function OPcu(){
    clienteDiv.style.display="none";
    cuidadorDiv.style.display="block";
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
        caixamb[z].style.background="#b9b9b9";  
    }
    if(i==0){
        btnBack.style.display="none";
       
    }
        btnProx.style.display="block";;
    
    i--;
}

function readImage() {
    if (this.files && this.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {
            document.querySelector(".preview").src = e.target.result;
            document.querySelector(".preview2").src = e.target.result;
        };       
        file.readAsDataURL(this.files[0]);
    }
    document.querySelector("#confirmação").textContent="Arquivo selecionado";
    document.querySelector("#confirmação").style.color="green";
    document.querySelector("#confirmação").style.display="block";
    document.querySelector("#confirmação2").textContent="Arquivo selecionado";
    document.querySelector("#confirmação2").style.color="green";
    document.querySelector("#confirmação2").style.display="block";
}
document.getElementById("fotoArquivo").addEventListener("change", readImage, false);


const file = document.querySelector("#certif-Input");
if(file.files.length == 0){
    console.log(1);
}
else{
    console.log(2); 
}

var input = document.getElementById( 'certif-Input' );
var infoArea = document.getElementById( 'file-upload-filename' );
input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = 'Arquivo selecionado: ' + fileName;
  infoArea.style.color="green";
}

function verificaExtensao($input) {
    var extPermitidas = ['pdf'];
    var extArquivo = $input.value.split('.').pop();
  
    if(typeof extPermitidas.find(function(ext){ return extArquivo == ext; }) == 'undefined') {
      alert('Inserir um arquivo PDF para melhor visualização!');
    } 
  }

  document.getElementById('checkTermo').onclick = function() {
    // access properties using this keyword
    if ( this.checked ) {
        // Returns true if checked
        cadastrar.style.backgroundColor = "#3DC9C4";
        cadastrar.style.display = "flex";
    } else {
        cadastrar.style.display = "none";
    }
};

const AvisoCard = document.querySelector("AvisoCard");
function Endcadastrar(){
    if(parte2.querySelector('#OPcuidador').checked){
        cadastrar.style.display="none";
        AvisoCard.styl.display="flex";

    }
}
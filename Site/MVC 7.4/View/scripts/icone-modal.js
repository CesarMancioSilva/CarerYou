// Get the modal
const modal = document.querySelector(".modal-icon");

// Get the button that opens the modal
const icon = document.getElementById("icon-entrar");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var i=0; 


// When the user clicks on the button, open the modal
icon.onclick = function() {
    if(i==0){
    modal.style.display = "block";
    i++
    }
    else if(i==1){
    modal.style.display = "none";
    i--;
    }
  
}



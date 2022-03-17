// Get the modal
const modal = document.querySelector(".modal-icon");

// Get the button that opens the modal
const icon = document.getElementById("icon-entrar");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];



// When the user clicks on the button, open the modal
icon.onclick = function() {
  modal.style.display = "block";
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("button").addEventListener("click", function(){
document.querySelector(".popup").style.display = "flex";
})

document.querySelector(".close").addEventListener("click",function(){
document.querySelector(".popup").style.display = "none";
})

function openPopup(event) {
event.preventDefault(); // Prevent the default behavior of the link

// Display the popup
document.querySelector(".popup").style.display = "flex";
}

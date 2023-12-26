
document.getElementById("button").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
})

document.querySelector(".close").addEventListener("click",function(){
    document.querySelector(".popup").style.display = "none";
})

function moreInfo() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("btnInfo");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "More info"; 
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Show less"; 
        moreText.style.display = "inline";
    }
}

document.querySelector("#info button").addEventListener("click", function() {
    var profileSection = document.querySelector(".profile-section");
    if (profileSection.style.display === "none") {
        profileSection.style.display = "block";
    } else {
        profileSection.style.display = "none";
    }
});

document.getElementById("editProfileButton").addEventListener("click", function() {
var profileForm = document.getElementById("editProfileForm");
if (profileForm.style.display === "none") {
profileForm.style.display = "block";
} else {
profileForm.style.display = "none";
}
});



const togglePasswordOld = document.querySelector('#togglePasswordOld');
const passwordOld = document.querySelector('#psw');
togglePasswordOld.addEventListener('click', function (e) {
// toggle the type attribute
const type = passwordOld.getAttribute('type') === 'password' ? 'text' : 'password';
passwordOld.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('fa-eye');
});

const togglePasswordNew = document.querySelector('#togglePasswordNew');
const passwordNew = document.querySelector('#new_psw');
togglePasswordNew.addEventListener('click', function (e) {
// toggle the type attribute
const type = passwordNew.getAttribute('type') === 'password' ? 'text' : 'password';
passwordNew.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('fa-eye');
});


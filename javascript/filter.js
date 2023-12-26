document.addEventListener("DOMContentLoaded", function() {
const idUserFilterInput = document.getElementById("idUserFilter");
const emailFilterInput = document.getElementById("emailFilter");
const nameFilterInput = document.getElementById("nameFilter");
const usernameFilterInput = document.getElementById("usernameFilter");

const table = document.getElementById("filter");

idUserFilterInput.addEventListener("input", filterTable);
emailFilterInput.addEventListener("input", filterTable);
nameFilterInput.addEventListener("input", filterTable);
usernameFilterInput.addEventListener("input", filterTable);

function filterTable() {
    const idUserFilter = idUserFilterInput.value.toUpperCase();
    const emailFilter = emailFilterInput.value.toUpperCase();
    const nameFilter = nameFilterInput.value.toUpperCase();
    const usernameFilter = usernameFilterInput.value.toUpperCase();
    
const rows = table.getElementsByTagName("tr");

for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    const cells = row.getElementsByTagName("td");

    const idUser = cells[0].textContent.toUpperCase();
    const email = cells[1].textContent.toUpperCase();
    const name = cells[2].textContent.toUpperCase();
    const username = cells[3].textContent.toUpperCase();

    const idUserMatch = idUser.includes(idUserFilter);
    const emailMatch = email.includes(emailFilter);
    const nameMatch = name.includes(nameFilter);
    const usernameMatch = username.includes(usernameFilter);

    row.style.display = idUserMatch && emailMatch && nameMatch && usernameMatch ? "" : "none";
}
}
});
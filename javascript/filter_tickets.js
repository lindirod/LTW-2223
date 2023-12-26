document.addEventListener("DOMContentLoaded", function() {
const titleFilterInput = document.getElementById("titleFilter");
const priorityFilterInput = document.getElementById("priorityFilter");
const dateFilterInput = document.getElementById("dateFilter");
const agentFilterInput = document.getElementById("agentFilter");
const statusFilterInput = document.getElementById("statusFilter");
const hashtagFilterInput = document.getElementById("hashtagFilter");

const table = document.getElementById("filter");

titleFilterInput.addEventListener("input", filterTable);
priorityFilterInput.addEventListener("input", filterTable);
dateFilterInput.addEventListener("input", filterTable);
agentFilterInput.addEventListener("input", filterTable);
statusFilterInput.addEventListener("input", filterTable);
hashtagFilterInput.addEventListener("input", filterTable);

function filterTable() {
    const titleFilter = titleFilterInput.value.toUpperCase();
    const priorityFilter = priorityFilterInput.value.toUpperCase();
    const dateFilter = dateFilterInput.value.toUpperCase();
    const agentFilter = agentFilterInput.value.toUpperCase();
    const statusFilter = statusFilterInput.value.toUpperCase();
    const hashtagFilter = hashtagFilterInput.value.toUpperCase();
    
const rows = table.getElementsByTagName("tr");

for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    const cells = row.getElementsByTagName("td");

    const title = cells[0].textContent.toUpperCase();
    const priority = cells[1].textContent.toUpperCase();
    const date = cells[2].textContent.toUpperCase();
    const agent = cells[3].textContent.toUpperCase();
    const status = cells[4].textContent.toUpperCase();
    const hashtag = cells[5].textContent.toUpperCase();

    const titleMatch = title.includes(titleFilter);
    const priorityMatch = priority.includes(priorityFilter);
    const dateMatch = date.includes(dateFilter);
    const agentMatch = agent.includes(agentFilter);
    const statusMatch = status.includes(statusFilter);
    const hashtagMatch = hashtag.includes(hashtagFilter);

    row.style.display = titleMatch && priorityMatch && dateMatch && agentMatch && statusMatch && hashtagMatch ? "" : "none";
}
}
});
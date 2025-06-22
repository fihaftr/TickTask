<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TickTask</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <script defer src="script.js"></script>
</head>
<body>

<header class="container text-center my-4">
  <img src="assets/logo sementara.png" alt="Logo" width="40">
  <h3 class="fw-bold d-inline-block align-middle ms-2">TickTask</h3>
</header>

<div class="container my-3">
  <div class="search-box d-flex align-items-center border rounded-pill px-3 py-2 shadow-sm">
    <input type="text" id="searchInput" class="form-control border-0" placeholder="Find task..">
    <button class="btn btn-outline-secondary border-0">🔍</button>
  </div>
</div>

<div class="container mb-3">
  <div class="d-flex flex-wrap justify-content-center gap-2">
    <button class="btn btn-outline-secondary" onclick="filterCategory('All')">All</button>
    <button class="btn btn-outline-secondary" onclick="filterCategory('Personal')">Personal</button>
    <button class="btn btn-outline-secondary" onclick="filterCategory('Work/Study')">Work/Study</button>
    <button class="btn btn-outline-secondary" onclick="filterCategory('Someday/Ideas')">Someday/Ideas</button>
  </div>
</div>

<div class="container text-center mb-4">
  <button class="btn btn-outline-primary" onclick="sortTasksByDate()">
    📆 Sort by Date
  </button>
</div>

<div class="text-center my-4">
  <a href="addtaskview.php" class="btn btn-dark w-50">
    ➕ Add Task
  </a>
</div>

<div class="container" id="taskList"></div>

<script>
const apiURL = 'http://localhost:3000/api/tasks';
let allTasks = [];

async function fetchTasks() {
  const res = await fetch(apiURL);
  const tasks = await res.json();
  allTasks = tasks;
  displayTasks(tasks);
}

function displayTasks(tasks) {
  const taskList = document.getElementById("taskList");
  taskList.innerHTML = "";
  tasks.forEach(task => {
    const card = document.createElement("div");
    card.className = "task-item border rounded p-3 mb-3 shadow-sm";
    card.dataset.category = task.category;
    card.dataset.due = new Date(task.due).toISOString();

    card.innerHTML = `
      <h5>${task.title}</h5>
      <p>${task.detail}</p>
      <small>Status: ${task.status} | Due: ${task.due.split("T")[0]}</small><br>
      <button onclick="editTask(${task.id})" class="btn btn-sm btn-outline-secondary mt-2">Edit</button>
      <button onclick="deleteTask(${task.id})" class="btn btn-sm btn-outline-danger mt-2">Delete</button>
    `;
    taskList.appendChild(card);
  });
}

function filterCategory(category) {
  if (category === 'All') {
    displayTasks(allTasks);
  } else {
    const filtered = allTasks.filter(t => t.category === category);
    displayTasks(filtered);
  }
}

function sortTasksByDate() {
  const sorted = [...allTasks].sort((a, b) => new Date(a.due) - new Date(b.due));
  displayTasks(sorted);
}


function deleteTask(id) {
  if (confirm('Delete this task?')) {
    fetch(`${apiURL}/${id}`, { method: 'DELETE' })
      .then(() => fetchTasks());
  }
}

function editTask(id) {
  window.location.href = `edittask.php?id=${id}`;
}


document.getElementById("searchInput").addEventListener("input", function() {
  const keyword = this.value.toLowerCase();
  const filtered = allTasks.filter(t => t.title.toLowerCase().includes(keyword));
  displayTasks(filtered);
});

fetchTasks();
</script>
</body>
</html>


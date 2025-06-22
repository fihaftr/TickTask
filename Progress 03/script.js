let sortAscending = true;

function sortTasks() {
  const taskList = document.getElementById("taskList");
  const tasks = Array.from(taskList.getElementsByClassName("task-item"));

  tasks.sort((a, b) => {
    const dueA = new Date(a.getAttribute("data-due"));
    const dueB = new Date(b.getAttribute("data-due"));
    return sortAscending ? dueA - dueB : dueB - dueA;
  });

  tasks.forEach((task) => taskList.appendChild(task));
  sortAscending = !sortAscending;
}

function searchTasks() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const tasks = document.querySelectorAll(".task-item");

  tasks.forEach((task) => {
    if (task.textContent.toLowerCase().includes(input)) {
      task.style.display = "";
    } else {
      task.style.display = "none";
    }
  });
}

function filterCategory(category) {
  const tasks = document.querySelectorAll(".task-item");
  tasks.forEach((task) => {
    if (category === "All" || task.getAttribute("data-category") === category) {
      task.style.display = "";
    } else {
      task.style.display = "none";
    }
  });
}

function openTaskForm() {
  document.getElementById("taskForm").classList.remove("d-none");
}

function closeTaskForm() {
  document.getElementById("taskForm").classList.add("d-none");
}

function addTask(event) {
  event.preventDefault();
  const title = document.getElementById("newTitle").value;
  const detail = document.getElementById("newDetail").value;
  const category = document.getElementById("newCategory").value;
  const status = document.getElementById("newStatus").value;
  const due = document.getElementById("newDue").value;

  if (!title || !detail || !category || !status || !due) return;

  const taskList = document.getElementById("taskList");

  const taskDiv = document.createElement("div");
  taskDiv.className = "task-item border p-3 mb-3";
  taskDiv.setAttribute("data-category", category);
  taskDiv.setAttribute("data-due", due);
  taskDiv.innerHTML = `
        <strong class="d-block">${title}</strong>
        <p class="mb-1">${detail}</p>
        <small>Status: ${status}</small><br>
        <small>Due: ${due}</small>
    `;

  taskList.appendChild(taskDiv);

  closeTaskForm();
}

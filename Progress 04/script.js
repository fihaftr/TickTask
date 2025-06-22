// Search Tasks
function searchTasks() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const tasks = document.querySelectorAll(".task-item");

  tasks.forEach(task => {
    const title = task.querySelector("strong").textContent.toLowerCase();
    task.style.display = title.includes(input) ? "" : "none";
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("searchInput");
  if (input) {
    input.addEventListener("input", searchTasks);
  }
});

// Filter by Category
function filterCategory(category) {
  const tasks = document.querySelectorAll('.task-item');

  tasks.forEach(task => {
    const taskCategory = task.getAttribute('data-category');
    if (category === "All" || taskCategory === category) {
      task.style.display = "";
    } else {
      task.style.display = "none";
    }
  });
}

// Sort only VISIBLE tasks by date
function sortTasksByDate() {
  const taskList = document.getElementById("taskList");
  const allTasks = Array.from(taskList.getElementsByClassName("task-item"));

  const visibleTasks = allTasks.filter(task => task.style.display !== "none");

  visibleTasks.sort((a, b) => {
    const dateA = new Date(a.getAttribute("data-due"));
    const dateB = new Date(b.getAttribute("data-due"));
    return dateA - dateB;
  });

  visibleTasks.forEach(task => {
    task.style.transition = 'all 0.3s ease';
    taskList.appendChild(task);
  });
}



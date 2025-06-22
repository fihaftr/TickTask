<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center mb-4">Edit Task</h2>
  <form id="editTaskForm">
    <input type="hidden" id="taskId" value="<?= $id ?>">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" required>
    </div>
    <div class="mb-3">
      <label for="detail" class="form-label">Detail</label>
      <textarea class="form-control" id="detail" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <select class="form-select" id="category" required>
        <option value="Personal">Personal</option>
        <option value="Work/Study">Work/Study</option>
        <option value="Someday/Ideas">Someday/Ideas</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select class="form-select" id="status" required>
        <option value="Not Yet">Not Yet</option>
        <option value="In Progress">In Progress</option>
        <option value="Done">Done</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="due" class="form-label">Due Date</label>
      <input type="date" class="form-control" id="due" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="tasklistview.php" class="btn btn-secondary">Back</a>
  </form>
</div>

<script>
const id = document.getElementById("taskId").value;

async function loadTask() {
  const res = await fetch(`http://localhost:3000/api/tasks`);
  const data = await res.json();
  const task = data.find(t => t.id == id);
  if (task) {
    document.getElementById("title").value = task.title;
    document.getElementById("detail").value = task.detail;
    document.getElementById("category").value = task.category;
    document.getElementById("status").value = task.status;
    document.getElementById("due").value = task.due.split("T")[0];
  }
}

document.getElementById("editTaskForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  const updatedTask = {
    title: document.getElementById("title").value,
    detail: document.getElementById("detail").value,
    category: document.getElementById("category").value,
    status: document.getElementById("status").value,
    due: document.getElementById("due").value,
  };

  try {
    const res = await fetch(`http://localhost:3000/api/tasks/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(updatedTask)
    });

    if (res.ok) {
      alert("Task updated successfully");
      window.location.href = "tasklistview.php";
    } else {
      alert("Failed to update task");
    }
  } catch (err) {
    console.error("Update error:", err);
    alert("Error updating task");
  }
});

loadTask();
</script>

</body>
</html>

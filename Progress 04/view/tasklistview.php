<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TickTask</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <script defer src="script.js"></script>
</head>
<body>

<!-- Header -->
<header class="text-center my-4">
  <img src="assets/logo sementara.png" alt="Logo" width="40">
  <h3 class="fw-bold d-inline-block align-middle ms-2">TickTask</h3>
</header>

<!-- Search Box -->
<div class="search-container container my-3">
  <div class="search-box d-flex align-items-center w-100 border rounded-pill px-3 py-2 shadow-sm">
    <input type="text" id="searchInput" class="form-control border-0" placeholder="Find task..">
    <button class="btn btn-outline-secondary border-0">🔍</button>
  </div>
</div>

<!-- Filter Buttons -->
<div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
  <button class="btn btn-outline-secondary" onclick="filterCategory('All')">All</button>
  <button class="btn btn-outline-secondary" onclick="filterCategory('Personal')">Personal</button>
  <button class="btn btn-outline-secondary" onclick="filterCategory('Work/Study')">Work/Study</button>
  <button class="btn btn-outline-secondary" onclick="filterCategory('Someday/Ideas')">Someday/Ideas</button>
</div>

<!-- Sort Button -->
<div class="text-center mb-4">
  <button class="btn btn-outline-primary" onclick="sortTasksByDate()">
    📆 Sort by Date
  </button>
</div>

<!-- Task List -->
<div id="taskList" class="container">
  <?php foreach ($tasks as $task): ?>
    <div class="task-item border p-3 mb-3"
         data-category="<?= htmlspecialchars($task['category']); ?>"
         data-due="<?= date('Y-m-d', strtotime($task['due'])); ?>">
      <strong><?= htmlspecialchars($task['title']); ?></strong>
      <p><?= htmlspecialchars($task['detail']); ?></p>
      <small>Status: <?= htmlspecialchars($task['status']); ?> |
        Due: <?= htmlspecialchars($task['due']); ?></small><br>
      <a href="index.php?c=TaskController&m=edit&id=<?= $task['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
      <a href="index.php?c=TaskController&m=delete&id=<?= $task['id']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
    </div>
  <?php endforeach; ?>
</div>

<!-- Add Task Button -->
<div class="text-center my-4">
  <a href="index.php?c=TaskController&m=create" class="btn btn-dark w-50">
    ➕ Add Task
  </a>
</div>

</body>
</html>


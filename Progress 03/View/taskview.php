<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TickTask</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<body class="bg-white text-black">

<header class="d-flex align-items-center justify-content-center p-3 border-bottom">
    <img src="assets/logo-sementara.png" alt="Logo TickTask" class="me-2" style="width: 40px;">
    <h1 class="fs-4 fw-bold m-0">TickTask</h1>
</header>

  <div class="container my-3">
    <div class="d-flex justify-content-center">
        <div class="d-flex align-items-center border rounded-pill px-3 w-100" style="max-width: 600px;">
            <input type="text" id="searchInput" placeholder="Find task.." class="form-control border-0 shadow-none bg-transparent">
            <button class="btn btn-sm bg-transparent border-0" onclick="searchTasks()">🔍</button>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="d-flex flex-wrap justify-content-center gap-2" id="categoryButtons">
        <button class="btn btn-outline-dark" onclick="filterCategory('All')">All</button>
        <button class="btn btn-outline-dark" onclick="filterCategory('Personal')">Personal</button>
        <button class="btn btn-outline-dark" onclick="filterCategory('Work/Study')">Work/Study</button>
        <button class="btn btn-outline-dark" onclick="filterCategory('Someday/Ideas')">Someday/Ideas</button>
    </div>
</div>

<div class="text-center mb-3">
    <button id="sortButton" class="btn btn-outline-dark" onclick="sortTasks()">📅↑</button>
</div>

<div class="container mb-3" id="taskList">
    <?php foreach ($data['tasks'] as $task): ?>
    <div class="task-item border p-3 mb-3" data-category="<?= $task['category']; ?>" data-due="<?= $task['due']; ?>">
        <strong class="d-block"><?= $task['title']; ?></strong>
        <p class="mb-1"><?= $task['detail']; ?></p>
        <small>Status: <?= $task['status']; ?></small><br>
        <small>Due: <?= $task['due']; ?></small>
    </div>
    <?php endforeach; ?>
</div>

<div class="text-center">
    <button class="btn btn-outline-dark w-75" onclick="openTaskForm()">➕ Add Your Task!</button>
</div>

<div id="taskForm" class="container mt-4 d-none" style="max-width: 400px;">
    <header class="d-flex align-items-center mb-3">
        <button class="btn btn-sm btn-outline-dark me-2" onclick="closeTaskForm()">⬅</button>
        <h1 class="fs-5 m-0">Add Your Task</h1>
    </header>
    <form>
        <input type="text" id="newTitle" placeholder="Title Task" required class="form-control mb-2">
        <textarea id="newDetail" placeholder="Details Task" required class="form-control mb-2"></textarea>
        <select id="newCategory" required class="form-select mb-2">
            <option value="" disabled selected>Category</option>
            <option value="Personal">Personal</option>
            <option value="Work/Study">Work/Study</option>
            <option value="Someday/Ideas">Someday/Ideas</option>
        </select>
        <select id="newStatus" required class="form-select mb-2">
            <option value="" disabled selected>Status</option>
            <option value="Not Yet">Not Yet</option>
            <option value="In Progress">In Progress</option>
            <option value="Done">Done</option>
        </select>
        <input type="date" id="newDue" required class="form-control mb-3">
        <button type="submit" class="btn btn-outline-dark w-100" onclick="addTask(event)">Create Task!</button>
    </form>
</div>

</body>
</html>

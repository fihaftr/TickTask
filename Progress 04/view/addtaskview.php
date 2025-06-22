<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= isset($task) ? 'Edit Task' : 'Add Task' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-3 d-flex align-items-center">
  <a href="index.php" class="btn btn-outline-secondary me-2">← Back</a>
  <h4 class="mb-0"><?= isset($task) ? 'Edit Task' : 'Add Task' ?></h4>
</div>


<div class="container mt-4" style="max-width: 500px;">
  <form action="index.php?c=TaskController&m=<?= isset($task) ? 'update' : 'store' ?>" method="post">
    <?php if (isset($task)): ?>
      <input type="hidden" name="id" value="<?= $task['id'] ?>">
    <?php endif; ?>
    <input type="text" name="title" placeholder="Title" required class="form-control mb-2" value="<?= $task['title'] ?? '' ?>">
    <textarea name="detail" placeholder="Detail" required class="form-control mb-2"><?= $task['detail'] ?? '' ?></textarea>
    <select name="category" class="form-select mb-2">
      <option value="Personal" <?= (isset($task) && $task['category'] === 'Personal') ? 'selected' : '' ?>>Personal</option>
      <option value="Work/Study" <?= (isset($task) && $task['category'] === 'Work/Study') ? 'selected' : '' ?>>Work/Study</option>
      <option value="Someday/Ideas" <?= (isset($task) && $task['category'] === 'Someday/Ideas') ? 'selected' : '' ?>>Someday/Ideas</option>
    </select>
    <select name="status" class="form-select mb-2">
      <option value="Not Yet" <?= (isset($task) && $task['status'] === 'Not Yet') ? 'selected' : '' ?>>Not Yet</option>
      <option value="In Progress" <?= (isset($task) && $task['status'] === 'In Progress') ? 'selected' : '' ?>>In Progress</option>
      <option value="Done" <?= (isset($task) && $task['status'] === 'Done') ? 'selected' : '' ?>>Done</option>
    </select>
    <input type="date" name="due" required class="form-control mb-3" value="<?= $task['due'] ?? '' ?>">
    <button type="submit" class="btn btn-dark w-100"><?= isset($task) ? 'Update' : 'Create' ?> Task</button>
  </form>
</div>

</body>
</html>


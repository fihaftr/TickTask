<?php
require_once 'model/Task.php';

class TaskController extends Controller {
    public function index() {
        $taskModel = new Task();
        $tasks = $taskModel->getAll();
        $this->view('tasklistview', ['tasks' => $tasks]);
    }

    public function create() {
        $this->view('addtaskview');
    }

    public function store() {
        $taskModel = new Task();
        $taskModel->add($_POST);
        header('Location: index.php');
    }

    public function delete() {
        $taskModel = new Task();
        $taskModel->delete($_GET['id']);
        header('Location: index.php');
    }

    public function edit() {
        $taskModel = new Task();
        $task = $taskModel->getById($_GET['id']);
        $this->view('addtaskview', ['task' => $task]);
    }

    public function update() {
        $taskModel = new Task();
        $taskModel->update($_POST);
        header('Location: index.php');
    }
}


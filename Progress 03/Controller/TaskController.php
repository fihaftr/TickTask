<?php
class TaskController extends Controller {
    public function index() {
        $tasks = [
            [
                'title' => 'Finish Web Project',
                'detail' => 'Work on finalizing the UI design.',
                'status' => 'In Progress',
                'due' => '2025-03-30',
                'category' => 'Work/Study'
            ],
            [
                'title' => 'Grocery Shopping',
                'detail' => 'Buy fruits, milk, and eggs.',
                'status' => 'Not Yet',
                'due' => '2025-03-25',
                'category' => 'Personal'
            ],
            [
                'title' => 'Submit Assignment',
                'detail' => 'Complete and upload by deadline.',
                'status' => 'Done',
                'due' => '2025-03-20',
                'category' => 'Work/Study'
            ]
        ];
        $this->view('taskview', ['tasks' => $tasks]);
    }
}
?>

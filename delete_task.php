<?php
require_once('database.php');

// Get IDs
$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$todo_id = filter_input(INPUT_POST, 'todo_id', FILTER_VALIDATE_INT);

// Delete the task from the database
if ($task_id != false && $todo_id != false) {
    $query = 'DELETE FROM tasks
              WHERE taskID = :task_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':task_id', $task_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Task List page
include('index.php');

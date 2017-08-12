<?php
// Get the task data
$todo_id = filter_input(INPUT_POST, 'todo_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($todo_id == null || $todo_id == false ||
   $name == null ) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the task to the database  
    $query = 'INSERT INTO tasks
                 (todoID, taskName)
              VALUES
                 (:todo_id, :name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':todo_id', $todo_id);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>

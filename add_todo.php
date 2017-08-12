<?php
// Get todo data
$name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($name == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the todo to the database  
    $query = 'INSERT INTO todos (todoName)
              VALUES (:todo_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':todo_name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the ToDo List page
    include('todo_list.php');
}
?>

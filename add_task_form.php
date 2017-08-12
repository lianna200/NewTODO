<?php
require('database.php');
$query = 'SELECT *
          FROM todos
          ORDER BY todoID';
$statement = $db->prepare($query);
$statement->execute();
$todos = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My TO DO List</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>TO DO Manager</h1></header>

    <main>
        <h1>Add Task</h1>
        <form action="add_task.php" method="post"
              id="add_task_form">

            <label>ToDO:</label>
            <select name="todo_id">
            <?php foreach ($todos as $todo) : ?>
                <option value="<?php echo $todo['todoID']; ?>">
                    <?php echo $todo['todoName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

      

            <label>Name:</label>
          
<input type="text" name="name"><br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Task"><br>
        </form>
        <p><a href="index.php">View Task List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My TO Do.</p>
    </footer>
</body>
</html>

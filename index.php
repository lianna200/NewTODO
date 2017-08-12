<?php
require_once('database.php');

// Get category ID
if (!isset($todo_id)) {
    $todo_id = filter_input(INPUT_GET, 'todo_id', 
            FILTER_VALIDATE_INT);
    if ($todo_id == NULL || $todo_id == FALSE) {
        $todo_id = 1;
    }
}
// Get name for selected category
$queryTodo = 'SELECT * FROM todos
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryTodo);
$statement1->bindValue(':todo_id', $todo_id);
$statement1->execute();
$todos = $statement1->fetch();
$todo_name = $todo['todoName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM todos
                       ORDER BY todoID';
$statement = $db->prepare($query);
$statement->execute();
$todos = $statement->fetchAll();
$statement->closeCursor();

// Get products for selected category
$queryTask = 'SELECT * FROM tasks
                  WHERE todoID = :todo_id
                  ORDER BY taskID';
$statement3 = $db->prepare($queryTask);
$statement3->bindValue(':todo_id', $todo_id);
$statement3->execute();
$tasks = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My TO DO</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>TO Do List Manager</h1></header>
<main>
    <h1>TO Do List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>TO Dos</h2>
        <nav>
        <ul>
            <?php foreach ($todos as $todo) : ?>
            <li><a href=".?todo_id=<?php echo $todo['todoID']; ?>">
                    <?php echo $todo['todoName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $todo_name; ?></h2>
        <table>
            <tr>
       
                <th>Task Name</th>
               
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($tasks as $task) : ?>
            <tr>
             
                <td><?php echo $task['taskName']; ?></td>
                
                <td><form action="delete_task.php" method="post">
                    <input type="hidden" name="task_id"
                           value="<?php echo $task['taskID']; ?>">
                    <input type="hidden" name="todo_id"
                           value="<?php echo $task['todoID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_task_form.php">Add Task</a></p>
        <p><a href="todo_list.php">List To DOs</a></p>        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?>TO Do</p>
</footer>
</body>
</html>

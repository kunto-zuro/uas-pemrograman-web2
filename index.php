<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM todo_list WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$taskToEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM todo_list WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();
    $resultEdit = $stmt->get_result();
    $taskToEdit = $resultEdit->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #333;
        }
        .task-form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        ul {
            list-style-type: none;
            padding: 0;
            width: 300px;
        }
        li {
            background: white;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-left: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout-button {
            background-color: #d9534f;
            margin-bottom: 20px;
        }
        .logout-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>To-Do List</h1>
    <form action="todo.php" method="POST" class="task-form">
        <input type="hidden" name="id" value="<?php echo $taskToEdit ? $taskToEdit['id'] : ''; ?>">
        <input type="text" name="task" required placeholder="Add a new task" value="<?php echo $taskToEdit ? $taskToEdit['task'] : ''; ?>">
        <button type="submit"><?php echo $taskToEdit ? 'Update Task' : 'Add Task'; ?></button>
    </form>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo $row['task']; ?>
                <div>
                    <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    <a href="todo.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
    <form action="logout.php" method="POST">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</body>
</html>

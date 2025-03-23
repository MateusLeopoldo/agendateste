<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$tasks = json_decode(file_get_contents('tasks.json'), true);
$id = $_GET['id'];
$task = $tasks[$id];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Tarefa</h1>
        
        <form action="save_task.php" method="POST" class="task-form">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
            <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea>
            <input type="datetime-local" name="due_date" value="<?= date('Y-m-d\TH:i', strtotime($task['due_date'])) ?>" required>
            
            <div class="form-actions">
                <button type="submit">Salvar</button>
                <a href="index.php" class="cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
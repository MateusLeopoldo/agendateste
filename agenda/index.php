<?php
$tasks = [];
$filter = $_GET['filter'] ?? 'all'; // Filtro padrão: 'all', 'pending', 'completed'

if (file_exists('tasks.json')) {
    $tasks = json_decode(file_get_contents('tasks.json'), true) ?: [];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Avançada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📝 My To-Do List</h1>

        <!-- Formulário para adicionar tarefas -->
        <form action="save_task.php" method="POST" class="task-form">
            <input type="text" name="title" placeholder="Título (ex: Academia)" required>
            <textarea name="description" placeholder="Descrição..."></textarea>
            <input type="datetime-local" name="due_date" required>
            <button type="submit">Adicionar Tarefa</button>
        </form>

        <!-- Filtros -->
        <div class="filters">
            <a href="?filter=all" class="<?= $filter === 'all' ? 'active' : '' ?>">Todas</a>
            <a href="?filter=pending" class="<?= $filter === 'pending' ? 'active' : '' ?>">Pendentes</a>
            <a href="?filter=completed" class="<?= $filter === 'completed' ? 'active' : '' ?>">Concluídas</a>
        </div>

        <!-- Lista de tarefas -->
        <div class="tasks">
            <?php if (empty($tasks)) : ?>
                <p class="empty">Nenhuma tarefa encontrada. 🎉</p>
            <?php else : ?>
                <?php foreach ($tasks as $id => $task) : ?>
                    <?php 
                    // Aplica filtro
                    if (
                        ($filter === 'pending' && $task['completed']) ||
                        ($filter === 'completed' && !$task['completed'])
                    ) continue;
                    ?>
                    
                    <div class="task <?= $task['completed'] ? 'completed' : '' ?>">
                        <div class="task-header">
                            <h3><?= htmlspecialchars($task['title']) ?></h3>
                            <span class="due-date"><?= date('d/m/Y H:i', strtotime($task['due_date'])) ?></span>
                        </div>
                        
                        <p class="description"><?= htmlspecialchars($task['description']) ?></p>
                        
                        <div class="actions">
                            <a href="toggle_status.php?id=<?= $id ?>" class="status">
                                <?= $task['completed'] ? '✅ Concluído' : '🕒 Pendente' ?>
                            </a>
                            <a href="edit_task.php?id=<?= $id ?>" class="edit">✏️ Editar</a>
                            <a href="delete_task.php?id=<?= $id ?>" class="delete">🗑️ Excluir</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
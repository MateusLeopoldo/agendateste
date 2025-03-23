<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tasks = file_exists('tasks.json') ? json_decode(file_get_contents('tasks.json'), true) : [];
    
    // Edição de tarefa
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $tasks[$id] = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'due_date' => $_POST['due_date'],
            'completed' => $tasks[$id]['completed'] // Mantém o status
        ];
    }
    // Nova tarefa
    else {
        $tasks[] = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'due_date' => $_POST['due_date'],
            'completed' => false
        ];
    }
    
    file_put_contents('tasks.json', json_encode($tasks));
}

header('Location: index.php');
exit;
?>
<?php
if (isset($_GET['id'])) {
    $tasks = json_decode(file_get_contents('tasks.json'), true);
    $id = $_GET['id'];
    $tasks[$id]['completed'] = !$tasks[$id]['completed'];
    file_put_contents('tasks.json', json_encode($tasks));
}

header('Location: index.php');
exit;
?>
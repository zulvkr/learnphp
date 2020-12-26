<?php
if (isset($_POST['joketext'])) {
    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        $query = insertJoke($pdo, [
            'joketext' => $_POST['joketext'], 
            'authorid' => 1,
            'jokedate' => new DateTime()
        ]);

        header('location: jokes.php');

    } catch (PDOException $e) {
        $title = 'error happened';

        $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'add new joke';

    ob_start();
    
    include __DIR__ . '/../templates/addjoke.html.php';
    
    $output = ob_get_clean();
}

include __DIR__ . '/../templates/layout.html.php';
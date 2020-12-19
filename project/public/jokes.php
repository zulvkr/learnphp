<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $jokes = alljokes($pdo);

    $title = 'Joke list';

    $totalJokes = totalJokes($pdo);

    ob_start();
    include __DIR__ . '/../templates/jokes.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';

    $output = 'Database error: ' . $e->getMessage() . 'in ' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';

?>
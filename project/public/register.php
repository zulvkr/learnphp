<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../controllers/RegisterController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $registerController = new RegisterController($jokesTable, $authorsTable);

    $action = $_GET['action'] ?? 'home';

    $controllerName = $_GET['controller'] ?? 'joke';

    if ($action == strtolower($action) &&
    $controllerName == strtolower($controllerName)) {
        $className = ucfirst($controllerName) . 'Controller';

        include __DIR__ . '/../controllers/' . $className . '.php';
    
        $controller = new $className($jokesTable, $authorsTable);
        $page = $controller->$action();
    } else {
        http_response_code(301);
        header('location: index.php?controller=' . 
        strtolower($controllerName) . '&action=' . 
        strtolower($action));
    }

    if ($action == strtolower($action)) {
        $page = $registerController->$action;
    } else {
        http_response_code(301);
        header('location: index.php?action=' . strtolower($action));
    }

    $title = $page['title'];

    if (isset($page['variables'])) {
        $output = loadTemplate(
            $page['template'],
            $page['variables']
        );
    } else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Error: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
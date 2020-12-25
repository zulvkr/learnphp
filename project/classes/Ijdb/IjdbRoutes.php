<?php

namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes
{
    public function getRoutes()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

        $jokeController = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
        $authorController = new \Ijdb\Controllers\Register($authorsTable);

        $routes = [
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ]
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ],
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ]
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ]
        ];

        return $routes;

        // if ($route === 'joke/list') {
        //     $controller = new \Ijdb\Controllers\Joke(
        //         $jokesTable,
        //         $authorsTable
        //     );
        //     $page = $controller->list();
        // } else if ($route === '') {
        //     $controller = new \Ijdb\Controllers\Joke(
        //         $jokesTable,
        //         $authorsTable
        //     );
        //     $page = $controller->home();
        // } else if ($route === 'joke/edit') {
        //     $controller = new \Ijdb\Controllers\Joke(
        //         $jokesTable,
        //         $authorsTable
        //     );
        //     $page = $controller->edit();
        // } else if ($route === 'joke/delete') {
        //     $controller = new \Ijdb\Controllers\Joke(
        //         $jokesTable,
        //         $authorsTable
        //     );
        //     $page = $controller->delete();
        // } else if ($route === 'register') {
        //     include __DIR__ .
        //         '/../classes/controllers/RegisterController.php';
        //     // $controller = new RegisterController($authorsTable);
        //     $page = $controller->showForm();
        // }

        // return $page;
    }
}

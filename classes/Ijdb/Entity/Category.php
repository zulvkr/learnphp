<?php

namespace Ijdb\Entity;

use Ninja\DatabaseTable;

class Category
{
    public $id;
    public $name;
    private $jokesTable;
    private $jokeCategoriesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $jokeCategoriesTable)
    {
        $this->jokesTable = $jokesTable;
        $this->jokeCategoriesTable = $jokeCategoriesTable;
    }

    public function getJokes()
    {

        // return filtered table of joke cat
        $jokeCategories = $this->jokeCategoriesTable->find('categoryId', $this->id);

        $jokes = [];

        //return array contain jokes with id in jokecat
        foreach ($jokeCategories as $jokeCategory) {
            $joke = $this->jokesTable->findById($jokeCategory->jokeId);
            if ($joke) {
                $jokes[] = $joke;
            }
        }

        return $jokes;
    }
}

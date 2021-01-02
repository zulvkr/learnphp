<?php

namespace Ijdb\Entity;

class Joke
{
    public $id;
    public $authorid;
    public $jokedate;
    public $joketext;
    private $authorsTable;
    private $author;
    private $jokeCategoriesTable;

    public function __construct(
        \Ninja\DatabaseTable $authorsTable,
        \Ninja\DatabaseTable $jokeCategoriesTable
        )
    {
        $this->authorsTable = $authorsTable;
        $this->jokeCategoriesTable =$jokeCategoriesTable;
    }

    public function getAuthor()
    {
        if (empty($this->author)) {
            return $this->authorsTable->findById($this->authorid);
        }

        return $this->author;
    }

    public function addCategory($categoryId)
    {
        $jokeCat = ['jokeId' => $this->id,
        'categoryId' => $categoryId ];

        $this->jokeCategoriesTable->save($jokeCat);
    }
}

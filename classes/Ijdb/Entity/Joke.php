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

    public function __construct(\Ninja\DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function getAuthor()
    {
        if (empty($this->author)) {
            return $this->authorsTable->findById($this->authorid);
        }

        return $this->author;
    }
}

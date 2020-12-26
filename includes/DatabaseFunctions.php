<?php

    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function totalJokes($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
        $row = $query->fetch();
        return $row[0];
    }

    function getJoke($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
        return $query->fetch();
    }

    function insertJoke($pdo, $fields) {
        $query = 'INSERT INTO `joke` (';

        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }
        
        $query =  rtrim($query, ',');

        $query .= ') VALUES (';

        foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }

        $query =  rtrim($query, ',');

        $query .= ')';

        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }

        query($pdo, $query, $fields); 
    }


    // function insertJoke($pdo, $joketext, $authorId) {
    //     $query = 'INSERT INTO `joke` ( `joketext`, `jokedate`, `authorid`)
    //         VALUES ( :joketext, CURDATE(), :authorId )';
        
    //     $parameters = [':joketext' => $joketext, ':authorId' => $authorId];

    //     query($pdo, $query, $parameters); 
    // }

    function updateJoke($pdo, $fields) {
        $query = 'UPDATE `joke` SET ';

        //what is this array var
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `id` = :primaryKey';

        // Set primary key
        $fields['primaryKey'] = $fields['id'];

        query($pdo, $query, $fields);
    }

    // Function already replaced
    // function updateJoke($pdo, $jokeId, $joketext, $authorId) {
    //     $query = 'UPDATE `joke` SET `joketext` = :joketext, 
    //     `authorid` = :authorId WHERE `id` = :id ';

    //     $parameters = [
    //         ':joketext' => $joketext,
    //         ':authorId' => $authorId,
    //         ':id' => $jokeId
    //     ];

    //     query($pdo, $query, $parameters);
    // }

    function deleteJoke($pdo, $id) {
        $query = 'DELETE FROM `joke` WHERE `id` = :id';
        $parameters = [':id' => $id];

        query($pdo, $query, $parameters);
    }

    function alljokes($pdo) {
        $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `name`, `email` 
            FROM `joke` INNER JOIN `author`
            ON `authorid` = `author`.`id`');

        return $jokes->fetchAll();
    }
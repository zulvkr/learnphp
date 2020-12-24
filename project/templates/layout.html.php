<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/jokes.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <h1>Internet Joke Database</h1>
    </header>
    <nav>Publishing MySQL Data on the Web 153
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">Jokes List</a></li>
            <li><a href="/joke/edit">Add Joke</a></li>
        </ul>
    </nav>
    <main>
        <?= $output ?>
    </main>
    <footer>
        &copy; IJDB 2017
    </footer>
</body>

</html>
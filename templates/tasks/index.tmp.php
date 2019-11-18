<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Tasks</h1>
<ul>
    <?php foreach ($tasks as $task){?>
        <li>
            <a href="/tasks/<?php $escape($task->id) ?>">
                <?php $escape($task->title) ?> : <?php $escape($task->status) ?>
            </a>
        </li>
    <?php } ?>
</ul>
</body>
</html>
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
<h2>Tasks Detail</h2>

<a href="/tasks/">Back to list</a>
<ul>
    <li>
        Title: <?php $escape($task->title) ?>
    </li>
    <li>
        Status: <?php $escape($task->status) ?>
    </li>
</ul>

<a href="/tasks/<?php $escape($task->id) ?>/edit">EDIT</a>

<form action="/tasks/<?php $escape($task->id) ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="DELETE">
</form>
</body>
</html>

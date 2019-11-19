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
<?php if(empty($errors) === false){ ?>
<ul>
    <?php foreach($errors as $key => $message){ ?>
        <li> <?php $escape($message) ?></li>


    <?php } ?>
</ul>
<?php } ?>

<form action="/auth/sign-up" method="POST">

    <ul>
        <li>
            <label>
                User Name:
                <input type="text" name="name">
            </label>
        </li>
        <li>
            <label>
                Password:
                <input  type="text" name="password">
            </label>
        </li>
    </ul>

    <input type="submit" value="SignUp">
</form>
<a href="/auth/login">Login</a>
</body>
</html>

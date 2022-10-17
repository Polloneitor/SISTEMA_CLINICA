<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
        <?php
        // To print success flash message
        if (session()->get("success")) {
        ?>
            <div class="alert alert-success">
                <?= session()->get("success") ?>
            </div>
        <?php
        }
        ?>
        <?php
        // To print error messages
        if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</body>

</html>
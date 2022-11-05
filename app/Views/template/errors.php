<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>
    /* Style the close button (span) */
.close {
  cursor: pointer;
  position: absolute;
  top: 50%;
  right: 0%;
  padding: 12px 16px;
  transform: translate(0%, -50%);
}

.close:hover {background: #bbb;}
</style>
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
                <span class="close">&times;</span>
            </div>
        <?php endif ?>
    </div>
</body>
<script>
    // Get all elements with class="close"
var closebtns = document.getElementsByClassName("close");
var i;

// Loop through the elements, and hide the parent, when clicked on
for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
</html>
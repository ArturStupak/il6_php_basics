<?php include 'parts/header.php'; ?>

<html>
    <head>
        <title>Create ad</title>
    </head>
    <body>
        <form action="submitad.php" method="post">
            <input type="text" name="title" placeholder="title"> <br>
            <textarea name="content">
                details...
            </textarea><br>
            <input type="number" name="price" placeholder="xxx$"><br>
            <select name="year">
                <?php for($i= 1990; $i <= date('Y'); $i++){
                    echo '<option value="'.$i.'">' .$i. '</option>';
                } ?>
            </select>
            <br>
            <input type="submit" name="create" value="create">
        </form>
    <?php include 'parts/footer.php'; ?>

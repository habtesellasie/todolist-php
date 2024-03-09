<?php


$todos = [];
if (file_exists('todo.json')) {
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo app</title>
    <style>
        form {
            margin-bottom: 2rem;
        }

        .container {
            margin-top: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: solid black;
            border-radius: 4px;
            max-width: 500px;
            padding: 20px 0px;
            margin-inline: auto;
            box-shadow: 0 0 10px black;
            padding-bottom: 30px;
        }

        .wrapper {
            text-align: left;
            border-bottom: black solid;
            width: 80%;
            display: flex;
            padding: 10px 0;
            align-items: center;
            position: relative;
        }



        .wrapper form input[type='submit'] {
            color: red;
            border: none;
            padding: 5px;
            /* margin-top: 1rem; */

        }

        .wrapper .form {
            margin-left: auto;
            position: absolute;
            right: 0;
            top: .7rem;
        }

        .wrapper form:first-child {
            display: inline-block;
            position: absolute;
            left: -2rem;
            top: .7rem;
        }

        input {
            padding: 8px 10px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Todo Lists</h2>
        <form action="addtodo.php" method="POST">

            <input type="text" name="todo_name" class="comeon">
            <input type="submit" value="+">
        </form>
        <?php foreach ($todos as $todo_name => $todo) : ?>
            <div class="wrapper">
                <form action="change_status.php" method="POST">
                    <input type="hidden" name="todo_name" value="<?php echo $todo_name ?>">

                    <input class="hello" type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?>>
                </form>
                <?php echo $todo_name ?>
                <form class="form" action="delete.php" method="POST">
                    <input type="hidden" name="todo_name" value="<?php echo $todo_name ?>">
                    <input type="submit" value="del">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        const checkboxes = document.querySelectorAll(".hello")

        checkboxes.forEach(ch => {
            ch.addEventListener('click', function() {
                this.parentNode.submit();
                this.parentNode.textDecoration = 'line-through';
            })
        })
        document.querySelector('.comeon').focus();
    </script>
</body>

</html>
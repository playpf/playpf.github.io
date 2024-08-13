<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];

    $existingMessages = file_get_contents('messages.txt');

    $newMessage = "$name: $message\n";
    file_put_contents('messages.txt', $newMessage . $existingMessages);

    header("Location: forum.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>像素花 Pixel Flower 服务器 - 留言板</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        nav a {
            display: inline-block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #ddd;
        }

        .green-inverse {
            background-color: green;
            color: white;
        }

        form {
            max-width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], textarea {
            width: 99%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #ff6347;
            color: white;
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            border-radius: 3px;
            align-self: flex-end;
            font-size: 18px;
        }

        button[type="submit"]:hover {
            background-color: #ff4500;
        }

        .messages {
            max-width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .submit-message {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .submit-message span {
            color: red;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>像素花 Pixel Flower 服务器</h1>
    </header>
    <nav>
        <a href="index.html">主页</a>
        <a href="forum.php" class="green-inverse">留言板</a>
        <a href="download.html">下载客户端</a>
    </nav>

    <form action="forum.php" method="post">
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name" required>

        <label for="message">留言:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <div class="submit-message">
            <span>请在遵守法律与相关法规的前提下发表留言。</span>
            <button type="submit">提交留言</button>
        </div>
    </form>

    <section class="messages">
        <h2>留言板</h2>
        <?php
        if (file_exists('messages.txt')) {
            $messages = file_get_contents('messages.txt');
            $lines = explode("\n", $messages);

            foreach ($lines as $line) {
                if (!empty($line)) {
                    echo "<div class='message'>$line</div>";
                }
            }
        }
        ?>
    </section>

    <footer>
        <p>版权所有 © 像素花服务器 2024</p>
    </footer>
</body>
</html>
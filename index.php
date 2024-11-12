<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $data = ['url' => $url];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/welcome/php-developer-base/Module-18/HTMLProcessor.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);

        curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE)  === 200) {
            $images = json_decode(curl_exec($ch));
            if (!empty($images)) {
                echo '<div>';
                foreach ($images as $image) {
                    echo '<img src="' . htmlspecialchars($image) . '" />';
                }
                echo '</div>';
            } else {
                echo 'Картинки не найдены';
            }
        } elseif (curl_getinfo($ch, CURLINFO_HTTP_CODE)  === 404) {
            echo '<div style="border: 2px solid pink; background-color: #fbd6e8; padding: 10px; border-radius: 5px; margin-bottom: 15px;">Картинки не найдены</div>';
        } else {
            echo 'Неизвестная ошибка';
        }
    } else {
        echo '<div style="border: 2px solid pink; background-color: #fbd6e8; padding: 10px; border-radius: 5px; margin-bottom: 15px;">Адрес не найден</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PARSING</title>
    <style>
        body {
            margin: 0;
            background-color: #f8f9fa;
        }

        .form {
            display: flex;
            flex-direction: column;
            max-width: 600px;
            margin: 0 auto;
            margin-top: 150px;
            padding: 10px;
            border: 1px solid grey;
            border-radius: 10px;
            box-shadow: 0 0 10px grey;
        }
    </style>
</head>
<body>
    <form class="form" action="./index.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="url">Введите URL</label>
            <input class="form-control" type="text" name="url"> <br>
            <input class="btn btn-outline-secondary" type="submit" value="Отправить">
        </div>
    </form>
</body>
</html>
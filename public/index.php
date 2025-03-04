<?php
$pageTitle = "Janos's Blog";
$messages = [];
$message = "Hello Terezíčku!";

for ($i = 1; $i <= 5; $i++) {
    $messages[] = strval($i) . ". " . $message;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title><?= $pageTitle ?></title>
</head>

<body>
    <div class="container">
    <?php require_once '../includes/header.php'; ?>
        <h1>Janos's Blog</h1>
        <ul>
            <?php foreach ($messages as $message) : ?>
                <h2><?= $message ?></h2>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>
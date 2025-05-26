<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title><?= htmlspecialchars($title) ?? 'János Litkei'; ?></title>
</head>

<body>
    <?php require VIEWROOT . "partials/header.php"; ?>
    <div class="px-6 pt-24 md:px-0 md:max-w-5/8 md:mx-auto">
        <?php require VIEWROOT . $viewPath . '.php'; ?>
    </div>
</body>

</html>

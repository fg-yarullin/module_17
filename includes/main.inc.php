<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">

        <header class="header">
            <?php include './includes/header.inc.php' ?>
        </header>

        <div class="persons">
            <div class="persons_data">
                <code>
                    <?php
//                    $randomNumber = mt_rand(0, count($persons_array) - 1);
//                    $person = $persons_array[$randomNumber];
                    $person = getPersonWhoseGenderIsRecognized($persons_array);
                    $nameParts = getPartsFromFullName($person['fullName']);
//                    echo '<br>';
//                    echo getFullNameFromPart('Иванов', 'Иван', 'Иванович');
//                    echo '<br>';
//                    echo getShortName($person['fullName']) . ' пол "' . getGenderFromName($person['fullName']) . '" (1 - мужчина, -1 - женщина, 0 - не удалось определить)';
//                    echo '<br>';
                    echo getGenderDescription($persons_array);
                    echo '<br>';
                    echo getPerfectPartner($nameParts['surname'], $nameParts['name'], $nameParts['patronymic'], $persons_array);
                    ?>
                </code>
            </div>
        </div>

        <footer class="grid-item copyright_social">
            <?php include './includes/footer.inc.php' ?>
        </footer>
    </div>

</body>
</html>
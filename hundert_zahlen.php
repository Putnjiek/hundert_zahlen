<!DOCTYPE html>
<html lang="de">

<head>
    <title>Hundert Zahlen</title>
    <link rel="stylesheet" href="styling.css">
</head>

<body>
    <h1>Hundert Zahlen</h1>
    <table>
        <?php
        $zahlen = range(1, 100);
        foreach ($zahlen as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
        ?>
    </table>
</body>

</html>
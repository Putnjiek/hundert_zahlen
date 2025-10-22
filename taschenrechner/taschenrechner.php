<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title>Taschenrechner</title>
    <link rel="stylesheet" href="taschenrechner.css">
</head>

<body>
    <h1>Taschenrechner</h1>
    <form method="post">
        <div class="grid">
            <div class="flex">
                <div class="grid">
                    <span>Operand 1</span>
                    <input type="number" name="operand1" value="<php? echo $operand1; ?>" />
                </div>
                <div class="grid">
                    <span>Operator</span>
                    <span>+</span>
                </div>
                <div class="grid">
                    <span>Operand 2</span>
                    <input type="number" name="operand2" value="<php? echo $operand2; ?>" />
                </div>
                <div class="grid bottom">
                    <span>=</span>
                </div>
                <div class="grid">
                    <span>Ergebnis</span>
                    <input type="number" name="ergebnis" value="<php? echo $ergebnis; ?>" disabled />
                </div>
            </div>
            <input type="submit" class="button" name="btn_berechnen" value="Berechnen" />
        </div>
        <?php
        $_SESSION["operand1"] = $_POST["operand1"] ?? 0;
        $_SESSION["operand2"] = $_POST["operand2"] ?? 0;
        $operand1 = $_SESSION["operand1"] ?? 0;
        $operand2 = $_SESSION["operand2"] ?? 0;
        $ergebnis = $operand1 + $operand2;
        $_SESSION["ergebnis"] = $ergebnis;
        echo ($ergebnis);
        ?>
    </form>
</body>

</html>
<?php
session_start();

// Initialisierung der Ergebnisliste in der Session
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

// Initialisierung des Operators in der Session
if (!isset($_SESSION['operator'])) {
    $_SESSION['operator'] = "plus";
}

// Speicher-Funktion (M+)
if (isset($_POST['madd']) && isset($_POST['ergebnis_value'])) {
    $_SESSION['memory'] = floatval($_POST['ergebnis_value']);
}

// Memory Read (MR)
$memory = $_SESSION['memory'] ?? null;

// Clear History (RC)
if (isset($_POST['rclear'])) {
    $_SESSION['history'] = [];
}

// Berechnung
$ergebnis = null;
if (isset($_POST['operand1']) && isset($_POST['operand2'])) {
    $operand1 = floatval($_POST['operand1']);
    $operand2 = floatval($_POST['operand2']);
    $operator = $_POST['operator'] ?? "plus";

    switch ($operator) {
        case 'minus':
            $ergebnis = $operand1 - $operand2;
            break;
        case 'mal':
            $ergebnis = $operand1 * $operand2;
            break;
        case 'geteilt':
            $ergebnis = $operand1 / $operand2;
            break;
        default:
            $ergebnis = $operand1 + $operand2;

    }

    // Ergebnis speichern
    $_SESSION['history'][] = $ergebnis;
    $_SESSION['operator'] = $operator;
}
?>
<!doctype html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taschenrechner</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
</head>

<body>
    <main class="m-10">
        <h1 class="text-4xl mb-6">Taschenrechner</h1>

        <form method="post" class="mb-8 flex items-start gap-4">
            <div class="flex flex-col">
                <label for="history" class="mb-2 font-semibold">Ergebnisverlauf:</label>
                <select id="history" class="select" readonly>
                    <?php if (!empty($_SESSION['history'])): ?>
                        <?php foreach ($_SESSION['history'] as $value): ?>
                            <option><?php echo htmlspecialchars($value); ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled selected>(noch keine Ergebnisse)</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="flex flex-col justify-end">
                <input type="submit" class="btn btn-error" name="rclear" value="RC" />
            </div>
        </form>

        <!-- Taschenrechner-Formular -->
        <form class="flex gap-8 flex-wrap" method="post">
            <div class="flex flex-col gap-4 items-center">
                <label for="operand1">Operand 1</label>
                <input class="input input-bordered" type="number" id="operand1" name="operand1" step="any"
                    value="<?php echo isset($_POST['mread']) && $memory !== null ? htmlspecialchars($memory) : ''; ?>" />
            </div>

            <div class="flex flex-col gap-4 items-center">
                <label for="operator">Operator</label>
                <select id="operator" class="select" name="operator">
                    <?php if (!empty($_SESSION['operator'])): ?>
                        <option value="plus" <?php echo $_SESSION['operator'] === 'plus' ? 'selected' : '' ?>>
                            +
                        </option>
                        <option value="minus" <?php echo $_SESSION['operator'] === 'minus' ? 'selected' : '' ?>>
                            -
                        </option>
                        <option value="mal" <?php echo $_SESSION['operator'] === 'mal' ? 'selected' : '' ?>>
                            *
                        </option>
                        <option value="geteilt" <?php echo $_SESSION['operator'] === 'geteilt' ? 'selected' : '' ?>>
                            /
                        </option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="flex flex-col gap-4 items-center">
                <label for="operand2">Operand 2</label>
                <input class="input input-bordered" type="number" id="operand2" name="operand2" step="any" />
            </div>

            <div class="flex flex-col gap-4 items-center">
                <label for="ergebnis">Ergebnis</label>
                <div class="flex gap-2 items-center">
                    <?php if ($ergebnis !== null): ?>
                        = <input class="input input-bordered" name="ergebnis_display" disabled
                            value="<?php echo $ergebnis; ?>" />
                        <input type="hidden" name="ergebnis_value" value="<?php echo $ergebnis; ?>" />
                    <?php else: ?>
                        =
                        <div class="input input-bordered min-w-10"></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex gap-2 flex-wrap">
                <button class="btn btn-primary" type="submit">Berechnen <kbd class="kbd text-black">⏎</kbd></button>
                <a href="index.php" class="btn">C</a>
                <input class="btn" value="M+" name="madd" type="submit" />
                <input class="btn" value="MR" name="mread" type="submit" />
            </div>
        </form>

        <?php if ($memory !== null): ?>
            <p class="mt-6">🧠 Memory: <?php echo htmlspecialchars($memory); ?></p>
        <?php endif; ?>
    </main>
</body>

</html>
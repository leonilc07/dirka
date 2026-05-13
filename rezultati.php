<?php
session_start();

if (!isset($_SESSION['tocke1'])) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$igralci = array(
    array('ime' => $_SESSION['ime1'], 'tocke' => $_SESSION['tocke1'], 'avto' => 'car1.png'),
    array('ime' => $_SESSION['ime2'], 'tocke' => $_SESSION['tocke2'], 'avto' => 'car2.png'),
    array('ime' => $_SESSION['ime3'], 'tocke' => $_SESSION['tocke3'], 'avto' => 'car3.png')
);

usort($igralci, function($a, $b) {
    return $b['tocke'] - $a['tocke'];
});

$max = $igralci[0]['tocke'];
$zmagovalci = array();
foreach ($igralci as $i) {
    if ($i['tocke'] == $max) $zmagovalci[] = ($i['ime']);
}

?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Race — Rezultati</title>
    <link rel="stylesheet" href="css/rezultati.css">
</head>
<body>

    <canvas id="petarde"></canvas>

    <div class="naslov">Rezultati dirke</div>

    <div class="zmagovalec-banner">
        <?php if (count($zmagovalci) == 1): ?>
            Zmagovalec: <strong><?php echo $zmagovalci[0]; ?></strong> &mdash; <?php echo $max; ?> pik
        <?php else: ?>
            Zmagovalci: <strong><?php echo implode('</strong> in <strong>', $zmagovalci); ?></strong> &mdash; <?php echo $max; ?> pik
        <?php endif; ?>
    </div>

    <div class="pozicije">

        <div class="pozicija mesto-1">
            <div class="ime"><?php echo htmlspecialchars($igralci[0]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[0]['tocke']; ?> pik</div>
            <img src="img/<?php echo $igralci[0]['avto']; ?>" alt="Avto" class="avto">
        </div>

        <div class="pozicija mesto-2">
            <div class="ime"><?php echo htmlspecialchars($igralci[1]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[1]['tocke']; ?> pik</div>
            <img src="img/<?php echo $igralci[1]['avto']; ?>" alt="Avto" class="avto">
        </div>

        <div class="pozicija mesto-3">
            <div class="ime"><?php echo htmlspecialchars($igralci[2]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[2]['tocke']; ?> pik</div>
            <img src="img/<?php echo $igralci[2]['avto']; ?>" alt="Avto" class="avto">
        </div>

    </div>

    <div class="gumb-wrapper">
        <a href="rezultati.php?reset=1" class="gumb">Igraj znova</a>
        <div class="odstevalnik">Preusmeritev čez <span id="cas">10</span> s...</div>
    </div>

    <script src="js/petarde.js"></script>
    <script>
    var cas = 10;
    setInterval(function () {
        cas--;
        document.getElementById('cas').textContent = cas;
        if (cas <= 0) window.location.href = 'index.php';
    }, 1000);
    </script>

</body>
</html>

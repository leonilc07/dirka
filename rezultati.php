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
    array('ime' => $_SESSION['ime1'], 'tocke' => $_SESSION['tocke1'], 'barva' => '#ff3333'),
    array('ime' => $_SESSION['ime2'], 'tocke' => $_SESSION['tocke2'], 'barva' => '#4488ff'),
    array('ime' => $_SESSION['ime3'], 'tocke' => $_SESSION['tocke3'], 'barva' => '#ffcc00'),
);

usort($igralci, function($a, $b) {
    return $b['tocke'] - $a['tocke'];
});

function avto_svg($barva, $sirina) {
    return '<svg viewBox="0 0 80 42" xmlns="http://www.w3.org/2000/svg" width="' . $sirina . '" style="display:block;margin:0 auto">
        <rect x="2" y="20" width="76" height="14" rx="3" fill="' . $barva . '"/>
        <rect x="20" y="8" width="36" height="14" rx="4" fill="' . $barva . '" opacity="0.7"/>
        <rect x="23" y="10" width="14" height="10" rx="2" fill="rgba(200,235,255,0.5)"/>
        <rect x="40" y="10" width="14" height="10" rx="2" fill="rgba(200,235,255,0.5)"/>
        <circle cx="18" cy="34" r="7" fill="#111"/>
        <circle cx="62" cy="34" r="7" fill="#111"/>
    </svg>';
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Race — Rezultati</title>
    <link rel="icon" type="image/svg+xml" href="img/icon.svg">
    <link rel="stylesheet" href="css/rezultati.css">
</head>
<body>

    <canvas id="petarde"></canvas>

    <div class="naslov">Rezultati dirke</div>

    <div class="podium">

        <!-- 2. mesto — levo -->
        <div class="podium-kolona">
            <div class="podium-avto">
                <?php echo avto_svg($igralci[1]['barva'], 80); ?>
            </div>
            <div class="stopnica stopnica-2">
                <div class="st-vsebina">
                    <div class="st-ime"><?php echo htmlspecialchars($igralci[1]['ime']); ?></div>
                    <div class="st-tocke"><?php echo $igralci[1]['tocke']; ?> pik</div>
                </div>
                <div class="st-stevilka">2</div>
            </div>
        </div>

        <!-- 1. mesto — sredina -->
        <div class="podium-kolona">
            <div class="podium-avto">
                <?php echo avto_svg($igralci[0]['barva'], 100); ?>
            </div>
            <div class="stopnica stopnica-1">
                <div class="st-vsebina">
                    <div class="st-ime"><?php echo htmlspecialchars($igralci[0]['ime']); ?></div>
                    <div class="st-tocke"><?php echo $igralci[0]['tocke']; ?> pik</div>
                </div>
                <div class="st-stevilka">1</div>
            </div>
        </div>

        <!-- 3. mesto — desno -->
        <div class="podium-kolona">
            <div class="podium-avto">
                <?php echo avto_svg($igralci[2]['barva'], 80); ?>
            </div>
            <div class="stopnica stopnica-3">
                <div class="st-vsebina">
                    <div class="st-ime"><?php echo htmlspecialchars($igralci[2]['ime']); ?></div>
                    <div class="st-tocke"><?php echo $igralci[2]['tocke']; ?> pik</div>
                </div>
                <div class="st-stevilka">3</div>
            </div>
        </div>

    </div>

    <div class="odstevalnik">Preusmeritev čez <span id="cas">10</span> s...</div>

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

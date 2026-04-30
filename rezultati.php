<?php
// ============================================
// DICE RACE — Stran 3: Rezultati
// ============================================
session_start();

// Ce seja ne obstaja (npr. direkten obisk) — nazaj na zacetek
if (!isset($_SESSION['tocke1'])) {
    header('Location: index.php');
    exit;
}

// Ce je prišel zahtevek za reset — unici sejo in pojdi na zacetek
if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// --------------------------------------------------
// PREBERI IZ SEJE
// --------------------------------------------------
$ime1   = $_SESSION['ime1'];
$ime2   = $_SESSION['ime2'];
$ime3   = $_SESSION['ime3'];
$tocke1 = $_SESSION['tocke1'];
$tocke2 = $_SESSION['tocke2'];
$tocke3 = $_SESSION['tocke3'];

// --------------------------------------------------
// SESTAVI ARRAY IGRALCEV
// --------------------------------------------------
$igralci = array(
    array('ime' => $ime1, 'tocke' => $tocke1, 'avto' => 'car1.png'),
    array('ime' => $ime2, 'tocke' => $tocke2, 'avto' => 'car2.png'),
    array('ime' => $ime3, 'tocke' => $tocke3, 'avto' => 'car3.png')
);

// --------------------------------------------------
// RAZVRSTI OD NAJVEC DO NAJMANJ TOCK
// --------------------------------------------------
usort($igralci, function($a, $b) {
    return $b['tocke'] - $a['tocke'];
});

// --------------------------------------------------
// RESI IZENACITVЕ z rand(1,2)
// --------------------------------------------------

// Izenacenje med 1. in 2. mestom
if ($igralci[0]['tocke'] == $igralci[1]['tocke']) {
    if (rand(1, 2) == 2) {
        $temp        = $igralci[0];
        $igralci[0]  = $igralci[1];
        $igralci[1]  = $temp;
    }
}

// Izenacenje med 2. in 3. mestom
if ($igralci[1]['tocke'] == $igralci[2]['tocke']) {
    if (rand(1, 2) == 2) {
        $temp        = $igralci[1];
        $igralci[1]  = $igralci[2];
        $igralci[2]  = $temp;
    }
}

// Zdaj je:
// $igralci[0] = 1. mesto
// $igralci[1] = 2. mesto
// $igralci[2] = 3. mesto

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

    <!-- CANVAS ZA JS PETARDE -->
    <canvas id="petarde"></canvas>

    <!-- NASLOV -->
    <div class="naslov">Rezultati dirke</div>

    <!-- POZICIJE AVTOV IN IMEN NAD STOPNICAMI -->
    <div class="pozicije">

        <!-- 1. MESTO — sredina -->
        <div class="pozicija mesto-1">
            <img
                src="img/<?php echo $igralci[0]['avto']; ?>"
                alt="Avto"
                class="avto"
            >
            <div class="ime"><?php echo htmlspecialchars($igralci[0]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[0]['tocke']; ?> pik</div>
        </div>

        <!-- 2. MESTO — levo -->
        <div class="pozicija mesto-2">
            <img
                src="img/<?php echo $igralci[1]['avto']; ?>"
                alt="Avto"
                class="avto"
            >
            <div class="ime"><?php echo htmlspecialchars($igralci[1]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[1]['tocke']; ?> pik</div>
        </div>

        <!-- 3. MESTO — desno -->
        <div class="pozicija mesto-3">
            <img
                src="img/<?php echo $igralci[2]['avto']; ?>"
                alt="Avto"
                class="avto"
            >
            <div class="ime"><?php echo htmlspecialchars($igralci[2]['ime']); ?></div>
            <div class="tocke"><?php echo $igralci[2]['tocke']; ?> pik</div>
        </div>

    </div>

    <!-- GUMB IGRAJ ZNOVA -->
    <div class="gumb-wrapper">
        <a href="rezultati.php?reset=1" class="gumb">Igraj znova</a>
    </div>

    <!-- ===== JAVASCRIPT ZA PETARDE ===== -->
    <script src="js/petarde.js"></script>

</body>
</html>

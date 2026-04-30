<?php
// ============================================
// DICE RACE — Stran 2: Dirka
// ============================================
session_start();

// --------------------------------------------------
// 1. PRIHOD IZ index.php (prva krat — POST podatki)
// --------------------------------------------------
if (isset($_POST['ime1'])) {

    if (empty(trim($_POST['ime1'])) || empty(trim($_POST['ime2'])) || empty(trim($_POST['ime3']))) {
        header('Location: index.php?napaka=1');
        exit;
    }

    $runde = intval($_POST['runde']);
    if ($runde < 1)  { $runde = 1; }
    if ($runde > 20) { $runde = 20; }

    $_SESSION['ime1']           = trim($_POST['ime1']);
    $_SESSION['ime2']           = trim($_POST['ime2']);
    $_SESSION['ime3']           = trim($_POST['ime3']);
    $_SESSION['kocke']          = intval($_POST['kocke']);
    $_SESSION['runde']          = $runde;
    $_SESSION['tocke1']         = 0;
    $_SESSION['tocke2']         = 0;
    $_SESSION['tocke3']         = 0;
    $_SESSION['trenutna_runda'] = 1;
    $_SESSION['zgodovina1']     = array();
    $_SESSION['zgodovina2']     = array();
    $_SESSION['zgodovina3']     = array();
    $_SESSION['zadnje_kocke1']  = array();
    $_SESSION['zadnje_kocke2']  = array();
    $_SESSION['zadnje_kocke3']  = array();
}

// --------------------------------------------------
// 2. PRITISK NA GUMB "VRZI RUNDO"
// --------------------------------------------------
if (isset($_POST['vrzi'])) {

    $kocke = $_SESSION['kocke'];

    // Igralec 1
    $vsota1 = 0;
    $meti1  = array();
    for ($k = 0; $k < $kocke; $k++) {
        $met = rand(1, 6);
        $vsota1 += $met;
        $meti1[] = $met;
    }
    $_SESSION['tocke1']       += $vsota1;
    $_SESSION['zadnje_kocke1'] = $meti1;
    $_SESSION['zgodovina1'][]  = array('tocke' => $vsota1, 'kocke' => $meti1);

    // Igralec 2
    $vsota2 = 0;
    $meti2  = array();
    for ($k = 0; $k < $kocke; $k++) {
        $met = rand(1, 6);
        $vsota2 += $met;
        $meti2[] = $met;
    }
    $_SESSION['tocke2']       += $vsota2;
    $_SESSION['zadnje_kocke2'] = $meti2;
    $_SESSION['zgodovina2'][]  = array('tocke' => $vsota2, 'kocke' => $meti2);

    // Igralec 3
    $vsota3 = 0;
    $meti3  = array();
    for ($k = 0; $k < $kocke; $k++) {
        $met = rand(1, 6);
        $vsota3 += $met;
        $meti3[] = $met;
    }
    $_SESSION['tocke3']       += $vsota3;
    $_SESSION['zadnje_kocke3'] = $meti3;
    $_SESSION['zgodovina3'][]  = array('tocke' => $vsota3, 'kocke' => $meti3);

    $_SESSION['trenutna_runda']++;
}

// --------------------------------------------------
// 3. PREBERI IZ SEJE
// --------------------------------------------------
$ime1   = $_SESSION['ime1'];
$ime2   = $_SESSION['ime2'];
$ime3   = $_SESSION['ime3'];
$kocke  = $_SESSION['kocke'];
$runde  = $_SESSION['runde'];
$tocke1 = $_SESSION['tocke1'];
$tocke2 = $_SESSION['tocke2'];
$tocke3 = $_SESSION['tocke3'];
$trenutna_runda = $_SESSION['trenutna_runda'];

$max_tocke = $runde * $kocke * 6;

// Izracunaj pozicijo avta v % (2% = start, 78% = tik pred ciljem)
function pozicija($tocke, $max_tocke) {
    if ($max_tocke == 0) { return 2; }
    $p = ($tocke / $max_tocke) * 76;
    if ($p > 76) { $p = 76; }
    return $p + 2;
}

$poz1 = pozicija($tocke1, $max_tocke);
$poz2 = pozicija($tocke2, $max_tocke);
$poz3 = pozicija($tocke3, $max_tocke);

$igra_koncana = ($trenutna_runda > $runde);

?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Race — Dirka</title>
    <link rel="stylesheet" href="css/igra.css">
</head>
<body>

    <div class="naslov">Dice Race</div>

    <?php if ($igra_koncana): ?>
        <div class="runda-info">Dirka je koncana!</div>
    <?php else: ?>
        <div class="runda-info">
            Runda <span><?php echo $trenutna_runda; ?></span>
            od <span><?php echo $runde; ?></span>
        </div>
    <?php endif; ?>

    <div class="kartica">

        <div class="stolpci">

            <!-- ===== STOLPEC 1 ===== -->
            <div class="stolpec">

                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke1; ?></span> / <?php echo $max_tocke; ?>
                </div>

                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <!-- Avto 1 — slika car1.png -->
                    <div class="avto"  style="left: <?php echo $poz1; ?>%">
                        <img src="img/car1.png" alt="Avto 1">
                    </div>
                    <div class="cesta"></div>
                </div>

                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime1); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina1'] as $i => $r): ?>
                            <tr>
                                <td>Runda <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke1']) > 0): ?>
                        <?php foreach ($_SESSION['zadnje_kocke1'] as $v): ?>
                            <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- ===== STOLPEC 2 ===== -->
            <div class="stolpec">

                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke2; ?></span> / <?php echo $max_tocke; ?>
                </div>

                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <!-- Avto 2 — slika car2.png -->
                    <div class="avto"  style="left: <?php echo $poz2; ?>%">
                        <img src="img/car2.png" alt="Avto 2">
                    </div>
                    <div class="cesta"></div>
                </div>

                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime2); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina2'] as $i => $r): ?>
                            <tr>
                                <td>Runda <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke2']) > 0): ?>
                        <?php foreach ($_SESSION['zadnje_kocke2'] as $v): ?>
                            <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- ===== STOLPEC 3 ===== -->
            <div class="stolpec">

                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke3; ?></span> / <?php echo $max_tocke; ?>
                </div>

                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <!-- Avto 3 — slika car3.png -->
                    <div class="avto" style="left: <?php echo $poz3; ?>%">
                        <img src="img/car3.png" alt="Avto 3">
                    </div>
                    <div class="cesta"></div>
                </div>

                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime3); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina3'] as $i => $r): ?>
                            <tr>
                                <td>Runda <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke3']) > 0): ?>
                        <?php foreach ($_SESSION['zadnje_kocke3'] as $v): ?>
                            <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <!-- GUMB -->
        <div class="gumb-vrstica">
            <?php if ($igra_koncana): ?>
                <a href="rezultati.php" class="gumb konec">Poglej rezultate</a>
            <?php else: ?>
                <form action="igra.php" method="POST">
                    <input type="hidden" name="vrzi" value="1">
                    <button type="submit" class="gumb">
                        Vrzi rundo <?php echo $trenutna_runda; ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>
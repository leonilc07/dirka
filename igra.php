<?php
session_start();

if (isset($_POST['ime1'])) {

    if (empty(trim($_POST['ime1'])) || empty(trim($_POST['ime2'])) || empty(trim($_POST['ime3']))) {
        header('Location: index.php?napaka=1');
        exit;
    }

    $max_tocke = intval($_POST['max_tocke']);
    if ($max_tocke < 10)  { $max_tocke = 10; }
    if ($max_tocke > 500) { $max_tocke = 500; }

    $_SESSION['ime1']          = trim($_POST['ime1']);
    $_SESSION['ime2']          = trim($_POST['ime2']);
    $_SESSION['ime3']          = trim($_POST['ime3']);
    $_SESSION['kocke']         = max(1, min(3, intval($_POST['kocke'])));
    $_SESSION['max_tocke']     = $max_tocke;
    $_SESSION['tocke1']        = 0;
    $_SESSION['tocke2']        = 0;
    $_SESSION['tocke3']        = 0;
    $_SESSION['met']           = 0;
    $_SESSION['tocke1_prev']   = 0;
    $_SESSION['tocke2_prev']   = 0;
    $_SESSION['tocke3_prev']   = 0;
    $_SESSION['zgodovina1']    = array();
    $_SESSION['zgodovina2']    = array();
    $_SESSION['zgodovina3']    = array();
    $_SESSION['zadnje_kocke1'] = array();
    $_SESSION['zadnje_kocke2'] = array();
    $_SESSION['zadnje_kocke3'] = array();

} elseif (!isset($_SESSION['ime1'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['vrzi'])) {

    $kocke = $_SESSION['kocke'];

    $_SESSION['tocke1_prev'] = $_SESSION['tocke1'];
    $_SESSION['tocke2_prev'] = $_SESSION['tocke2'];
    $_SESSION['tocke3_prev'] = $_SESSION['tocke3'];

    $vsota1 = 0; $meti1 = array();
    for ($k = 0; $k < $kocke; $k++) { $m = rand(1,6); $vsota1 += $m; $meti1[] = $m; }
    $_SESSION['tocke1']       += $vsota1;
    $_SESSION['zadnje_kocke1'] = $meti1;
    $_SESSION['zgodovina1'][]  = array('tocke' => $vsota1, 'kocke' => $meti1);

    $vsota2 = 0; $meti2 = array();
    for ($k = 0; $k < $kocke; $k++) { $m = rand(1,6); $vsota2 += $m; $meti2[] = $m; }
    $_SESSION['tocke2']       += $vsota2;
    $_SESSION['zadnje_kocke2'] = $meti2;
    $_SESSION['zgodovina2'][]  = array('tocke' => $vsota2, 'kocke' => $meti2);

    $vsota3 = 0; $meti3 = array();
    for ($k = 0; $k < $kocke; $k++) { $m = rand(1,6); $vsota3 += $m; $meti3[] = $m; }
    $_SESSION['tocke3']       += $vsota3;
    $_SESSION['zadnje_kocke3'] = $meti3;
    $_SESSION['zgodovina3'][]  = array('tocke' => $vsota3, 'kocke' => $meti3);

    $_SESSION['met']++;
}

$ime1        = $_SESSION['ime1'];
$ime2        = $_SESSION['ime2'];
$ime3        = $_SESSION['ime3'];
$kocke       = $_SESSION['kocke'];
$max_tocke   = $_SESSION['max_tocke'];
$tocke1      = $_SESSION['tocke1'];
$tocke2      = $_SESSION['tocke2'];
$tocke3      = $_SESSION['tocke3'];
$met         = $_SESSION['met'];
$tocke1_prev = $_SESSION['tocke1_prev'];
$tocke2_prev = $_SESSION['tocke2_prev'];
$tocke3_prev = $_SESSION['tocke3_prev'];

function pozicija($tocke, $max_tocke) {
    if ($max_tocke == 0) return 2;
    $p = ($tocke / $max_tocke) * 76;
    if ($p > 76) $p = 76;
    return round($p + 2, 1);
}

$poz1      = pozicija($tocke1, $max_tocke);
$poz2      = pozicija($tocke2, $max_tocke);
$poz3      = pozicija($tocke3, $max_tocke);
$poz1_prev = pozicija($tocke1_prev, $max_tocke);
$poz2_prev = pozicija($tocke2_prev, $max_tocke);
$poz3_prev = pozicija($tocke3_prev, $max_tocke);

$igra_koncana = ($tocke1 >= $max_tocke || $tocke2 >= $max_tocke || $tocke3 >= $max_tocke);

function avto_svg($barva) {
    return '<svg viewBox="0 0 80 42" xmlns="http://www.w3.org/2000/svg" width="80" height="42">
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
    <title>Dice Race — Dirka</title>
    <link rel="icon" type="image/svg+xml" href="img/icon.svg">
    <link rel="stylesheet" href="css/igra.css">
</head>
<body>

    <div class="naslov">Dice Race</div>

    <?php if ($igra_koncana): ?>
        <div class="runda-info">Dirka je končana!</div>
    <?php elseif ($met === 0): ?>
        <div class="runda-info">Cilj: <span><?php echo $max_tocke; ?></span> točk</div>
    <?php else: ?>
        <div class="runda-info">
            Met <span><?php echo $met; ?></span> — cilj: <span><?php echo $max_tocke; ?></span> točk
        </div>
    <?php endif; ?>

    <div class="kartica">

        <div class="stolpci">

            <div class="stolpec">
                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke1; ?></span>
                </div>
                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <div class="avto"
                         data-prev="<?php echo $poz1_prev; ?>"
                         data-curr="<?php echo $poz1; ?>"
                         style="left: <?php echo $poz1_prev; ?>%">
                        <?php echo avto_svg('#ff3333'); ?>
                    </div>
                    <div class="cesta"></div>
                </div>
                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime1); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina1'] as $i => $r): ?>
                            <tr>
                                <td>Met <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke1']) > 0): ?>
                        <div class="kocke-anim">
                            <?php for ($i = 0; $i < $kocke; $i++): ?>
                                <img src="img/dice/dice-anim.gif" alt="met..." class="kocka-slika">
                            <?php endfor; ?>
                        </div>
                        <div class="kocke-rezultat" style="display:none">
                            <?php foreach ($_SESSION['zadnje_kocke1'] as $v): ?>
                                <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="stolpec">
                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke2; ?></span>
                </div>
                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <div class="avto"
                         data-prev="<?php echo $poz2_prev; ?>"
                         data-curr="<?php echo $poz2; ?>"
                         style="left: <?php echo $poz2_prev; ?>%">
                        <?php echo avto_svg('#4488ff'); ?>
                    </div>
                    <div class="cesta"></div>
                </div>
                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime2); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina2'] as $i => $r): ?>
                            <tr>
                                <td>Met <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke2']) > 0): ?>
                        <div class="kocke-anim">
                            <?php for ($i = 0; $i < $kocke; $i++): ?>
                                <img src="img/dice/dice-anim.gif" alt="met..." class="kocka-slika">
                            <?php endfor; ?>
                        </div>
                        <div class="kocke-rezultat" style="display:none">
                            <?php foreach ($_SESSION['zadnje_kocke2'] as $v): ?>
                                <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="stolpec">
                <div class="skupne-tocke">
                    Skupaj: <span><?php echo $tocke3; ?></span>
                </div>
                <div class="proga-okvir">
                    <div class="cilj"></div>
                    <div class="avto"
                         data-prev="<?php echo $poz3_prev; ?>"
                         data-curr="<?php echo $poz3; ?>"
                         style="left: <?php echo $poz3_prev; ?>%">
                        <?php echo avto_svg('#ffcc00'); ?>
                    </div>
                    <div class="cesta"></div>
                </div>
                <div class="info-blok">
                    <div class="ime-igralca"><?php echo htmlspecialchars($ime3); ?></div>
                    <table class="zgodovina">
                        <?php foreach ($_SESSION['zgodovina3'] as $i => $r): ?>
                            <tr>
                                <td>Met <?php echo $i + 1; ?>:</td>
                                <td><?php echo $r['tocke']; ?> pik</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="kocke-blok">
                    <?php if (count($_SESSION['zadnje_kocke3']) > 0): ?>
                        <div class="kocke-anim">
                            <?php for ($i = 0; $i < $kocke; $i++): ?>
                                <img src="img/dice/dice-anim.gif" alt="met..." class="kocka-slika">
                            <?php endfor; ?>
                        </div>
                        <div class="kocke-rezultat" style="display:none">
                            <?php foreach ($_SESSION['zadnje_kocke3'] as $v): ?>
                                <img src="img/dice/dice<?php echo $v; ?>.gif" alt="<?php echo $v; ?>" class="kocka-slika">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="kocke-cakanje">Pritisni gumb za met</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="gumb-vrstica">
            <?php if ($igra_koncana): ?>
                <a href="rezultati.php" class="gumb">Poglej rezultate</a>
            <?php else: ?>
                <form action="igra.php" method="POST">
                    <input type="hidden" name="vrzi" value="1">
                    <button type="submit" class="gumb">Vrzi kocke</button>
                </form>
            <?php endif; ?>
        </div>

    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var auti = document.querySelectorAll('.avto');
    auti.forEach(function (avto) {
        var curr = avto.dataset.curr;
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                avto.style.transition = 'left 1s ease';
                avto.style.left = curr + '%';
            });
        });
    });

    var anims = document.querySelectorAll('.kocke-anim');
    var rezultati = document.querySelectorAll('.kocke-rezultat');
    if (anims.length === 0) return;
    setTimeout(function () {
        anims.forEach(function (a) { a.style.display = 'none'; });
        rezultati.forEach(function (r) { r.style.display = ''; });
    }, 1500);
});
</script>

</body>
</html>

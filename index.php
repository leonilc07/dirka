<?php
// ============================================
// DICE RACE — Stran 1: Nastavitve igre
// ============================================
// Ta stran nima seje — samo zbere podatke
// in jih pošlje na igra.php z metodo POST.
// ============================================
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Race</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- LAS VEGAS LOGOTIP -->
    <div class="logo-wrapper">
        <!--
            Ko imaš sliko logotipa, zamenjaj spodnje z:
            <img src="img/logo.png" alt="Las Vegas">
        -->
        <div class="logo-text">DICE RACE</div>
    </div>

    <!-- GLAVNA KARTICA -->
    <div class="kartica">

        <!-- PRIKAZ NAPAKE (ko manjka ime) -->
        <?php if (isset($_GET['napaka'])): ?>
            <div class="napaka">
                Vsa tri imena igralcev morajo biti izpolnjena!
            </div>
        <?php endif; ?>

        <!-- FORMA — pošlje podatke na igra.php -->
        <form action="igra.php" method="POST">

            <!-- VRSTICA: 3 IGRALCI -->
            <div class="igralci-vrstica">

                <!-- Igralec 1 -->
                <div class="igralec-blok">
                    <h3>Igralec 1</h3>
                    <label for="ime1">Ime</label>
                    <input
                        type="text"
                        id="ime1"
                        name="ime1"
                        class="vnosno-polje"
                        maxlength="15"
                        value="<?php echo isset($_GET['ime1']) ? htmlspecialchars($_GET['ime1']) : ''; ?>"
                    >
                </div>

                <!-- Igralec 2 -->
                <div class="igralec-blok">
                    <h3>Igralec 2</h3>
                    <label for="ime2">Ime</label>
                    <input
                        type="text"
                        id="ime2"
                        name="ime2"
                        class="vnosno-polje"
                        maxlength="15"
                        value="<?php echo isset($_GET['ime2']) ? htmlspecialchars($_GET['ime2']) : ''; ?>"
                    >
                </div>

                <!-- Igralec 3 -->
                <div class="igralec-blok">
                    <h3>Igralec 3</h3>
                    <label for="ime3">Ime</label>
                    <input
                        type="text"
                        id="ime3"
                        name="ime3"
                        class="vnosno-polje"
                        maxlength="15"
                        value="<?php echo isset($_GET['ime3']) ? htmlspecialchars($_GET['ime3']) : ''; ?>"
                    >
                </div>

            </div>

            <!-- NASLOV NASTAVITVE -->
            <h3 class="nastavitve-naslov">Nastavitve igre</h3>

            <!-- VRSTICA: NASTAVITVE -->
            <div class="nastavitve-vrstica">

                <!-- Število kock (dropdown) -->
                <div class="nastavitev-blok">
                    <label for="kocke">Število kock za vse igralce</label>
                    <select id="kocke" name="kocke" class="vnosno-polje">
                        <?php
                        // Naredi možnosti od 1 do 6
                        for ($i = 1; $i <= 6; $i++) {
                            $izbrano = ($i == 3) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $izbrano . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Število rund (ročni vnos) -->
                <div class="nastavitev-blok">
                    <label for="runde">Število rund za vse igralce</label>
                    <input
                        type="number"
                        id="runde"
                        name="runde"
                        class="vnosno-polje"
                        min="1"
                        max="20"
                        value="1"
                    >
                </div>

            </div>

            <!-- GUMBI -->
            <div class="gumbi-vrstica">

                <!-- Levo: Začni igro -->
                <button type="submit" class="gumb">
                    ZAČNI IGRO
                </button>

                <!-- Desno: Navodila + Vizitka -->
                <div class="gumbi-desno">
                    <button type="button" id="gumb-navodila" class="gumb">
                        NAVODILA
                    </button>
                    <button type="button" id="gumb-krediti" class="gumb">
                        VIZITKA
                    </button>
                </div>

            </div>

        </form>

    </div>

    <script src="js/dialogi.js"></script>
</body>
</html>
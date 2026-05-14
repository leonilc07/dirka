<?php
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Race</title>
    <link rel="icon" type="image/svg+xml" href="img/icon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="logo-text" id="naslov-igre">DICE RACE</div>

    <div class="kartica">


        <?php if (isset($_GET['napaka'])): ?>
            <div class="napaka">
                Vsa tri imena igralcev morajo biti izpolnjena!
            </div>
        <?php endif; ?>

        <form action="igra.php" method="POST">


            <div class="igralci-vrstica">


                <div class="igralec-blok">
                    <h3>Igralec 1</h3>
                    <label for="ime1">Ime</label>
                    <input type="text" id="ime1" name="ime1" class="vnosno-polje" maxlength="15" value="">
                </div>

                <div class="igralec-blok">
                    <h3>Igralec 2</h3>
                    <label for="ime2">Ime</label>
                    <input type="text" id="ime2" name="ime2" class="vnosno-polje" maxlength="15" value="">
                </div>

                <div class="igralec-blok">
                    <h3>Igralec 3</h3>
                    <label for="ime3">Ime</label>
                    <input type="text" id="ime3" name="ime3" class="vnosno-polje" maxlength="15" value="">
                </div>

            </div>

            <h3 class="nastavitve-naslov">Nastavitve igre</h3>

            <div class="nastavitve-vrstica">

                <div class="nastavitev-blok">
                    <label for="kocke">Število kock za vse igralce</label>
                    <select id="kocke" name="kocke" class="vnosno-polje">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            $izbrano = ($i == 3) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $izbrano . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="nastavitev-blok">
                    <label for="max_tocke">Ciljne točke</label>
                    <input type="number" id="max_tocke" name="max_tocke" class="vnosno-polje" min="10" max="500" value="50">
                </div>

            </div>

            <div class="gumbi-vrstica">

                <button type="submit" class="gumb">
                    ZAČNI IGRO
                </button>

            </div>

        </form>

    </div>

    <span id="vizitka-napis" class="vizitka-napis">VIZITKA</span>

    <script src="js/dialogi.js"></script>
</body>
</html>
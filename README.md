# 🎲 Dice Race

Spletna igra z metanjem kock in dirko avtomobilov. Trije igralci tekmujejo med seboj — vsaka runda vržejo kocke in njihov avto se premakne naprej glede na število pik. Zmagovalec je tisti, ki zbere največ točk.

Projekt je narejen v **PHP** z uporabo **sej (sessions)** za prenos podatkov med stranmi.

---

## Zahteve

- XAMPP (Apache + PHP)
- Brskalnik (Chrome, Firefox, Edge...)
- Windows / Linux / macOS

---

## Namestitev

1. Kloniraj repozitorij v mapo `htdocs`:
```
C:\xampp\htdocs\dirka\
```

2. Zaženi **XAMPP Control Panel** in klikni **Start** pri **Apache**

3. Odpri brskalnik in pojdi na:
```
http://localhost/dirka/index.php
```

---

## Struktura datotek

```
dirka/
├── index.php               ← Stran 1: Nastavitve igre
├── igra.php                ← Stran 2: Dirka z metanjem kock
├── rezultati.php           ← Stran 3: Zmagovalci na stopničkah
│
├── css/
│   ├── style.css           ← Stil za index.php
│   ├── igra.css            ← Stil za igra.php
│   └── rezultati.css       ← Stil za rezultati.php
│
├── js/
│   ├── dialogi.js          ← SweetAlert2 dialogi
│   └── petarde.js          ← Konfeti animacija
│
└── img/
    ├── icon.svg                ← Ikona zavihka (favicon)
    ├── backround.png           ← Ozadje (stran 1 in 2)
    ├── background_rezultati.png ← Ozadje (stran 3)
    ├── car1.png                ← Avto igralca 1
    ├── car2.png                ← Avto igralca 2
    ├── car3.png                ← Avto igralca 3
    └── dice/
        ├── dice.gif            ← Animacija metanja kocke
        ├── dice-anim.gif       ← Alternativna animacija
        ├── dice1.gif
        ├── dice2.gif
        ├── dice3.gif
        ├── dice4.gif
        ├── dice5.gif
        └── dice6.gif
```

---

## Kako igra deluje

### Stran 1 — Nastavitve
- Vpiši imena 3 igralcev
- Izberi število kock (1–6) in število rund (1–20)
- Klikni **Začni igro**

### Stran 2 — Dirka
- Vsaka runda: klikni gumb **Vrzi rundo X**
- PHP vrže kocke za vsakega igralca in prikaže rezultate
- Avtomobili se premaknejo naprej glede na zbrane točke
- Pod vsako progo se beleži zgodovina rund
- Ko so vse runde končane, se pojavi gumb **Poglej rezultate**

### Stran 3 — Rezultati
- Igralci so razvrščeni na stopničke glede na skupno število točk
- Ob izenačenju se zmagovalec izbere naključno z `rand(1,2)`
- Konfeti animacija v ozadju
- Gumb **Igraj znova** počisti sejo in vrne na začetek

---

## Seja (Session)

Podatki se prenašajo med stranmi z PHP sejami (`$_SESSION`). Seja se ustvari na `igra.php` in uniči ko klikneš **Igraj znova**.

| Spremenljivka | Vsebina |
|---|---|
| `$_SESSION['ime1']` | Ime igralca 1 |
| `$_SESSION['kocke']` | Število kock na rundo |
| `$_SESSION['runde']` | Skupno število rund |
| `$_SESSION['tocke1']` | Skupne točke igralca 1 |
| `$_SESSION['trenutna_runda']` | Katera runda je na vrsti |
| `$_SESSION['zgodovina1']` | Točke in kocke po rundah |

---

## Tehnologije

| Tehnologija | Uporaba |
|---|---|
| PHP | Logika igre, seje, met kock |
| HTML | Struktura strani |
| CSS | Oblikovanje (Hot Wheels stil) |
| JavaScript | SweetAlert2 dialogi, konfeti animacija |

---

## Avtor

Šolski projekt — predmet Spletno programiranje

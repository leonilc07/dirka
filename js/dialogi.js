document.getElementById('gumb-navodila').addEventListener('click', function() {
    Swal.fire({
        title: 'Navodila',
        html: `
            <div style="text-align:left; line-height:1.8">
                <b>Cilj igre:</b> Zberi čim več točk z metanjem kock.<br><br>
                <b>Potek igre:</b><br>
                1. Vsak igralec vpiše svoje ime.<br>
                2. Izberi število kock in rund.<br>
                3. V vsaki rundi vsak igralec vrže kocke — seštevek pade na njegov račun.<br>
                4. Po vseh rundah zmaga tisti z največ točkami.<br><br>
                <b>Izenačenje:</b> Pri enakem številu točk odloči žreb.
            </div>
        `,
        background: '#1e1e1e',
        color: '#f0f0f0',
        confirmButtonText: 'Razumem!',
        confirmButtonColor: '#ff6a00'
    });
});

document.getElementById('gumb-krediti').addEventListener('click', function() {
    Swal.fire({
        title: 'Vizitka',
        html: `
            <div style="line-height:2">
                <b>Dice Race</b><br>
                Šolski projekt<br><br>
                Avtor: <b>Leon</b><br>
                Leto: 2026
            </div>
        `,
        background: '#1e1e1e',
        color: '#f0f0f0',
        confirmButtonText: 'Zapri',
        confirmButtonColor: '#ff6a00'
    });
});

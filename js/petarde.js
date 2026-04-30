var canvas  = document.getElementById('petarde');
var ctx     = canvas.getContext('2d');

canvas.width  = window.innerWidth;
canvas.height = window.innerHeight;

// Barve petard
var barve = ['#ff6a00', '#ffcc00', '#ffffff', '#ff4444', '#44aaff', '#44ee88'];

// Ustvari 80 delcev
var delci = [];

for (var i = 0; i < 80; i++) {
    delci.push({
        x:      Math.random() * canvas.width,
        y:      Math.random() * canvas.height - canvas.height,
        sirina: Math.random() * 10 + 5,
        visina: Math.random() * 6 + 4,
        barva:  barve[Math.floor(Math.random() * barve.length)],
        hitrostY: Math.random() * 3 + 1,
        hitrostX: Math.random() * 2 - 1,
        rotacija: Math.random() * 360,
        hitrostR: Math.random() * 4 - 2
    });
}

// Animacija
function animiraj() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (var i = 0; i < delci.length; i++) {
        var d = delci[i];

        d.y        += d.hitrostY;
        d.x        += d.hitrostX;
        d.rotacija += d.hitrostR;

        // Ko pade ven — resetiraj ga na vrh
        if (d.y > canvas.height) {
            d.y = -20;
            d.x = Math.random() * canvas.width;
        }

        ctx.save();
        ctx.translate(d.x, d.y);
        ctx.rotate(d.rotacija * Math.PI / 180);
        ctx.fillStyle = d.barva;
        ctx.fillRect(-d.sirina / 2, -d.visina / 2, d.sirina, d.visina);
        ctx.restore();
    }

    requestAnimationFrame(animiraj);
}

animiraj();

// Prilagodi canvas ce se okno spremeni
window.addEventListener('resize', function() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
});

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Isister Countdown</title>
  <style>
    body {
        @apply bg-no-repeat bg-cover bg-center; /* Ajusta el estilo del fondo */
         background-image: url("{{ asset('img/dog-run.jpg') }}");
        color: #fff; /* Color del texto */
        font-family: "Courier New", Courier, monospace;
        font-size: 25px;
    }

    h1 {
        @apply text-6xl font-extrabold mb-8; /* Ajusta el tamaño y estilo del h1 */
    }

    #countdown {
        @apply text-4xl mb-12; /* Ajusta el tamaño y el espaciado del countdown */
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center">

<div class="text-center">
  <h1 class="text-6xl font-extrabold mb-8">Isister</h1>
  <p id="countdown" class="text-4xl mb-12"></p>
</div>

<script>
  // Código JavaScript para la cuenta regresiva
  const countdownDate = new Date('May 28, 2024 00:00:00').getTime();

  const x = setInterval(function() {
    const now = new Date().getTime();
    const distance = countdownDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('countdown').innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

    if (distance < 0) {
      clearInterval(x);
      document.getElementById('countdown').innerHTML = '¡Bienvenido!';
    }
  }, 1000);
</script>

</body>
</html>

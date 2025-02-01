<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
    <h1>Iniciar sesión con Google</h1>

    <!-- Botón de Google -->
    <div class="g-signin2" data-onsuccess="onSignIn"></div>


    <script>
        function onSignIn(googleUser) {
            // Obtén el token de ID
            var id_token = googleUser.getAuthResponse().id_token;

            // Enviar el ID Token al servidor para verificar
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'callback.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Si la verificación es exitosa, redirige a la página de inicio
                    window.location.href = 'dashboard.php';
                }
            };
            xhr.send('idtoken=' + id_token); // Enviar el token al backend
        }
    </script>
</body>
</html>

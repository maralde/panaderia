<!DOCTYPE html>
<html lang="es">
<!-- Pestaña principal, se mostrará directamente el login para que solo los empleados puedan acceder -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./images/panIcon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        body {
            background-image: url('./images/background.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .bg-inside {
            background-color: #f8f8f8;
        }

        .bg-btn {
            background-color: #934526;
            color: #fff;
        }

        .bg-btn:hover {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm bg-head" style="width: 400px;">
            <div class="card-header bg-head text-dark text-center">
                <h1 class="mb-2">Iniciar Sesión</h1>
            </div>
            <div class="card-body bg-bodyCard">
                <form action="./php/iniciarSesion.php" method="post">
                    <div class="mb-3">
                        <label for="mail" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control bg-inside"
                            placeholder="Introduce el correo" required />
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" id="pass" name="pass" class="form-control bg-inside"
                            placeholder="Introduce la constraseña" required />
                    </div>
                    <div class="d-grid align-items-center justify-content-center">
                        <button type="submit" class="btn bg-btn">Inicia Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
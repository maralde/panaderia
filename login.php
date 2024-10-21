<!DOCTYPE html>
<html lang="es">
    <!-- Pestaña principal, se mostrará directamente el login para que solo los empleados puedan acceder -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        />
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header text-dark text-center">
                <h1 class="mb-4">Iniciar Sesión</h1>
            </div>
            <div class="card-body">
                <form action="./php/iniciarSesion.php" method="post">
                    <div class="mb-3">
                        <label for="mail" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Introduce el correo" required/>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Introduce la constraseña" required/>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn text-dark">Inicia Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
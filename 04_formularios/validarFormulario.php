<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de formulario</title>
</head>
<body>
    <form action="validacion.php" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido1">Primer apellido:</label>
        <input type="text" id="apellido1" name="apellido1" required><br>

        <label for="apellido2">Segundo apellido:</label>
        <input type="text" id="apellido2" name="apellido2" required><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>


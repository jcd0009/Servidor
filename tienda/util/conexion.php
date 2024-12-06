<!-- Para conectarse con la base de datos -->

<?php
    $_servidor = "127.0.0.1"; //  "localhost"  dirección del servidor donde se encuentra la base de datos
    $_usuario = "estudiante"; // nombre de usuario que se utilizará para conectarse a la base de datos
    $_contrasena = "estudiante"; // contraseña correspondiente al usuario
    $_base_de_datos = "TIENDA_BD"; // nombre de la base de datos a la que se desea conectar

    //  Mysqli ó PDO

    /**
     * se está creando un nuevo objeto de la clase mysqli (que es una extensión de PHP para interactuar con bases de datos MySQL).
     *  Esta línea intenta conectar con la base de datos usando las variables definidas anteriormente para el servidor, usuario, contraseña y base de datos.
     */
    $_conexion = new Mysqli($_servidor,$_usuario,$_contrasena,$_base_de_datos)
        or die("Error de conexión");

    /**
     * Si la conexión falla por algún motivo (como una credencial incorrecta o si el servidor no está disponible), 
     * PHP detendrá la ejecución del script y mostrará el mensaje "Error de conexión". Esto es útil para la depuración o para asegurarse de
     *  que el script no continúe ejecutándose si no puede acceder a la base de datos.
     */
?>
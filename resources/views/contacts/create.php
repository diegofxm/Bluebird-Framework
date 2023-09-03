<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <h1>Crear contacto</h1>

    <a href="/contacts">Volver</a>

    <form action="/contacts" method="POST">

        <div>
        <br>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name">
        </div>
        <br>
        <div>
            <label for="email">Correo electrónico</label>
            <input type="text" name="email" id="email">
        </div>
        <br>
        <div>
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" id="phone">
        </div>
        <br>
        <button type="submit">Crear</button>

    </form>

</body>

</html>
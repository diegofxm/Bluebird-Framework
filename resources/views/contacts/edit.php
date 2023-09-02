<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar contacto</title>
</head>

<body>

    <h1>Actualizar contacto</h1>

    <form action="/contacts/<?= $contact['id'] ?>" method="POST">

        <div>
            <label for="name">Nombre</label>
            <input value="<?= $contact['name'] ?>" type="text" name="name" id="name">
        </div>
        <br>
        <div>
            <label for="email">Correo electrónico</label>
            <input value="<?= $contact['email'] ?>" type="text" name="email" id="email">
        </div>
        <br>
        <div>
            <label for="phone">Teléfono</label>
            <input value="<?= $contact['phone'] ?>" type="text" name="phone" id="phone">
        </div>
        <br>
        <button type="submit">Actualizar</button>

    </form>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1>Detalle del contacto</h1>

    <a href="/contacts">Volver |</a>
    <a href="/contacts/<?= $contact['id'] ?>/edit">Editar |</a>

    <p>Nombre: <?= $contact['name'] ?></p>
    <p>Email: <?= $contact['email'] ?></p>
    <p>Teléfono: <?= $contact['phone'] ?></p>

    <form action="/contacts/<?= $contact['id'] ?>/delete" method="POST">
        <button>
            Eliminar
        </button>
    </form>

</body>

</html>
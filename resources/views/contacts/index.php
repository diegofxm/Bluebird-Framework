<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Contactos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1 class="text-2xl font-bold mb-2">Listado de Contactos</h1>

    <a href="/contacts/create">Crear contacto</a>

    <ul class="list-disc list-inside">
        <?php foreach ($contacts['data'] as $contact) : ?>

            <li>
                <a href="/contacts/<?= $contact['id'] ?>">
                    <?= $contact['name'] ?> | <?= $contact['email'] ?> | <?= $contact['phone'] ?>
                </a>
            </li>

        <?php endforeach ?>
    </ul>



<?php

$paginate = 'contacts';
include_once '../resources/views/assets/pagination.php'

?>

</body>

</html>
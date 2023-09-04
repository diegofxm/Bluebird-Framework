<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Contactos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-2">Listado de Contactos</h1>


        <form action="/contacts">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <input type="search" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar contacto" required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
            </div>
        </form>


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

    </div>

</body>

</html>
<!DOCTYPE html>
<html data-theme="dark" lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Sphere dev</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>Mes projet</a></li>
                <li><a>Crée un projet</a></li>
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <ul
                        tabindex="-1"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                        <li><a>Profile</a></li>
                        <li><a>Project</a></li>
                        <li><a>Settings</a></li>
                    </ul>
                </div>
            </ul>
        </div>


    </div>
    <main class="min-h-screen">
        <?= $content ?>
    </main>

    <footer class="shadow-sm bottom-0 bg-base-100 footer d-flex justify-center p-4">
        <p class="text-center">&copy; 2026 - Nathan Pache & Joao Perrera vaz - All right reserved</p>
    </footer>
</body>

</html>
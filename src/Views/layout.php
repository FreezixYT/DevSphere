<?php

use DevSphere\Models\User;

/** @var string $title */
/** @var string $content */
/** @var User|null $user */
$user = $_SESSION["user"] ?? null;
$connected = $user !== null;
$requests = $user == null ? [] : $user->getRoleRequests();
?>
<!DOCTYPE html>
<html data-theme="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .icon-stack {
            position: relative;
            display: inline-block;
            width: 2rem;
            height: 2rem;
        }

        .icon-stack i {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-bg {
            font-size: 2rem;
            opacity: 0.8;
        }

        .icon-fg {
            font-size: 1.2rem;
        }
    </style>
</head>

<body class="h-screen drawer drawer-end">
    <input id="message-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col h-full">
        <nav class="navbar bg-primary shadow-sm">
            <div class="navbar-start">
                <? if ($connected): ?>
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="avatar avatar-placeholder p-2">
                                <div class="bg-neutral text-neutral-content w-8 rounded-full p-auto">
                                    <span><?= strtoupper($user->username[0]) ?></span>
                                </div>
                            </div>
                        </div>
                        <ul
                            tabindex="-1"
                            class="menu menu-sm dropdown-content bg-neutral rounded-box z-1 mt-3 w-52 p-2 shadow">
                            <li><a href="/user/<?= $user->id ?>">Profile</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                <? endif ?>
            </div>
            <div class="navbar-center">
                <a class="btn btn-ghost text-xl" href="/">
                    <div class="icon-stack">
                        <i class="bi bi-circle icon-bg"></i>
                        <i class="bi bi-code-slash icon-fg"></i>
                    </div>
                    DevSphere
                </a>
            </div>
            <div class="navbar-end">
                <? if ($connected): ?>
                    <label for="message-drawer" class="btn btn-ghost btn-circle btn-drawer">
                        <div class="indicator">
                            <span class="badge badge-xs badge-secondary indicator-item">1</span>
                            <i class="bi bi-envelope text-xl"></i>
                        </div>
                    </label>
                <? else: ?>
                    <a href="/login">Login</a>
                <? endif ?>
            </div>
        </nav>
        <main class="flex-1">
            <?= $content ?>
        </main>

        <footer class="shadow-sm bottom-0 bg-base-100 footer d-flex justify-center p-4">
            <p class="text-center">&copy; 2026 - Nathan Pache & Joao Pereira Vaz - All right reserved</p>
        </footer>
    </div>
    <div class="drawer-side">
        <label for="message-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <? foreach ($requests as $request): ?>
                <form method="post" action="/request/<?= $request->userId ?>/<?= $request->roleId ?>" class="p-2 border-b-2 border-base">
                    <h1 class="text-lg font-semibold"><?= $request->role->name ?></h1>
                    <div class="chat chat-start">
                        <div class="chat-image avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-8 rounded-full p-auto">
                                <span><?= strtoupper($request->user->username[0]) ?></span>
                            </div>
                        </div>
                        <div class="chat-bubble">
                            <p><?= $request->message ?></p>
                            <p>By: <?= $request->user->email ?></p>
                        </div>
                    </div>
                    <div class="w-full flex">
                        <button class="btn btn-success ml-auto" type="submit" name="choice" value="Accepted">Accept</button>
                        <button class="btn btn-error ml-2" type="submit" name="choice" value="Declined">Decline</button>
                    </div>
                </form>
            <? endforeach ?>
        </ul>
    </div>
</body>

</html>
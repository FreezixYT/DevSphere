<div class="flex justify-center mt-30 items-center">
    <div>

        <div class="mt-5" id="showInfo">
            <h1 class="mb-5 text-5xl">My profil</h1>

            <p>Nom : <?= $user->lastname ?></p>
            <p>Prénom : <?= $user->name ?></p>
            <p>Pseudo : <?= $user->username ?></p>
            <p>Email : <?= $user->email ?></p>
            <? if($user->id === $_SESSION['user']->id): ?>
                <a href="/editProfil" class="mt-5 btn btn-success">Modifier</a>
                <a href="/logout" class="mt-5 btn btn-error">Déconnection</a>
            <? endif ?>
        </div>
    </div>
</div>
<?php
use DevSphere\Models\Project;
use DevSphere\Models\User;

/** @var User $user */
/** @var Project[] $projects */
/** @var array $errors */

function disableInput(User $user): string {
    return $_SESSION["user"]->id == $user->id ? "" : "disabled";
}
?>
<div class="min-h-screen flex flex-col items-center justify-center">
    <div class="card w-fit shadow-2xl bg-base-100">
        <div class="card-body flex-row">
            <form method="post">
                <h2 class="card-title justify-center text-2xl">Profile</h2>
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Firstname</span>
                    </label>
                    <input type="text" name="firstname" class="w-full input input-bordered" required <?= disableInput($user) ?> value="<?= $user->name ?>" />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Lastname</span>
                    </label>
                    <input type="text" name="lastname" class="w-full input input-bordered" required <?= disableInput($user) ?> value="<?= $user->lastname ?>" />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="pseudo" class="w-full input input-bordered" required <?= disableInput($user) ?> value="<?= $user->username ?>" />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="w-full input input-bordered" required <?= disableInput($user) ?> value="<?= $user->email ?>" />
                </div>

                <div id="errorZone">
                    <? foreach ($errors as $error): ?>
                    <div role="alert" class="alert alert-error">
                        <span><?= $error ?></span>
                    </div>
                    <? endforeach ?>
                </div>

                <div class="form-control w-full flex justify-end mb-4">
                    <? if ($user->id === $_SESSION["user"]->id): ?>
                        <input type="submit" class="btn btn-success w-full" value="Update">
                    <? endif ?>
                </div>
            </form>
            <ul class="list bg-base-100 rounded-box ">
                <h2 class="card-title justify-center text-2xl">Projects</h2>
                <?php if (count($projects) <= 0) : ?>
                    <p>You have no projects at the moment.</p>
               <?php endif ?>
                <? foreach($projects as $project): ?>
                    <a href="/project/<?= $project->id ?>" class="list-row hover:bg-base-200">
                        <div><?= $project->name ?></div>
                        <div>
                            <div class="flex gap-2">
                                <? foreach ($project->tags as $i => $tag) :?>
                                    <div class="badge badge-sm badge-<?= $i % 3 == 0 ? "accent" : ($i % 2 == 0 ? "secondary" : "primary")  ?>">
                                        <?= $tag->name ?>
                                    </div>
                                <? endforeach ?>
                            </div>
                            <div class="text-xs uppercase font-semibold opacity-60"><?= $project->description ?></div>
                        </div>
                    </a>
                <? endforeach ?>
            </ul>
        </div>
    </div>
</div>
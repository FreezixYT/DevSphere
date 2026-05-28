<?php

use DevSphere\Models\Project;
use DevSphere\Models\Tag;
use DevSphere\Models\User;
/** @var Tag[] $tags */
/** @var string[] $errors */
/** @var Project $project */
$owner = $project->owner;

/** @var User|null $user */
$user = $_SESSION["user"] ?? null;

$connected = $user !== null;

?>
<div class="flex flex-col w-8/10 m-auto h-full">
    <h1 class="p-5 border-b-2 text-center"><?= $project->name ?></h1>
    <div id="owner-info" class="p-5 border-b-2 flex items-center justify-between">
        <h2>Owner</h2>
        <div class="bg-primary flex items-center rounded">
            <div class="avatar avatar-placeholder p-2">
                <div class="bg-neutral text-neutral-content w-8 rounded-full p-auto">
                    <span><?= strtoupper($owner->username[0]) ?></span>
                </div>
            </div>
            <span class="p-2">
                <?= $owner->username ?>
            </span>
        </div>
    </div>
    <? if($user != null && $user->id == $project->userId): ?>
        <button id="btnCreateRole" class="btn btn-primary m-10 " onclick="my_modal_1.showModal()">Create role</button>
    <? endif ?>
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box card w-full max-w-sm bg-base-100">
            <div class="card-body flex-row">
                <form method="post" action="/project/<?= $project->id ?>/role">
                    <h2 class="card-title justify-center text-2xl">New role</h2>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" name="name" class="w-full input input-bordered" required/>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea name="description" class="w-full input input-bordered resize-none break-words whitespace-pre-wrap h-20" required></textarea>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Tags</span>
                        </label>
                        <select name="tags[]" multiple class="w-full select select-md">
                            <? foreach ($tags as $tag): ?>
                                <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                            <? endforeach ?>
                        </select>
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
                            <input type="submit" class="btn btn-success w-full" value="Create">
                        <? endif ?>
                    </div>
                </form>
            </div>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
    <div id="roles" class="p-5 border-b-2 flex flex-wrap w-full justify-center flex-1 overflow-y-scroll">
        <? foreach ($project->roles as $role) : ?>
            <div class="m-2 collapse collapse-arrow bg-base-100 border border-base-300 h-fit w-150 max-w-full">
                <input type="radio" name="role" />
                <div class="collapse-title font-semibold">
                    <div class="flex justify-between items-center">
                        <? $users = $role->users ?>
                        <span><?= $role->name ?> ( x<?= count($users) ?> )</span>
                    </div>
                    <ul>
                        <? foreach ($role->tags as $i => $tag): ?>
                            <li class="badge badge-soft badge-<?= $i % 3 == 0 ? "accent" : ($i % 2 == 0 ? "secondary" : "primary") ?>">
                                <?= $tag->name ?>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
                <div class="collapse-content text-sm">
                    <? if ($connected && $user->id != $_SESSION["user"]->id): ?>
                        <? if (!$user->hasRequestedRole($role->id)): ?>
                            <form method="post" action="/role/<?= $role->id ?>/request" class="mb-4">
                                <textarea class="textarea textarea-primary w-full h-30" name="message" placeholder="Message..."></textarea>
                                <button type="submit" class="btn btn-primary w-full mt-4">
                                    Request
                                </button>
                            </form>
                        <? endif ?>
                    <? endif ?>
                    <ul>
                        <? foreach ($users as $user): ?>
                            <li class="bg-secondary flex items-center rounded mb-2">
                                <div class="avatar avatar-placeholder p-2">
                                    <div class="bg-neutral text-neutral-content w-8 rounded-full p-auto">
                                        <span><?= strtoupper($user->username[0]) ?></span>
                                    </div>
                                </div>
                                <span class="p-2"><?= $user->username ?></span>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            </div>
        <? endforeach ?>
        <div class="w-150 max-w-full m-2"></div>
    </div>
</div>
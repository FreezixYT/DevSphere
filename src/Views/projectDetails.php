
<?php  
use DevSphere\Models\Project;
/** @var Project $project */ 
$owner = $project->owner;
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
    <div id="roles" class="p-5 border-b-2 flex flex-wrap w-full justify-center flex-1 overflow-y-scroll">
        <? foreach ($project->roles as $role) :?>
            <div class="m-2 collapse collapse-arrow bg-base-100 border border-base-300 h-fit w-150 max-w-full">
                <input type="radio" name="role"/>
                <div class="collapse-title font-semibold">
                    <div class="flex justify-between items-center">
                        <? $users = $role->users ?>
                        <span><?= $role->name ?> ( x<?= count($users) ?> )</span>
                        <button class="btn btn-primary z-1" onclick="showRoleRequestModal(<?= $role->id ?>)">Request</button>
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
    <dialog id="role-request-modal" class="modal modal-bottom sm:modal-middle" open>
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Send the request for the role of Software Dev</h3>
            <form onsubmit="sendRequest">
                <textarea class="textarea textarea-primary w-full h-30" name="message"></textarea>
                <button type="submit" class="btn btn-primary w-full mt-4">
                    Submit
                </button>
            </form>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost btn-error absolute right-2 top-2">
                    <i class="bi bi-x-lg"></i>
                </button>
            </form>
        </div>
    </dialog>
</div>

<script>
    /** @type {HTMLDialogElement} */
    const roleRequestModal = document.querySelector("#role-request-modal");
    const token = localStorage.getItem("token");

    async function showRoleRequestModal(id) {
        roleRequestModal.showModal();
        const result = await fetch(`/api/role/request/${id}`, {
            headers: {
                authorize: `Bearer ${token}`
            },
            method: "POST"
        });
        console.log(await result.text());
    }

    /** @param {SubmitEvent} e */
    async function sendRequest(e) {
        e.preventDefault();
    }
</script>
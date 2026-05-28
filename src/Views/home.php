<?php

use DevSphere\Models\Project;

/** @var Project[] $projects */

?>
<div class="flex justify-center mt-30 items-center">
    <div>
        <h1 class="text-5xl">Projects</h1>
        <form class="mt-5 mb-5 flex flex-1" action="">
            <div class="join w-full">
                <div class="w-full">
                    <label class="input validator join-item w-full">
                        <i class="bi bi-search"></i>
                        <input name="q" type="text" placeholder="Search a project" />
                    </label>
                </div>

                <!-- change popover-1 and --anchor-1 names. Use unique names for each dropdown -->
                <button type="button" class="btn" popovertarget="popover-1" style="anchor-name:--anchor-1">
                    <i class="bi bi-funnel"></i>
                </button>
                <ul class="dropdown menu w-52 rounded-box bg-base-100 shadow-sm"
                    popover id="popover-1" style="position-anchor:--anchor-1">
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
                </ul>
                <button type="submit" class="btn btn-neutral join-item">Search</button>
            </div>
            <? if (isset($_SESSION["user"])): ?>
                <a href="/project/create" class="btn btn-success ml-5">Create Project</a>
            <? endif ?>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">
            <? foreach ($projects as $project): ?>
                <a href="/project/<?= $project->id ?>" class="card card-border card-xs shadow-sm w-full max-w-sm">
                    <div class="card-body">
                        <h2 class="card-title"><?= $project->name ?></h2>
                        <p><?= $project->description ?></p>
                        <div class="w-full">
                            <? foreach ($project->tags as $i => $tag) : ?>
                                <div class="m-1 badge badge-<?= $i % 3 == 0 ? "accent" : ($i % 2 == 0 ? "secondary" : "primary")  ?>">
                                    <?= $tag->name ?>
                                </div>
                            <? endforeach ?>
                        </div>
                    </div>
                </a>
            <? endforeach ?>
        </div>
    </div>
</div>
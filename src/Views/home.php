<?php
use DevSphere\Models\Project;
/** @var Project[] $projects */
?>
<div class="flex justify-center mt-30 items-center">
    <div>
        <h1 class="text-5xl">Sphere Dev</h1>
        <form class="mt-5 mb-5 flex" action="">
            <div class="join">
                <div>
                    <label class="input validator join-item">
                        <i class="bi bi-search"></i>
                        <input type="email" placeholder="Search a project" required />
                    </label>
                </div>
                <button class="btn btn-neutral join-item">Search</button>
            </div>
            <a href="/project/create" class="btn btn-success">Create Project</a>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">
            <? foreach($projects as $project): ?>
                <a href="/project/<?= $project->id ?>" class="card card-border card-xs shadow-sm w-full max-w-sm">
                    <div class="card-body">
                        <h2 class="card-title"><?= $project->name ?></h2>
                        <p><?= $project->description ?></p>
                        <div class="flex gap-2">
                            <? foreach ($project->tags as $i => $tag) :?>
                                <div class="badge badge-<?= $i % 3 == 0 ? "accent" : ($i % 2 == 0 ? "secondary" : "primary")  ?>">
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
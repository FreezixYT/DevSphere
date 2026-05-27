<?php 

use DevSphere\Models\Tag;
/** @var string[] $errors */
/** @var Tag[] $tags */
?>

<div class="min-h-screen bg-base-200 flex items-center justify-center">
    <div class="card w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
            <h2 class="card-title justify-center text-2xl">Create Project</h2>
            <form method="post">
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" class="w-full input input-bordered" required />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea name="description" class="w-full input input-bordered resize-none break-words whitespace-pre-wrap h-32" required></textarea>
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
                    
                <div class="form-control w-full flex justify-end mb-4">
                    <button type="submit" class="btn btn-primary w-full">Create</button>
                </div>
            </form>

            <div id="errorZone">
                <? foreach ($errors as $error): ?>
                <div role="alert" class="alert alert-error">
                    <span><?= $error ?></span>
                </div>
                <? endforeach ?>
            </div>
        </div>
    </div>
</div>
<?php 
/** @var string[] $errors */
?>
<div class="min-h-screen bg-base-200 flex items-center justify-center">
  <div class="card w-full max-w-sm shadow-2xl bg-base-100">
    <div class="card-body">
      <h2 class="card-title justify-center text-2xl">Login</h2>

      <form method="post">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="email" name="email" placeholder="email@example.com" class="input input-bordered" required />
        </div>

        <div class="form-control mt-4">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input type="password" name="password" placeholder="••••••••" class="input input-bordered" required />
        </div>

        <div class="form-control flex justify-end m-4">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <div id="errorZone">
        <? foreach ($errors as $error): ?>
          <div role="alert" class="alert alert-error">
            <span><?= $error ?></span>
          </div>
        <? endforeach ?>
      </div>
      <p class="text-center text-sm mt-4">
        No account ? -
        <a href="/register" class="link link-primary">Create a account</a>
      </p>
    </div>
  </div>
</div>
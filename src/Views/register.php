<?php 
/** @var string[] $errors */
?>

<div class="min-h-screen bg-base-200 flex items-center justify-center">
  <div class="card w-full max-w-sm shadow-2xl bg-base-100">
    <div class="card-body">
      <h2 class="card-title justify-center text-2xl">Register</h2>

      <form method="post" action="/register">
        <div class="form-control m-4">
          <label class="label">
            <span class="label-text">Firstname</span>
          </label>
          <input type="text" name="firstname" placeholder="John" class="input input-bordered" required />
        </div>

        <div class="form-control m-4">
          <label class="label">
            <span class="label-text">Lastname</span>
          </label>
          <input type="text" name="lastname" placeholder="Doe" class="input input-bordered" required />
        </div>

        <div class="form-control m-4">
          <label class="label">
            <span class="label-text">Pseudo</span>
          </label>
          <input type="text" name="pseudo" placeholder="Jojo" class="input input-bordered" required />
        </div>

        <div class="form-control m-4">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="email" name="email" placeholder="email@example.com" class="input input-bordered" required />
        </div>

        <div class="form-control m-4">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input type="password" name="password" placeholder="••••••••" class="input input-bordered" required />
        </div>

        <div class="form-control flex justify-end m-4">
          <button type="submit" class="btn btn-primary">Register</button>
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
        Already have an account ? -
        <a href="/login" class="link link-primary">Login</a>
      </p>
    </div>
  </div>
</div>
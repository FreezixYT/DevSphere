<? $user = $_SESSION["user"] ?>
<div class="flex justify-center mt-30 items-center">
    <div>
        <div id="formEdit" action=""     method="post">
            <h1 class="m-4 text-5xl">Edit profil</h1>
            <form method="post" action="/editProfil">
                <div class="form-control m-4">
                    <label class="label">
                        <span class="label-text">Firstname</span>
                    </label>
                    <input value="<?= $user->lastname ?>" type="text" name="firstname" placeholder="John" class="input input-bordered" required />
                </div>

                <div class="form-control m-4">
                    <label class="label">
                        <span class="label-text">Lastname</span>
                    </label>
                    <input value="<?= $user->name ?>" type="text" name="lastname" placeholder="Doe" class="input input-bordered" required />
                </div>

                <div class="form-control m-4">
                    <label class="label">
                        <span class="label-text">Pseudo</span>
                    </label>
                    <input value="<?= $user->username ?>" type="text" name="pseudo" placeholder="Jojo" class="input input-bordered" required />
                </div>

                <div class="form-control m-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input value="<?= $user->email ?>" type="email" name="email" placeholder="email@example.com" class="input input-bordered" required />
                </div>

                <input type="submit" class="btn btn-success m-4">
            </form>
    </div>
</div>
<div class="min-h-screen bg-base-200 flex items-center justify-center">
  <div class="card w-full max-w-sm shadow-2xl bg-base-100">
    <div class="card-body">
      <h2 class="card-title justify-center text-2xl">Register</h2>

      <form id="form">
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

      <div id="errorZone"></div>

      <p class="text-center text-sm mt-4">
        Already have an account ? -
        <a href="/login" class="link link-primary">Login</a>
      </p>
    </div>
  </div>
</div>

<script>
  const form = document.getElementById("form");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const data = {};
    const errorZone = document.getElementById("errorZone");

    for (const [key, value] of formData.entries()) {
      data[key] = value;
    }

    errorZone.innerHTML = "";

    try {
      const response = await fetch("/api/user/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      });

      const body = await response.json();

      if (body.mailError) {
        errorZone.innerHTML = `
          <div role="alert" class="alert alert-error">
            <span>${body.mailError}</span>
          </div>
        `;
      }

      if (body.jwt) {
        errorZone.innerHTML = `
          <div role="alert" class="alert alert-success">
            <span>Création de compte réussie !</span>
          </div>
        `;

        localStorage.setItem("token", body.jwt);

        setTimeout(() => {
          window.location.href = "/";
        }, 1000);
      }

      if (body.errors && Array.isArray(body.errors)) {
        body.errors.forEach(err => {
          const wrapper = document.createElement("div");
          wrapper.innerHTML = `
            <div role="alert" class="alert alert-warning">
              <span>${err}</span>
            </div>
          `;
          errorZone.appendChild(wrapper.firstElementChild);
        });
      }

    } catch (error) {
      errorZone.innerHTML = `
        <div role="alert" class="alert alert-error">
          <span>Erreur serveur</span>
        </div>
      `;
      console.error(error);
    }
  });
</script>
    <div class="min-h-screen bg-base-200 flex items-center justify-center">
      <div class="card w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
          <h2 class="card-title justify-center text-2xl">Login</h2>

          <form id="form">
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
          <div id="errorZone"></div>
          <p class="text-center text-sm mt-4">
            No account ? -
            <a href="/register" class="link link-primary">Create a account</a>
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
    const response = await fetch("/api/user/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(data)
    });

    const body = await response.json();
    console.log(body);

    if (body.jwt) {
      errorZone.innerHTML = `
        <div role="alert" class="alert alert-success">
          <span>Connexion réussie !</span>
        </div>
      `;

      localStorage.setItem("token", body.jwt);

      setTimeout(() => {
        window.location.href = "/";
      }, 1000);

      return;
    }

    if (body.error) {
      errorZone.innerHTML = `
        <div role="alert" class="alert alert-error">
          <span>${body.error}</span>
        </div>
      `;
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
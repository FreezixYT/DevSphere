    <div class="min-h-screen bg-base-200 flex items-center justify-center">
      <div class="card w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
          <h2 class="card-title justify-center text-2xl">Register</h2>

          <form id="form" method="post">
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
              <input type="text" name="pesudo" placeholder="Jojo" class="input input-bordered" required />
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
              <button id="button" class="btn btn-primary">Register</button>
            </div>
          </form>
          <p class="text-center text-sm mt-4">
            Already have an account ? -
            <a href="/login" class="link link-primary">Login</a>
          </p>
          <p id="errorZone"></p>
        </div>
      </div>
    </div>
    <script>
      const form = document.getElementById("form");


      form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const data = {};
        const errorZone = document.getElementById("error-zone");

        for (const [key, value] of formData) {
          data[key] = value;
        }

        const response = await fetch("/api/user/register", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        });

        const body = await response.json();

        console.log(body);

        errorZone.innerHTML = ""; 

        errors.forEach(err => {
          const wrapper = document.createElement("div");
          wrapper.innerHTML = `
            <div role="alert" class="alert alert-warning">
              <span>${err}</span>
            </div>
          `;
          errorZone.appendChild(wrapper.firstElementChild);
        });
      });
    </script>
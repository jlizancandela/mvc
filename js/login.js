const form = document.querySelector("form");
const eye = document.querySelector(".eye");
const errormail = document.querySelector("#errormail");

const emailHandler = () => {
  var regex = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  const result = regex.test(form.email.value) ? true : false;

  if (!result) {
    errormail.innerHTML = "Error en email";
    form.email.classList.add("input-error");
  } else {
    errormail.innerHTML = "";
    form.email.classList.remove("input-error");
    form.email.classList.add("input-success");
  }
};

form.email.addEventListener("keyup", emailHandler);
form.email.addEventListener("change", emailHandler);

eye.addEventListener("click", () => {
  if (form.password.type == "password") {
    form.password.type = "text";
    eye.classList.remove("bi-eye-slash");
    eye.classList.add("bi-eye");
  } else {
    form.password.type = "password";
    eye.classList.remove("bi-eye");
    eye.classList.add("bi-eye-slash");
  }
});

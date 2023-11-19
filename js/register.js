// Me traigo los elementos del formulario

const form = document.querySelector("#form_register");
const errormail = document.querySelector("#errormail");
const eyebtn = document.querySelector(".eye");

console.log(eyebtn);
// ----------------------------------------------------------
// funcion para sacar la provincia a traves del codigo postal.
// ----------------------------------------------------------

function darProvincia(cpostal) {
  var cp_provincias = {
    1: "\u00C1lava",
    2: "Albacete",
    3: "Alicante",
    4: "Almer\u00EDa",
    5: "\u00C1vila",
    6: "Badajoz",
    7: "Baleares",
    8: "Barcelona",
    9: "Burgos",
    10: "C\u00E1ceres",
    11: "C\u00E1diz",
    12: "Castell\u00F3n",
    13: "Ciudad Real",
    14: "C\u00F3rdoba",
    15: "Coruña",
    16: "Cuenca",
    17: "Gerona",
    18: "Granada",
    19: "Guadalajara",
    20: "Guip\u00FAzcoa",
    21: "Huelva",
    22: "Huesca",
    23: "Ja\u00E9n",
    24: "Le\u00F3n",
    25: "L\u00E9rida",
    26: "La Rioja",
    27: "Lugo",
    28: "Madrid",
    29: "M\u00E1laga",
    30: "Murcia",
    31: "Navarra",
    32: "Orense",
    33: "Asturias",
    34: "Palencia",
    35: "Las Palmas",
    36: "Pontevedra",
    37: "Salamanca",
    38: "Santa Cruz de Tenerife",
    39: "Cantabria",
    40: "Segovia",
    41: "Sevilla",
    42: "Soria",
    43: "Tarragona",
    44: "Teruel",
    45: "Toledo",
    46: "Valencia",
    47: "Valladolid",
    48: "Vizcaya",
    49: "Zamora",
    50: "Zaragoza",
    51: "Ceuta",
    52: "Melilla",
  };
  if (cpostal.length == 5 && cpostal <= 52999 && cpostal >= 1000)
    return cp_provincias[parseInt(cpostal.substring(0, 2))];
  else return "---";
}

function validar_email(email) {
  var regex = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email) ? true : false;
}

form.postalCode.onkeyup = function () {
  form.province.value = darProvincia(form.postalCode.value);
};

const emailHandler = () => {
  const result = validar_email(form.email.value);

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

eyebtn.addEventListener("click", () => {
  if (form.password.type == "password") {
    form.password.type = "text";
    eyebtn.classList.remove("bi-eye-slash");
    eyebtn.classList.add("bi-eye");
  } else {
    form.password.type = "password";
    eyebtn.classList.remove("bi-eye");
    eyebtn.classList.add("bi-eye-slash");
  }
});

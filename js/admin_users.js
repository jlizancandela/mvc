//-----------------------------------------------------------------------
// OTRAS FUNCIONES
//-----------------------------------------------------------------------

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

//------------------------------------------------------------------------
// CREAR DIRECCIONES
//------------------------------------------------------------------------

const formCreateDirs = document.querySelector("#form-create-dirs");

const modalBtnCreateDirs = document.querySelectorAll(".modalbtn-create-dirs");

const clickHandlerCD = (e) => {
  console.log(e.target);
  const codigo = e.target.getAttribute("data-id");

  formCreateDirs.Codigo.value = codigo;
};

modalBtnCreateDirs.forEach((item) => {
  item.addEventListener("click", clickHandlerCD);
});

console.log(formCreateDirs);

formCreateDirs.Cp.onkeyup = function () {
  formCreateDirs.Provincia.value = darProvincia(formCreateDirs.Cp.value);
};

//------------------------------------------------------------------------
// MODIFICAR DIRECCIONES
//------------------------------------------------------------------------

const modalbtn = document.querySelectorAll(".modalbtn_update_dirs");
const form = document.querySelector("#form_update_dirs");

const clickHandler = (e) => {
  const codigo = e.target.getAttribute("data-codigo");
  const direccion = e.target.getAttribute("data-direccion");
  const cp = e.target.getAttribute("data-cp");
  const provincia = e.target.getAttribute("data-provincia");

  form.Codigo.value = codigo;
  form.Direccion.value = direccion;
  form.Cp.value = cp;
  form.Provincia.value = provincia;
};

modalbtn.forEach((item) => {
  item.addEventListener("click", clickHandler);
});

//------------------------------------------------------------------------
// MODIFICAR USUARIOS
//------------------------------------------------------------------------

const modalbtn_users = document.querySelectorAll(".modalbtn_update_users");
const form_users = document.querySelector("#form_update_users");

const clickhandler = (e) => {
  const codigo_users = e.target.getAttribute("data-codigo");
  const nombre_users = e.target.getAttribute("data-nombre");
  const telefono_users = e.target.getAttribute("data-telefono");
  const email_users = e.target.getAttribute("data-email");
  const rol_users = e.target.getAttribute("data-rol");

  form_users.Id.value = codigo_users;
  form_users.Nombre.value = nombre_users;
  form_users.Telefono.value = telefono_users;
  form_users.Email.value = email_users;
  form_users.Rol.value = rol_users;
};

modalbtn_users.forEach((btn) => {
  btn.addEventListener("click", clickhandler);
});

//------------------------------------------------------------------------
// ELIMINAR DIRECCIONES
//------------------------------------------------------------------------

const aceptar = document.querySelector(".btn-erase-dirs");
const btnDeleteModal = document.querySelectorAll(".modalbtn_delete_dirs");
const cancelar = document.querySelector(".cancel-erase-dirs");
const modalInput = document.querySelector("input#delete-dirs");

let id, padre;

btnDeleteModal.forEach((item) => {
  item.addEventListener("click", (e) => {
    id = e.target.getAttribute("data-codigo");
    padre = e.target.getAttribute("data-padre");
  });
});

aceptar.addEventListener("click", () => {
  window.location.href = `${padre}admin/directions/delete/${id}`;
});

cancelar.addEventListener("click", function () {
  modalInput.checked = false; // Desmarca el checkbox para ocultar el modal
});

//------------------------------------------------------------------------
// ELIMINAR USUARIOS
//------------------------------------------------------------------------

const aceptarDeleteUsers = document.querySelector(".btn-erase-users");
const cancelarDeleteUsers = document.querySelector(".cancel-erase-users");
const ModalDeleteUsers = document.querySelector("input#delete_users");

const btnDeleteUsers = document.querySelectorAll(".modalbtn-delete-users");

let userId, userPadre;

btnDeleteUsers.forEach((item) => {
  item.addEventListener("click", (e) => {
    console.log(e.target);
    userId = e.target.getAttribute("data-codigo");
    userPadre = e.target.getAttribute("data-padre");
  });
});

aceptarDeleteUsers.addEventListener("click", () => {
  window.location.href = `${userPadre}admin/users/delete/${userId}`;
});

cancelarDeleteUsers.addEventListener("click", () => {
  ModalDeleteUsers.checked = false;
});

//------------------------------------------------------------------------
// CREAR USUARIOS
//------------------------------------------------------------------------

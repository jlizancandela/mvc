// ----------------------------------------------------------------
// FORMULARIO DE INSERCCION DE ARTICULOS
// ----------------------------------------------------------------

const formularioCrearArticulos = document.querySelector(
  ".form-create-articles",
);

const nOferta = document.querySelectorAll(".nOferta");
formularioCrearArticulos.categoria.addEventListener("change", () => {
  if (formularioCrearArticulos.categoria.value === "nueva") {
    formularioCrearArticulos.nuevaCategoria.classList.remove("hidden");
    formularioCrearArticulos.descripcionCategoria.classList.remove("hidden");
  } else {
    formularioCrearArticulos.nuevaCategoria.classList.add("hidden");
    formularioCrearArticulos.descripcionCategoria.classList.add("hidden");
  }
});

formularioCrearArticulos.oferta.addEventListener("change", () => {
  if (formularioCrearArticulos.oferta.value === "nueva") {
    nOferta.forEach((item) => {
      item.classList.remove("hidden");
    });
  } else {
    nOferta.forEach((item) => {
      item.classList.add("hidden");
    });
  }
});

// ----------------------------------------------------------------
// FORMULARIO DE ACTUALIZAR ARTICULOS
// ----------------------------------------------------------------

const formUpdateArticles = document.querySelector(".formUpdateArticles");

const nOfertaUpdate = document.querySelectorAll(".nOfertaUpdate");

const updatebtn = document.querySelectorAll(".updatebtn");

formUpdateArticles.categoria.addEventListener("change", () => {
  if (formUpdateArticles.categoria.value === "nueva") {
    formUpdateArticles.nuevaCategoria.classList.remove("hidden");
    formUpdateArticles.descripcionCategoria.classList.remove("hidden");
  } else {
    formUpdateArticles.nuevaCategoria.classList.add("hidden");
    formUpdateArticles.descripcionCategoria.classList.add("hidden");
  }
});

formUpdateArticles.oferta.addEventListener("change", () => {
  if (formUpdateArticles.oferta.value === "nueva") {
    nOfertaUpdate.forEach((item) => {
      item.classList.remove("hidden");
    });
  } else {
    nOfertaUpdate.forEach((item) => {
      item.classList.add("hidden");
    });
  }
});

updatebtn.forEach((item) => {
  item.addEventListener("click", () => {
    const form = formUpdateArticles;
    [id, nombre, categoria, publico, descripcion, precio, oferta] =
      Object.values(item.dataset);
    form.nombre.value = nombre;
    form.categoria.value = categoria;
    form.publico.value = publico;
    form.descripcion.value = descripcion;
    form.precio.value = precio;
    form.oferta.value = oferta != "" ? oferta : "ninguna";
  });
});

// ----------------------------------------------------------------
// FORMULARIO DE INSERCIÓN DE IMAGENES
// ----------------------------------------------------------------

const imgForm = document.querySelector(".dropzone");
const imgBtn = document.querySelectorAll(".imgbtn");
const myid = document.getElementsByName("Id_articulo_img");
let idProducto;

imgBtn.forEach((element) => {
  element.addEventListener("click", (e) => {
    idProducto = e.target.id;
  });
});

Dropzone.options.myDropzone = {
  url: "/mvc/upload_img", // Ruta a tu script PHP para procesar la carga
  maxFilesize: 5, // Tamaño máximo del archivo en MB
  acceptedFiles: ".jpg, .png, .jpeg, .gif", // Tipos de archivos permitidos
  addRemoveLinks: true, // Mostrar enlaces para eliminar archivos
  init: function () {
    this.on("sending", function (file, xhr, formData) {
      formData.append("Id_articulo", idProducto);
    });
  },
};

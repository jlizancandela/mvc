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
// FORMULARIO DE INSERCCION DE IMAGENES
// ----------------------------------------------------------------

const imgForm = document.querySelector(".dropzone");
const imgBtn = document.querySelectorAll(".imgbtn");
const myid = document.getElementsByName("Id_articulo_img");
let idProducto;

imgBtn.forEach(element => {
  element.addEventListener("click", (e) => {
    idProducto = e.target.id
  });
});



  Dropzone.options.myDropzone = {
  url: "/mvc/upload_img", // Ruta a tu script PHP para procesar la carga
  maxFilesize: 5, // Tamaño máximo del archivo en MB
  acceptedFiles: ".jpg, .png, .jpeg, .gif", // Tipos de archivos permitidos
  addRemoveLinks: true, // Mostrar enlaces para eliminar archivos
  init: function() {
  this.on('sending', function(file, xhr, formData){
    formData.append('Id_articulo', idProducto);
  })}};


document.addEventListener("DOMContentLoaded", function () {
  // Cargar las publicaciones al cargar la página
  loadPublicaciones();

  // Evento para abrir el modal de nueva publicación
  const newPostButton = document.getElementById("newPostButton");
  const postModal = document.getElementById("postModal");
  const closeModal = document.querySelector(".close");

  newPostButton.addEventListener("click", function () {
    postModal.classList.remove("hidden");
  });

  closeModal.addEventListener("click", function () {
    postModal.classList.add("hidden");
  });

  // Enviar formulario de nueva publicación
  const postForm = document.getElementById("postForm");
  postForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío tradicional del formulario

    const formData = new FormData(postForm); // Crear FormData con los datos del formulario

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/publicaciones.php", true); // Enviar la solicitud al controlador
    xhr.onload = function () {
      if (xhr.status === 200) {
        postModal.classList.add("hidden"); // Cerrar el modal después de enviar
        loadPublicaciones(); // Cargar las publicaciones actualizadas
      }
    };
    xhr.send(formData);
  });
});

function loadPublicaciones() {
  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "../controllers/publicaciones.php?orden=recientes",
    true
  ); // Ajustar la ruta para obtener publicaciones
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("postsContainer").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

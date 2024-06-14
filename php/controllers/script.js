document.addEventListener("DOMContentLoaded", function () {
  const newPostButton = document.getElementById("newPostButton");
  const modal = document.getElementById("postModal");
  const closeModal = document.querySelector(".close");
  const postForm = document.getElementById("postForm");

  // Muestra el modal para crear una nueva publicación
  newPostButton.addEventListener("click", function () {
    modal.classList.remove("hidden");
  });

  // Cierra el modal
  closeModal.addEventListener("click", function () {
    modal.classList.add("hidden");
  });

});

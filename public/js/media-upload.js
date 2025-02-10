/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./resources/js/media-upload.js ***!
  \**************************************/
document.addEventListener("DOMContentLoaded", function () {
  var galleryUpload = document.getElementById("gallery-upload");
  var csrfToken = document.querySelector('meta[name="csrf-token"]');
  var articleIdInput = document.querySelector('input[name="article_id"]');
  if (!galleryUpload || !csrfToken || !articleIdInput) {
    console.warn("⚠️ Certains éléments requis pour l'upload des images ne sont pas trouvés !");
    return;
  }
  galleryUpload.addEventListener("change", function (event) {
    var files = event.target.files;
    if (files.length === 0) return;
    var formData = new FormData();
    formData.append("_token", csrfToken.content);
    formData.append("article_id", articleIdInput.value);
    for (var i = 0; i < files.length; i++) {
      formData.append("file", files[i]);
    }
    fetch("/admin/articles/upload-media", {
      method: "POST",
      body: formData
    }).then(function (response) {
      return response.json();
    }).then(function (result) {
      if (result.location) {
        location.reload();
      } else {
        console.error("Erreur serveur :", result);
        alert("❌ Erreur : " + (result.error || "Upload échoué."));
      }
    })["catch"](function (error) {
      console.error("Upload failed:", error);
      alert("❌ Une erreur est survenue lors du téléversement.");
    });
  });

  // ✅ Suppression d’image avec confirmation
  document.querySelectorAll(".delete-media").forEach(function (button) {
    button.addEventListener("click", function () {
      var imageId = this.dataset.id;
      if (confirm("Voulez-vous vraiment supprimer cette image ?")) {
        fetch("/admin/articles/media/".concat(imageId), {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": csrfToken.content,
            "Content-Type": "application/json"
          }
        }).then(function (response) {
          return response.json();
        }).then(function (result) {
          if (result.success) {
            location.reload();
          } else {
            alert("Erreur : " + result.error);
          }
        })["catch"](function (error) {
          return console.error("Suppression échouée:", error);
        });
      }
    });
  });
});
/******/ })()
;
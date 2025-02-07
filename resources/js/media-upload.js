document.addEventListener("DOMContentLoaded", function () {
    const galleryUpload = document.getElementById("gallery-upload");
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    const articleIdInput = document.querySelector('input[name="article_id"]');

    if (!galleryUpload || !csrfToken || !articleIdInput) {
        console.warn("⚠️ Certains éléments requis pour l'upload des images ne sont pas trouvés !");
        return;
    }

    galleryUpload.addEventListener("change", function (event) {
        let files = event.target.files;
        if (files.length === 0) return;

        let formData = new FormData();
        formData.append("_token", csrfToken.content);
        formData.append("article_id", articleIdInput.value);

        for (let i = 0; i < files.length; i++) {
            formData.append("file", files[i]);
        }

        fetch("/admin/articles/upload-media", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((result) => {
                if (result.location) {
                    location.reload();
                } else {
                    console.error("Erreur serveur :", result);
                    alert("❌ Erreur : " + (result.error || "Upload échoué."));
                }
            })
            .catch((error) => {
                console.error("Upload failed:", error);
                alert("❌ Une erreur est survenue lors du téléversement.");
            });
    });

    // ✅ Suppression d’image avec confirmation
    document.querySelectorAll(".delete-media").forEach((button) => {
        button.addEventListener("click", function () {
            let imageId = this.dataset.id;

            if (confirm("Voulez-vous vraiment supprimer cette image ?")) {
                fetch(`/admin/articles/media/${imageId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken.content,
                        "Content-Type": "application/json",
                    },
                })
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.success) {
                            location.reload();
                        } else {
                            alert("Erreur : " + result.error);
                        }
                    })
                    .catch((error) => console.error("Suppression échouée:", error));
            }
        });
    });
});
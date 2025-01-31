document.addEventListener("DOMContentLoaded", function () {
    let contactForm = document.getElementById("contact-form");

    if (!contactForm) {
        return; // ✅ Si le formulaire n'existe pas, ne fait rien
    }

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        console.log("Données envoyées :", Object.fromEntries(formData)); // ✅ Voir les données avant envoi

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Accept": "application/json"
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log("Données reçues :", data);

            // ✅ Afficher le message de confirmation
            let successMessage = document.getElementById("success-message");
            successMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            successMessage.style.display = "block";

            // ✅ Réinitialiser le formulaire après 3 secondes
            setTimeout(() => {
                contactForm.reset();
                successMessage.style.display = "none";
            }, 3000);
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi :", error);
            alert("Une erreur est survenue. Vérifiez votre connexion et réessayez.");
        });
    });
});
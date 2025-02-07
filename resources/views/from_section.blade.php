<section class="form-section py-5 ">
    <div class="container">
        <h2 class="text-center mb-4">Contactez-nous</h2>
        <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
    @csrf

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
        </div>
        <div class="col-md-6">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Votre téléphone">
        </div>
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
</form>
        <div id="success-message" style="display: none;"></div>
    </div>
</section>

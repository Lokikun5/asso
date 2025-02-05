<footer class="footer bg-light py-5">
    <div class="container">
        <div class="row">
            <!-- Logo et nom -->
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('image/assologo.webp') }}" alt="Logo Association A.N.G." class="footer-logo">
                    <h3 class="mb-0 new-green">Association A.N.G.</h5>
                </div>
                <p class="mt-2 text-muted">&copy; {{ date('Y') }} Association A.N.G. - Tous droits réservés.</p>
            </div>

            <!-- Contact -->
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <a href="mailto:example@associationang.com" class="text-decoration-none text-muted">example@associationang.com</a>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <a href="tel:+1234567890" class="text-decoration-none text-muted">+12 34 56 78 90</a>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        Adresse complète (à compléter)
                    </li>
                    <li class="mb-2">
                            <i class="fab fa-linkedin me-2"></i>
                            <a href="#" class="text-decoration-none text-muted">LinkedIn</a>
                    </li>
                    <li class="mb-2">
                        <i class="fab fa-facebook me-2"></i>
                        <a href="#" class="text-decoration-none text-muted">Facebook</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
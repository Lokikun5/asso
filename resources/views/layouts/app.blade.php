<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('meta.default.title'))</title>
    @yield('meta')
    <meta name="description" content="@yield('description', config('meta.default.description'))">

    {{-- ✅ Balises Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'Découvrez notre plateforme dédiée aux jeunes talents.')">

    {{-- ✅ Gestion des images dynamiques Open Graph --}}
    @if(request()->routeIs('articles.show') && isset($article))
        <meta property="og:image" content="{{ asset('storage/' . $article->img_banner) }}">
        <meta property="og:image:alt" content="{{ $article->title }}">
    @else
        <meta property="og:image" content="{{ asset('image/default-og-image.webp') }}">
        <meta property="og:image:alt" content="Image de présentation">
    @endif

    {{-- ✅ Gestion du SEO (robots) --}}
    @if (
        request()->is('/') || request()->is('articles') || request()->is('Nos-partenaires') || 
        request()->is('etablissements-partenaires') || request()->is('Nos-programmes') || 
        request()->is('Les-activites-prevues') || request()->is('Public-cible') || 
        request()->is('podcasts') || request()->is('articles/*') || 
        request()->is('Nos-partenaires/*') || request()->is('podcasts/*') || request()->is('entreprises-du-secteur-privé') ||
        request()->is('services-publics')

    )
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- ✅ Polices Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- ✅ Styles CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- ✅ Ajout conditionnel du CSS -->
    @yield('extra-css')

    {{-- ✅ Chargement conditionnel de TinyMCE --}}
    @if(isset($load_tinymce) && $load_tinymce)
        <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (typeof tinymce !== 'undefined') {
                    tinymce.init({
                        selector: 'textarea.editor',
                        menubar: true,
                        plugins: 'lists link image',
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
                        images_upload_url: '/upload-image',
                        images_upload_handler: (blobInfo, success, failure) => {
                            let formData = new FormData();
                            formData.append('file', blobInfo.blob(), blobInfo.filename());

                            fetch('/upload-image', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(result => {
                                if (result && result.location) {
                                    success(result.location);
                                } else {
                                    failure("L'upload a échoué.");
                                }
                            })
                            .catch(() => {
                                failure("Erreur lors de l'upload.");
                            });
                        },
                        content_css: '//www.tiny.cloud/css/codepen.min.css'
                    });
                } else {
                    console.error("❌ TinyMCE n'a pas été chargé correctement !");
                }
            });
        </script>
    @endif
</head>

<body>
    {{-- ✅ Inclusion du Header --}}
    @include('layouts.header')

    {{-- ✅ Contenu de la page --}}
    <main>
        @yield('content')
    </main>

    {{-- ✅ Inclusion du Footer --}}
    @include('layouts.footer')

    <!-- ✅ Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/contact.js') }}" defer></script>
    <script src="{{ asset('js/media-upload.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ Ajout conditionnel du JS -->
    @yield('extra-js')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var dropdowns = document.querySelectorAll('.dropdown-toggle');

    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener("click", function (event) {
            event.preventDefault(); // Empêche le lien de s'exécuter
            let menu = this.nextElementSibling;

            if (menu.classList.contains("show")) {
                menu.classList.remove("show");
                this.setAttribute("aria-expanded", "false");
            } else {
                document.querySelectorAll(".dropdown-menu.show").forEach(function (openMenu) {
                    openMenu.classList.remove("show");
                });

                menu.classList.add("show");
                this.setAttribute("aria-expanded", "true");
            }
        });
    });

    // ✅ Fermer le dropdown en cliquant ailleurs
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-menu.show").forEach(function (menu) {
                menu.classList.remove("show");
            });
        }
    });

    console.log("✅ Bootstrap Dropdown activé !");
});


</script>

</body>
</html>
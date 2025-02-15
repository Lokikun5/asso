<!DOCTYPE html>
<html lang="fr">
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
                        images_upload_handler: (blobInfo) => {
                            return new Promise((resolve, reject) => {
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
                                        resolve(result.location);
                                    } else {
                                        reject("L'upload a échoué.");
                                    }
                                })
                                .catch(() => {
                                    reject("Erreur lors de l'upload.");
                                });
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

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('meta.default.title'))</title>
        @yield('meta')
        <meta name="description" content="@yield('description', config('meta.default.description'))">

        {{-- ✅ Balises Open Graph de base --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('title', config('app.name'))">
        <meta property="og:description" content="@yield('description', 'Découvrez notre plateforme dédiée aux jeunes talents.')">

        {{-- ✅ Gestion des images dynamiques Open Graph pour les articles --}}
        @if(request()->routeIs('front.articles.show') && isset($article))
            <meta property="og:image" content="{{ asset('storage/' . $article->img_banner) }}">
            <meta property="og:image:alt" content="{{ $article->title }}">
        @else
            <meta property="og:image" content="{{ asset('image/default-og-image.webp') }}">
            <meta property="og:image:alt" content="Image de présentation">
        @endif

        @if (
        request()->is('/') 
        || request()->is('articles') 
        || request()->is('Nos-partenaires') 
        || request()->is('etablissements-partenaires') 
        || request()->is('Nos-programmes') 
        || request()->is('Les-activites-prevues') 
        || request()->is('Public-cible') 
        || request()->is('podcasts') 
        || request()->is('articles/*')
        || request()->is('Nos-partenaires/*')
        || request()->is('podcasts/*')
        )
            <meta name="robots" content="index, follow">
        @elseif (request()->is('admin/*'))
            <meta name="robots" content="noindex, nofollow">
        @else
            <meta name="robots" content="noindex, nofollow">
        @endif

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100..900&family=Roboto:ital,wght@0,100..900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- ✅ Ajout conditionnel du CSS -->
        @yield('extra-css')
    </head>

    <body>
        @yield('content')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('js/contact.js') }}"></script>
        <script src="{{ asset('js/media-upload.js') }}"></script>

        <!-- ✅ Ajout conditionnel du JS -->
        @yield('extra-js')
    </body>
</html>
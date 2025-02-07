<!DOCTYPE html>
<html lang="fr">
    @if(isset($load_tinymce) && $load_tinymce)
        <script src="https://cdn.tiny.cloud/1/2j9xry6jul6ri51jnjmp3fgncjknf024pd879izabqmxlo5l/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
                        document.addEventListener("DOMContentLoaded", function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.editor',
                    menubar: true,
                    plugins: 'lists link image',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
                    images_upload_url: '/upload-image', // Route Laravel pour l'upload
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
                                    resolve(result.location); // ✅ Succès : URL de l’image
                                } else {
                                    reject("L'upload a échoué."); // ❌ Erreur
                                }
                            })
                            .catch(() => {
                                reject("Erreur lors de l'upload."); // ❌ Erreur réseau
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

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">



        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
       

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    </head>
    <body>

        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('js/contact.js') }}"></script>
        <script src="{{ asset('js/media-upload.js') }}"></script>

    </body>
</html>

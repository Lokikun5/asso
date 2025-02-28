@if(isset($load_tinymce) && $load_tinymce)
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof tinymce !== "undefined") {
        tinymce.init({
            selector: 'textarea.editor',
            menubar: true,
            plugins: 'lists link image',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            setup: function(editor) {
                editor.on('init', function() {
                    tinymce.triggerSave();
                });
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            }
        });
    } else {
        console.error("❌ TinyMCE non chargé");
    }
});
</script>
@endif
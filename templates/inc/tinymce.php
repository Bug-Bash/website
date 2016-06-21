<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: "textarea",
            height: 200,
            plugins: [
                "advlist autolink lists link image charmap hr anchor pagebreak",
                "wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking table contextmenu",
                "emoticons paste textcolor"
            ],
            toolbar1: "undo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor | emoticons | table | code",
            convert_urls: false,
            browser_spellcheck: true
        });
    });
</script>
// Customize input file
bsCustomFileInput.init();
// Slug
$("#name").on('keyup change focusout', function (){
    const name = $('#name').val();
    $('#slug').val(slug(name));
})
// Summernote
$('.summernote').summernote({
    height: 300
});

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
})

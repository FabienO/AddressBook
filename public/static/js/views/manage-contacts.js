$(document).ready(function() {
    $("#type").change( function () {
        console.log($(this).val());

        if($(this).val() == 'new-type') {
            $("#new-type").removeClass('hidden').slideDown('slow');
            $(this).prop('disabled', true);
            $('#new-type-option').text('Add new type below');
        } else {
            $("#new-type").addClass('hidden').slideUp();
        }
    });
});

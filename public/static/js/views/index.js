$(document).ready(function() {
    $("form#quick-edit").on('submit', function(e) {
        e.preventDefault();

        var $inputs = $('form#quick-edit :input');

        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        $.ajax({
            type: "POST",
            url: 'index',
            data: values,
            dataType: 'json',
            success: function(data) {
                $.each(values, function(key, value) {
                    beautyName = $('span[rel="'+ key +'"]').attr('beauty');

                    if(data[key] !== '') {
                        $('span[rel="'+ key +'"]').replaceWith('<p rel="'+ key +'"><strong>'+ beautyName +':</strong> <span>'+ data[key] +' Oi</span>');
                    } else {
                        $('span[rel="'+ key +'"]').replaceWith('<p rel="'+ key +'"><strong>'+ beautyName +':</strong> <span>Not set</span>');
                    }
                });
            }
        });
    });

    $('#contact-address').on('click', 'p', function() {
        originalName = $(this).attr('rel');
        originalValue = $(this).children('span').text();
        beautyName = $(this).children('strong').text().replace(':','');

        inputHtml    = '<span rel="'+ originalName +'" beauty="'+ beautyName +'"><label for="'+ originalName +'">Address one:</label>';
        inputHtml   += '<input type="text" name="'+ originalName +'" value="'+ originalValue +'"> <input type="submit" id="" value="submit"></span>';
        $(this).replaceWith(inputHtml);
    })
});
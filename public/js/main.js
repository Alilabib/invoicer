$(document).ready(function() {
    //   ============================================
    $('button').on('click', function(e) {

        $('.certificate').printThis({
            importStyle: $(this).hasClass('importStyle'),
            importCSS: "../css/style.css",
            printDelay: 333,
        });
    });

});
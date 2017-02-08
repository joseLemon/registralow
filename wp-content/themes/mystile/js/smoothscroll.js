$('.smoothScroll').click(function () {
    setTimeout(function () {
        $('html, body').stop().animate({
            'scrollTop': $('.wrapper').offset().top
        }, 500, 'swing' ); 
    }, 300 );
});

$("#scrollPrecios").click(function() {
    $('html, body').animate({
        scrollTop: $("#precioslow").offset().top
    }, 800, 'swing');
});

$('#scrollRevision').click(function (e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: $("#precioslow").offset().top
    }, 800, 'swing');
    $('#revision').addClass('active');
    setTimeout(function () {
        $('#revision').removeClass('active');
    }, 2500 );
});

$('#scrollRegistro').click(function (e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: $("#precioslow").offset().top
    }, 800, 'swing');
    $('#registro').addClass('active');
     setTimeout(function () {
        $('#registro').removeClass('active');
    }, 2500 );
});

$("#scrollDown").click(function(e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: $("#precioslow").offset().top
    }, 800, 'swing');
});
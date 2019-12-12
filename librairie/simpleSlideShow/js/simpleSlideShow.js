function slideSwitch() {
    var $active = $('#slideshow a.active');
    if ( $active.length == 0 ) $active = $('#slideshow a:last');
    var $next =  $active.next().length ? $active.next()
        : $('#slideshow a:first');
    $active.addClass('last-active');
        
    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}
$(function() {
    setInterval( "slideSwitch()", 5000 );
});
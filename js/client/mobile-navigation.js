/**
 * Created by Sam on 22/09/14.
 * Mobile navigation
 */

jQuery(document).ready(function($){

    var menuLeft = $( '#cbp-spmenu-s1' )
        ,showLeft = $('#showLeft');

    showLeft.on('click', toggleMenu);

    function toggleMenu() {

        // toggle active class on the burger button
        $(this).toggleClass('active' );

        // toggle menu class
        menuLeft.toggleClass( 'cbp-spmenu-open' );

    }
});

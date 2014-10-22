/**
 * Created by Sam on 2/07/14.
 *
 * Zing Design Custom shared functions and globals:
 */

(function($, window){
    'use strict';

    window.ZD = {
        medium: 'screen and (min-width:768px)',
        large: 'screen and (min-width:980px)',
        baseUrl: location.protocol + '//' + location.host,


        expandToTallest: function ( selector ) {

            // check if the selector is a string
            if( typeof selector === 'string' ) {
//                var jqObj = $(selector);
                this.generateStyleForTallest( $(selector) );

            }
            else if( selector instanceof Array ) {
                for(var i = 0; i < selector.length; i++) {
//                    var jqObj = $(selector[i]);
                    this.generateStyleForTallest( $(selector[i]) );
                }
            }
            return false;


        },
        generateStyleForTallest: function(_jqObj) {

            // Check if the selected element exists in the DOM
            if( _jqObj.length ) {
                // Get the value of the tallest element
                var tallest = this.getTallest(_jqObj);

                //console.log(tallest);

                // If the tallest value is returned
                // Add the style to the head
                if(tallest !== 0) {

//                    console.log(_jqObj);
                    this.addStyleToHead(_jqObj.selector, 'height:' + tallest + 'px;');
                }
            }
            
        },
        expandToWidest: function ( selector ) {
            var jqObj = $(selector),
                widest = this.getWidest(jqObj);

            if(widest !== 0) {
                this.addStyleToHead(selector, 'width:' + widest + 'px;');
            }

        },
        getTallest: function(obj) {
            var tallest = 0;
            obj.each(function(){
                var $this = $(this);

                if( $this.outerHeight() > tallest ) {
                    tallest = $this.outerHeight();
                }

            });
            return tallest;
        },
        getWidest: function(obj) {
            var widest = 0;
            obj.each(function(){
                var $this = $(this);

                if( $this.outerWidth() > widest ) {
                    widest = $this.outerWidth();
                }

            });
            return widest;
        },
        addStyleToHead: function(selector, rules) {
            if( ! $(selector).length ) {
                console.log('Error: the element you have selected does not exist');
                return false;
            }

            if (!$('#style-output').length) {
                var headElement = $('head');
                $('<style type="text/css" id="style-output"></style>').appendTo(headElement);
            }

            var css = selector + '{';

            //        console.log( typeof rules );

            if( typeof rules === 'object') {
                for(var i in rules) {
                    var value = rules[i].toString();

                    css += i + ':' + value + ';';
                }
            }
            else if( typeof rules === 'string' ) {
                css += rules;
            }
            else {
                console.log('Error: CSS Rules can only be passed as either an object or string');
            }

            css += '}';

            $('#style-output').append(css);
            return true;
        }
    };
})(jQuery, window);

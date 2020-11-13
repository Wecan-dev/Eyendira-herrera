(function($) {
'use strict';

$(window).load(function(){
    edgeInitTextMarquee();
});

/*
 ** Init Frame Slider shortcode
 */
function edgeInitTextMarquee() {

    var marqueeSections = $('.edge-text-marquee');

    if (marqueeSections.length) {
        marqueeSections.each(function(){
            var marqueeSection = $(this);

            var marqueeEffect = function () {
                edgeRequestAnimationFrame();

                var marqueeText = marqueeSection.find('.edge-text-marquee-title'),
                    originalText = marqueeText.first(),
                    auxText = marqueeText.filter('.edge-aux-text'),
                    marqueeTextWidthBasic = Math.round(originalText.width()),
                    marqueeTextWidth = Math.round(originalText.outerWidth());

                auxText.css('left', marqueeTextWidth); //set to the right of the inital marquee text element

                marqueeText.each(function(i){
                    var marqueeTextElement = $(this),
                        currentPos = 0,
                        delta = 2;

                    var edgeInfiniteScrollEffect = function() { 
                        currentPos -= delta;

                        if (Math.round(marqueeTextElement.offset().left) <= -marqueeTextWidth) {
                            marqueeTextElement.css('left', parseInt(marqueeTextWidth - 2*delta));
                            currentPos = 0;
                        }

                        marqueeTextElement.css('transform','translate3d('+currentPos+'px,0,0)');
                        requestAnimFrame(edgeInfiniteScrollEffect);

                        $(window).resize(function(){

                            currentPos = 0;
                            marqueeTextWidth = Math.round(originalText.outerWidth());
                            marqueeText.first().css('left',0);
                            auxText.css('left', marqueeTextWidth); //set to the right of the inital marquee text element
                        });
                    }; 

                    edgeInfiniteScrollEffect();
                });
            };

            //init
            marqueeSection.waitForImages({
                finished: function() {
                    marqueeEffect();
                    marqueeSection.css('visibility','visible');
                },
                waitForAll: true
            });
        });
    }

}

function edgeRequestAnimationFrame() {
    window.requestAnimFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (/* function */ callback, /* DOMElement */ element) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();
}
    
})(jQuery);
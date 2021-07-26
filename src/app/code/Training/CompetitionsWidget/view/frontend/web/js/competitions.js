define([
    'jquery',
    'slick'
], function ($) {
    'use strict';

    $.widget('competitions.competitionsJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._slider();
        },

        _slider: function () {
            let self = this;
            $(self.options.wrapper).slick({
                variableWidth: true,
                autoplay: true,
                speed: 1000,
                // prevArrow: '<button type="button" class="slick-prev"><img src="icons/prev.svg"</button>',
                // nextArrow: '<button type="button" class="slick-next"><img src="icons/next.svg"</button>',
                arrows: false,
                dots: true,
                slidesToShow: 1,
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            adaptiveHeight: true,
                            centerMode: true
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            adaptiveHeight: true,
                            centerMode: true,
                            arrows: false,
                            dots: true,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            adaptiveHeight: true,
                            centerMode: true,
                            arrows: false,
                            dots: false,
                        }
                    },
                ]
            });
        }

    });

    return $.competitions.competitionsJs;

});

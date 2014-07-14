/*
 * Bootstrap Image Gallery JS Demo 3.0.0
 * https://github.com/blueimp/Bootstrap-Image-Gallery
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint unparam: true */
/*global window, document, blueimp, $ */

$(function () {
    'use strict';

    $('#borderless-checkbox').on('change', function () {
        var borderless = $(this).is(':checked');
        $('#blueimp-gallery').data('useBootstrapModal', !borderless);
        $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', borderless);
    });

    $('#fullscreen-checkbox').on('change', function () {
        $('#blueimp-gallery').data('fullScreen', $(this).is(':checked'));
    });

    $('#image-gallery-button').on('click', function (event) {
        event.preventDefault();
        //blueimp.Gallery($('#links a'), $('#blueimp-gallery').data());
        blueimp.Gallery($('#food a'), $('#blueimp-gallery-food').data());        
    });

    $('#video-gallery-button').on('click', function (event) {
        event.preventDefault();
        alert("Not Setup To Work");
    });





    // To open other galleries.
    $('img#gallery_1 , p#gallery_1').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#links a'), $('#blueimp-gallery').data());
    });

    $('img#gallery_2, p#gallery_2').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#obnoxus a'), $('#blueimp-gallery-obnoxus').data());
    });

    $('img#gallery_3, p#gallery_3').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#maxim a'), $('#blueimp-gallery-maxim').data());
    });   


    $('p#food_gallery').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#food a'), $('#food_gallery').data());
    });    

    $('p#halifax_gallery').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#halifax a'), $('#halifax_gallery').data());
    });   

    $('p#cars_gallery').on('click', function (event) {
        event.preventDefault();
        blueimp.Gallery($('#cars a'), $('#cars_gallery').data());
    }); 


});

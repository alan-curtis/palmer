/**
 * Loading required JS scripts and plugins such as jQuery and Bootstrap
 */

window._ = require('lodash');
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');
require('es6-promise').polyfill();

/**
 * Loading theme JS plugins
 */

window.moment = require('moment');

// Require inputmask using jquery
require("inputmask/dist/inputmask/jquery.inputmask");
require("inputmask/dist/inputmask/inputmask.date.extensions");
window.Inputmask = require('inputmask');
require("slick-carousel");
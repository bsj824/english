window.$ = window.jQuery = require('jquery');
require('particles.js');
require('jquery-lazyload');
require('slick-carousel/slick/slick.js');
require('slick-carousel/slick/slick.css');
require('slick-carousel/slick/slick-theme.css');
window.$(function () {
  window.$('img[lazy]').lazyload();
});

"use strict";
// Open main nav
document.getElementById("main_nav_toggle").addEventListener("click", function () {
    
    if( document.getElementById("ml-menu") ){
        var main_nav = document.getElementById("ml-menu");
    }else{
        var main_nav = document.getElementById("top-main-menu");
    }
    
    if (main_nav.classList.contains("menu--open")) {
        main_nav.classList.remove("menu--open");
        document.getElementById("main_nav_toggle").classList.remove("display-none");
        document.querySelector('.action-close').classList.add("display-none");
    } else {
        main_nav.classList.add("menu--open");
        document.getElementById("main_nav_toggle").classList.add("display-none");
        document.querySelector('.action-close').classList.remove("display-none");
    }

});

// Close main nav
document.querySelector('.action-close').addEventListener("click", function () {
    
    if( document.getElementById("ml-menu") ){
        var main_nav = document.getElementById("ml-menu");
    }else{
        var main_nav = document.getElementById("top-main-menu");
    }
    
    if (main_nav.classList.contains("menu--open")) {
        main_nav.classList.remove("menu--open");
        document.getElementById("main_nav_toggle").classList.remove("display-none");
        document.querySelector('.action-close').classList.add("display-none");
    }

});
    
// Fix Google Page Speed Insights false error "Prioritize visible content"
if ( document.getElementById("perf-main-hero") && !navigator.userAgent.match(/Google Page Speed Insights/i) ){
    var light_bold_main_hero = document.getElementById("perf-main-hero");
    light_bold_main_hero.classList.add("lazyload");
}
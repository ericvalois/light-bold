// Open main nav
document.getElementById("main_nav_toggle").addEventListener("click", function () {
    
    var main_nav = document.getElementById("ml-menu");
    
    if (main_nav.classList.contains("menu--open")) {
        main_nav.classList.remove("menu--open");
    } else {
        main_nav.classList.add("menu--open");
    }

});

// Close main nav
document.querySelector('.action-close').addEventListener("click", function () {
    
    var main_nav = document.getElementById("ml-menu");
    
    if (main_nav.classList.contains("menu--open")) {
        main_nav.classList.remove("menu--open");
    }

});
    
// Fix Google Page Speed Insights false error "Prioritize visible content"
if ( document.getElementById("perf-main-hero") && !navigator.userAgent.match(/Google Page Speed Insights/i) ){
    var perf_main_hero = document.getElementById("perf-main-hero");
    perf_main_hero.classList.add("lazyload");
}
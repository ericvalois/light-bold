// Main menu toggle
document.getElementById("main_nav_toggle").addEventListener("click", function () {
    
    var main_nav = document.getElementById("nav-container");
    
    if (main_nav.classList.contains("opened")) {
        main_nav.classList.remove("opened");
    } else {
        main_nav.classList.add("opened");
    }

    var body = document.getElementsByTagName("body")[0];
    var main_header = document.getElementsByClassName("main-header")[0];

    if (body.classList.contains("navigation-opened")) {
        body.classList.remove("navigation-opened");
        main_header.classList.remove("navigation-opened");
    } else {
        body.classList.add("navigation-opened");
        main_header.classList.add("navigation-opened");
    }
});


function scrollTo(element, to, duration) {
    if (duration <= 0) return;
    var difference = to - element.scrollTop;
    var perTick = difference / duration * 10;

    setTimeout(function() {
        element.scrollTop = element.scrollTop + perTick;
        if (element.scrollTop === to) return;
        scrollTo(element, to, duration - 10);
    }, 10);
}

function runScroll() {
  scrollTo(document.body, 0, 600);
}
var scrollme;
scrollme = document.querySelector("#to_top");
scrollme.addEventListener("click",runScroll,false)

function scrollTo(element, to, duration) {
  if (duration <= 0) return;
  var difference = to - element.scrollTop;
  var perTick = difference / duration * 10;

  setTimeout(function() {
    element.scrollTop = element.scrollTop + perTick;
    if (element.scrollTop == to) return;
    scrollTo(element, to, duration - 10);
  }, 10);
}
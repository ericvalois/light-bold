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


/*
var classname = document.querySelectorAll(".menu-item-depth-0.menu-item-has-children");

//var classname = document.querySelectorAll(".menu-item-has-children");


for (var i = 0; i < classname.length; i++) {
    //classname[i].addEventListener('click', myFunction, false);
    classname[i].children.addEventListener("click", function (e) {
        //e.target.classList.add('green');
        if (e.target.classList.contains("opened")) {
            e.target.classList.remove("opened");
        } else {
            e.target.classList.add("opened");
        }

    });
}*/
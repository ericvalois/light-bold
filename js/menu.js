/*!
 * classie v1.0.1
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */
( function( window ) {
'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = classie;
} else {
  // browser global
  window.classie = classie;
}

})( window );

/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2015, Codrops
 * http://www.codrops.com
 */
;(function(window) {

    'use strict';

    var support = { animations : true },
        animEndEventNames = { 'WebkitAnimation' : 'webkitAnimationEnd', 'OAnimation' : 'oAnimationEnd', 'msAnimation' : 'MSAnimationEnd', 'animation' : 'animationend' },
        animEndEventName = animEndEventNames[ 'animation' ],
        onEndAnimation = function( el, callback ) {
            var onEndCallbackFn = function( ev ) {
                if( support.animations ) {
                    if( ev.target != this ) return;
                    this.removeEventListener( animEndEventName, onEndCallbackFn );
                }
                if( callback && typeof callback === 'function' ) { callback.call(); }
            };
            if( support.animations ) {
                el.addEventListener( animEndEventName, onEndCallbackFn );
            }
            else {
                onEndCallbackFn();
            }
        };
        
    function extend( a, b ) {
        for( var key in b ) { 
            if( b.hasOwnProperty( key ) ) {
                a[key] = b[key];
            }
        }
        return a;
    }

    function MLMenu(el, options) {
        this.el = el;
        this.options = extend( {}, this.options );
        extend( this.options, options );
        
        // the menus (<ul>´s)
        this.menus = [].slice.call(this.el.querySelectorAll('.menu__level'));
        // index of current menu
        this.current = 0;

        this._init();
    }

    var all_label = document.getElementById("all").innerHTML;

    MLMenu.prototype.options = {
        // show breadcrumbs
        breadcrumbsCtrl : true,
        // initial breadcrumb text
        initialBreadcrumb : all_label,
        // show back button
        backCtrl : false,
        // delay between each menu item sliding animation
        itemsDelayInterval : 60,
        // direction 
        direction : 'r2l',
        // callback: item that doesn´t have a submenu gets clicked
        // onItemClick([event], [inner HTML of the clicked item])
        onItemClick : function(ev, itemName) { return false; }
    };

    MLMenu.prototype._init = function() {
        // iterate the existing menus and create an array of menus, more specifically an array of objects where each one holds the info of each menu element and its menu items
        this.menusArr = [];
        var self = this;
        this.menus.forEach(function(menuEl, pos) {
            var menu = {menuEl : menuEl, menuItems : [].slice.call(menuEl.querySelectorAll('.menu__item'))};
            self.menusArr.push(menu);

            // set current menu class
            if( pos === self.current ) {
                classie.add(menuEl, 'menu__level--current');
            }
        });

        // create back button
        if( this.options.backCtrl ) {
            this.backCtrl = document.createElement('button');
            this.backCtrl.className = 'menu__back menu__back--hidden flex flex-center';
            this.backCtrl.setAttribute('aria-label', 'Go back');
            this.backCtrl.innerHTML = '<i class="fa fa-arrow-left" aria-hidden="true"></i>';
            this.el.insertBefore(this.backCtrl, this.el.firstChild);
        }
        
        
        // create breadcrumbs
        if( self.options.breadcrumbsCtrl ) {
            this.breadcrumbsCtrl = document.createElement('nav');
            this.breadcrumbsCtrl.className = 'menu__breadcrumbs flex flex-center px2 absolute col-12 bg-white line-height1';
            this.el.insertBefore(this.breadcrumbsCtrl, this.el.firstChild);
            // add initial breadcrumb
            this._addBreadcrumb(0);
        }
        
        // event binding
        this._initEvents();
    };

    MLMenu.prototype._initEvents = function() {
        var self = this;

        for(var i = 0, len = this.menusArr.length; i < len; ++i) {
            this.menusArr[i].menuItems.forEach(function(item, pos) {
                item.querySelector('a').addEventListener('click', function(ev) { 
                    var submenu = ev.target.getAttribute('data-submenu'),
                        itemName = ev.target.innerHTML,
                        subMenuEl = self.el.querySelector('ul[data-menu="' + submenu + '"]');

                    // check if there's a sub menu for this item
                    if( submenu && subMenuEl ) {
                        ev.preventDefault();
                        // open it
                        self._openSubMenu(subMenuEl, pos, itemName);
                    }
                    else {
                        // add class current
                        var currentlink = self.el.querySelector('.menu__link--current');
                        if( currentlink ) {
                            classie.remove(self.el.querySelector('.menu__link--current'), 'menu__link--current');
                        }
                        classie.add(ev.target, 'menu__link--current');
                        
                        // callback
                        self.options.onItemClick(ev, itemName);
                    }
                });
            });
        }
        
        // back navigation
        if( this.options.backCtrl ) {
            this.backCtrl.addEventListener('click', function() {
                self._back();
            });
        }
    };

    MLMenu.prototype._openSubMenu = function(subMenuEl, clickPosition, subMenuName) {
        if( this.isAnimating ) {
            return false;
        }
        this.isAnimating = true;
        
        // save "parent" menu index for back navigation
        this.menusArr[this.menus.indexOf(subMenuEl)].backIdx = this.current;
        // save "parent" menu´s name
        this.menusArr[this.menus.indexOf(subMenuEl)].name = subMenuName;
        // current menu slides out
        this._menuOut(clickPosition);
        // next menu (submenu) slides in
        this._menuIn(subMenuEl, clickPosition);
    };

    MLMenu.prototype._back = function() {
        if( this.isAnimating ) {
            return false;
        }
        this.isAnimating = true;

        // current menu slides out
        this._menuOut();
        // next menu (previous menu) slides in
        var backMenu = this.menusArr[this.menusArr[this.current].backIdx].menuEl;
        this._menuIn(backMenu);

        // remove last breadcrumb
        if( this.options.breadcrumbsCtrl ) {
            this.breadcrumbsCtrl.removeChild(this.breadcrumbsCtrl.lastElementChild);
        }
    };

    MLMenu.prototype._menuOut = function(clickPosition) {
        // the current menu
        var self = this,
            currentMenu = this.menusArr[this.current].menuEl,
            isBackNavigation = typeof clickPosition == 'undefined' ? true : false;

        // slide out current menu items - first, set the delays for the items
        this.menusArr[this.current].menuItems.forEach(function(item, pos) {
            item.style.WebkitAnimationDelay = item.style.animationDelay = isBackNavigation ? parseInt(pos * self.options.itemsDelayInterval) + 'ms' : parseInt(Math.abs(clickPosition - pos) * self.options.itemsDelayInterval) + 'ms';
        });
        // animation class
        if( this.options.direction === 'r2l' ) {
            classie.add(currentMenu, !isBackNavigation ? 'animate-outToLeft' : 'animate-outToRight');
        }
        else {
            classie.add(currentMenu, isBackNavigation ? 'animate-outToLeft' : 'animate-outToRight');    
        }
    };

    MLMenu.prototype._menuIn = function(nextMenuEl, clickPosition) {
        var self = this,
            // the current menu
            currentMenu = this.menusArr[this.current].menuEl,
            isBackNavigation = typeof clickPosition == 'undefined' ? true : false,
            // index of the nextMenuEl
            nextMenuIdx = this.menus.indexOf(nextMenuEl),

            nextMenuItems = this.menusArr[nextMenuIdx].menuItems,
            nextMenuItemsTotal = nextMenuItems.length;

        // slide in next menu items - first, set the delays for the items
        nextMenuItems.forEach(function(item, pos) {
            item.style.WebkitAnimationDelay = item.style.animationDelay = isBackNavigation ? parseInt(pos * self.options.itemsDelayInterval) + 'ms' : parseInt(Math.abs(clickPosition - pos) * self.options.itemsDelayInterval) + 'ms';

            // we need to reset the classes once the last item animates in
            // the "last item" is the farthest from the clicked item
            // let's calculate the index of the farthest item
            var farthestIdx = clickPosition <= nextMenuItemsTotal/2 || isBackNavigation ? nextMenuItemsTotal - 1 : 0;

            if( pos === farthestIdx ) {
                onEndAnimation(item, function() {
                    // reset classes
                    if( self.options.direction === 'r2l' ) {
                        classie.remove(currentMenu, !isBackNavigation ? 'animate-outToLeft' : 'animate-outToRight');
                        classie.remove(nextMenuEl, !isBackNavigation ? 'animate-inFromRight' : 'animate-inFromLeft');
                    }
                    else {
                        classie.remove(currentMenu, isBackNavigation ? 'animate-outToLeft' : 'animate-outToRight');
                        classie.remove(nextMenuEl, isBackNavigation ? 'animate-inFromRight' : 'animate-inFromLeft');
                    }
                    classie.remove(currentMenu, 'menu__level--current');
                    classie.add(nextMenuEl, 'menu__level--current');

                    //reset current
                    self.current = nextMenuIdx;

                    // control back button and breadcrumbs navigation elements
                    if( !isBackNavigation ) {
                        // show back button
                        if( self.options.backCtrl ) {
                            classie.remove(self.backCtrl, 'menu__back--hidden');
                        }
                        
                        // add breadcrumb
                        self._addBreadcrumb(nextMenuIdx);
                    }
                    else if( self.current === 0 && self.options.backCtrl ) {
                        // hide back button
                        classie.add(self.backCtrl, 'menu__back--hidden');
                    }

                    // we can navigate again..
                    self.isAnimating = false;
                });
            }
        }); 
        
        // animation class
        if( this.options.direction === 'r2l' ) {
            classie.add(nextMenuEl, !isBackNavigation ? 'animate-inFromRight' : 'animate-inFromLeft');
        }
        else {
            classie.add(nextMenuEl, isBackNavigation ? 'animate-inFromRight' : 'animate-inFromLeft');
        }
    };

    MLMenu.prototype._addBreadcrumb = function(idx) {
        if( !this.options.breadcrumbsCtrl ) {
            return false;
        }

        var bc = document.createElement('a');

        bc.className = "border-none ultra-small upper pointer flex flex-center nowrap";

        
        if( idx ){
            var StrippedString = this.menusArr[idx].name.replace(/(<([^>]+)>)/ig,"");
        }

        bc.innerHTML = idx ? StrippedString : this.options.initialBreadcrumb;
        this.breadcrumbsCtrl.appendChild(bc);

        var self = this;
        bc.addEventListener('click', function(ev) {
            ev.preventDefault();

            // do nothing if this breadcrumb is the last one in the list of breadcrumbs
            if( !bc.nextSibling || self.isAnimating ) {
                return false;
            }
            self.isAnimating = true;
            
            // current menu slides out
            self._menuOut();
            // next menu slides in
            var nextMenu = self.menusArr[idx].menuEl;
            self._menuIn(nextMenu);

            // remove breadcrumbs that are ahead
            var siblingNode;
            while (siblingNode = bc.nextSibling) {
                self.breadcrumbsCtrl.removeChild(siblingNode);
            }
        });
    };

    window.MLMenu = MLMenu;

})(window);

(function() {
    var menuEl = document.getElementById('ml-menu'),
        mlmenu = new MLMenu(menuEl, {
            breadcrumbsCtrl : true, // show breadcrumbs
            //initialBreadcrumb : 'all', // initial breadcrumb text
            backCtrl : false, // show back button
            itemsDelayInterval : 50, // delay between each menu item sliding animation
            //onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
        });

})();
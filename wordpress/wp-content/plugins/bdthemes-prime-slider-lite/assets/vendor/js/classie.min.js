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
!function(s){"use strict";function e(s){return new RegExp("(^|\\s+)"+s+"(\\s+|$)")}var n,t,a;function c(s,e){(n(s,e)?a:t)(s,e)}"classList"in document.documentElement?(n=function(s,e){return s.classList.contains(e)},t=function(s,e){s.classList.add(e)},a=function(s,e){s.classList.remove(e)}):(n=function(s,n){return e(n).test(s.className)},t=function(s,e){n(s,e)||(s.className=s.className+" "+e)},a=function(s,n){s.className=s.className.replace(e(n)," ")});var o={hasClass:n,addClass:t,removeClass:a,toggleClass:c,has:n,add:t,remove:a,toggle:c};"function"==typeof define&&define.amd?define(o):"object"==typeof exports?module.exports=o:s.classie=o}(window);
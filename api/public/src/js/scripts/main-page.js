function setCoockieAndRedirect(lang) {
    Cookies.set('lang', lang);
    window.location.replace("/home/");
}

document.addEventListener("DOMContentLoaded",function () {
    'use strict';
    var path = location.pathname.substring(1).split('/');
    if (path[0] !== '') {
        if (Cookies.get('lang') === undefined) {
            window.location.replace("/");
        }
    }
});
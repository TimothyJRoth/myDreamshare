'use strict';

const initBrowserCheck = () => {
    function isIE() {
        let ua = navigator.userAgent;
        /* MSIE used to detect old browsers and Trident used for newer ones*/
        return ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
    }

    /* Create an alert to show if the browser is IE or not */
    if (isIE()) {
        let elements = document.querySelectorAll('.ie-check');
        elements.forEach(function (element) {
            element.style.display = 'block';
        });
    }
}

module.exports = initBrowserCheck;

'use strict';

const initBrowserCheck = require('./function_modules/browserCheck');
const test = require('./function_modules/test');


document.addEventListener('DOMContentLoaded', () => {
    initBrowserCheck();
    test();
});


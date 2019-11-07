/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

import Vue from 'vue';
import Email from './components/Email'

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

const apiUrl = '/validate?email=';

var app = new Vue({
    el: '#register',
    components: {Email},
    data: {
        email: null,
        isEmailInvalid: false,
        message: null,
        seen: null
    },
    created: function () {
        this.email = document.querySelector("input[type=text]").value;
        this.message = this.email;
        this.seen = document.querySelector("input[type=text]").getAttribute('valid');
    },
    methods: {
        checkEmail: function (e) {
            if (this.validEmail(this.email)) {
                fetch(apiUrl + encodeURIComponent(this.email))
                    .then(res => res.json())
                    .then(res => {
                        if (res.msg == "") {
                            this.seen = false;
                            this.isEmailInvalid = false;
                        } else {
                            this.seen = true;
                        }
                    });
            }
            e.preventDefault();
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
})

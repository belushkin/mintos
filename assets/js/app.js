/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

import Vue from 'vue';

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

const apiUrl = '/validate?email=';

var app = new Vue({
    el: '#register',
    data: {
        email: document.querySelector("input[type=text]").value,
        password: document.querySelector("input[type=password]").value,
        isEmailInvalid: false
    },
    computed: {
        classEmailObject: function () {
            return {
                "is-invalid": this.isEmailInvalid
            }
        }
    },
    methods: {
        checkEmail: function (e) {
             console.log(this.email);
            console.log(e);
            this.isEmailInvalid = false;
            if (!this.email) {
                this.isEmailInvalid = true;
            } else if (!this.validEmail(this.email)) {
                this.isEmailInvalid = true;
                // console.log('specify correct email');
            }
            if (!this.isEmailInvalid) {
                fetch(apiUrl + encodeURIComponent(this.email))
                    .then(res => res.json())
                    .then(res => {
                        if (res.error) {
                            console.log('error');

                        } else {
                            console.log('ok!');
                        }
                    });
            }
            // this.isEmailInvalid = true;
            e.preventDefault();
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
})

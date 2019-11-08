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
import throttle from './throttle.js'

const apiUrl = '/validate?email=';

var app = new Vue({
    el: '#register',
    components: {Email},
    data: {
        email: null,
        isInvalid: false,
        message: null,
        seen: true
    },
    computed: {
        classEmailObject: function () {
            return {
                "is-invalid": this.isInvalid
            }
        },
        throttledCheck: function() {
            let DELAY = 1000;
            return throttle(this.check, DELAY);
        }
    },
    created: function () {
        this.email = document.querySelector("input[type=text]").value;
        this.seen = document.querySelector("input[type=text]").getAttribute('seen');
    },
    methods: {
        check: function (e) {
            fetch(apiUrl + encodeURIComponent(this.email))
                .then(res => res.json())
                .then(res => {
                    if (res.msg == "") {
                        this.seen = false;
                        this.isInvalid = false;
                        this.message = "";
                    } else {
                        this.seen = true;
                        this.isInvalid = true;
                        this.message = res.msg;
                    }
                });
        },
        submit: function (e) {
            if (this.seen === true) {
                e.stopPropagation();
                e.preventDefault();
            } else {
                return true;
            }
        }
    }
});


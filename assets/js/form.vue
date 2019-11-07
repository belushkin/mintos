const app = new Vue({
    el: '#register',
    data: {
    errors: [],
    name: null,
    age: null,
    movie: null
},
    methods: {
        checkForm: function (e) {
// if (this.name && this.age) {
//     return true;
// }
//
// this.errors = [];
//
// if (!this.name) {
//     this.errors.push('Требуется указать имя.');
// }
// if (!this.age) {
//     this.errors.push('Требуется указать возраст.');
// }

    e.preventDefault();
}
}
})

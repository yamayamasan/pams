require('./bootstrap');

Vue.component('list', require('../components/List.vue'));

const month = new Vue({
    el: '#month'
});

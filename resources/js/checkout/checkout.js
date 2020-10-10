
require('./bootstrap');

window.Vue = require('vue');
import main from './components/main.vue';
const app = new Vue({
    el: '#app',
    render: h => h(main),
});

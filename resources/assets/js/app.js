require('./bootstrap');

window.Vue = require('vue');

import VueResource from 'vue-resource';

import create_subpage_types from './components/CreateSubpageTypes/CreateSubpageTypes.vue';
import edit_subpage_types from './components/EditSubpageTypes/EditSubpageTypes.vue';

import send_email from './components/SendEmail.vue';


Vue.use(VueResource);

const app = new Vue({
    el: '#app',
    components: {
        create_subpage_types,
        edit_subpage_types,

        send_email
    }
});

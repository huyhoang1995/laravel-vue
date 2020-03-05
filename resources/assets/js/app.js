
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');
window.myFunc = require('@libs/myFunc').default;
window.myLoader = require('@libs/myLoader').default;

window.underscore = require('underscore');
window.$ = require('jquery');

//include parsley
window.Parsley = require('parsleyjs');
require('@libs/plugin/parsley/vi.js');

//include bootstrap notify
require('bootstrap-notify');
window.myNotify = require('@libs/myNotify.js').default;

//incudel bootbox
window.myBootbox = require('@libs/myBootbox').default;

//include service
window.service = {
    exampleService: require('@libs/service/exampleService').default,
    itemService: require('@libs/service/itemService').default,
    matrixService: require('@libs/service/matrixService').default,
}


//include vue-paginate
import pagination from "vue-bootstrap-pagination";
Vue.component('pagination', pagination);

//include ckeditor
window.ckeditor = require('@libs/plugin/ckeditor/ckeditor.js');

// include directive
window.myEnter = require("@libs/directive/myEnter").default;
Vue.directive('enter', myEnter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import VueCkeditor from 'vue-ckeditor2';
// vue.use (VueCkeditor);

// language
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)
import sdk from "matrix-js-sdk";

Vue.prototype.$client = sdk.createClient("http://chat.newtel.com.vn:8008");

// khai báo router
Vue.component('example-component', require('./components/ExampleComponent.vue'));
import VueRouter from 'vue-router';

//thực hiện router 
import routes from "./listRouter"
Vue.use(VueRouter);

window.translationsVN = require('@libs/lang/vn.js').default;
window.translationsEN = require('@libs/lang/en.js').default;

const messages = {
    en: {
        message: translationsEN
    },
    vn: {
        message: translationsVN
    }
}

const i18n = {
    locale: localStorage.getItem("lang") ? localStorage.getItem("lang") : "vn",
    messages,
}
// Create VueI18n instance with options


// Create a Vue instance with `i18n` option
const router = new VueRouter({ routes })

// vuex store
import { store } from "./libs/store/store";
import LoginChatComponent from "./components/LoginChatComponent.vue";

import AvatarComponent from './components/AvatarComponent.vue';



const app = new Vue({
    el: '#app',
    router,
    i18n,
    store: store,
    data:{
        return:{
            hello:'hello'
        }
    },
    components: {
        'my-login-component': LoginChatComponent,
        'avatar-component': AvatarComponent,
    }
});

// const app2 = new Vue({
//     el: '#app2',
//     router,
//     i18n,
//     store: store,
//     components: {
//         'my-login-component': LoginChatComponent,
//         'avatar-component': AvatarComponent,
//     }
// });



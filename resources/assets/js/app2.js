require('./bootstrap');

window.Vue = require('vue');

import AvatarComponent from './components/AvatarComponent.vue';
import LoginChatComponent from "./components/LoginChatComponent.vue";



const app = new Vue({
    el: '#app2',
    data: {
        return: {
            name:"huyhoang"
        }
    },

});

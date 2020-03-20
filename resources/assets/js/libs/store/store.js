import Vue from 'vue'
import Vuex from 'vuex'
import openSocket from 'socket.io-client';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        dataLogin: {
            baseUrl: "",
            accessToken: "",
            userId: "",
        },
        // socketIo: openSocket('http://localhost:3003')


    },

    mutations: {
        changeDataLogin: (state, payload) => {
            state.dataLogin.baseUrl = "https://" + payload.home_server;
            state.dataLogin.accessToken = payload.access_token;
            state.dataLogin.userId = payload.user_id;
            // state.dataLogin : {
            //     baseUrl: "https://" + payload.home_server,
            //     accessToken: payload.access_token,
            //     userId: payload.user_id,
            // }
        }
    },
    getters: {
        socketIo: state => state.socketIo,
        
    },

    actions: {
        changeDataLogin: (context, payload) => {
            setTimeout(function () {
                context.commit('changeDataLogin', payload)
            }, 2000)
        }
    }

})
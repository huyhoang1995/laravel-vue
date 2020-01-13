import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        dataLogin : {
            baseUrl: "",
            accessToken: "",
            userId: "",
        },
           
        
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

    actions: {
        changeDataLogin: (context, payload) => {
            setTimeout(function () {
                context.commit('changeDataLogin', payload)
            }, 2000)
        }
    }

})
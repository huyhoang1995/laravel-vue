<template>
    <div>
        <div class="cls-header cls-header-lg">

            <span class="brand-title" style="color: #fff; font-weight: bold; font-size:30px">Phần mềm hội nghị truyền hình </span>
            </span>

        </div>

        <!-- LOGIN FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body" style="padding: 20px 20px; background:#fff">
                    <p class="pad-btm">Đăng nhập hệ thống</p>
                    <form id="loginForm">
                        <!-- <div class="alert alert-danger" >
                                </div> -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" id="account" placeholder="Tên tài khoản" v-model="account" name="account">
                            </div>
                            <!-- <p style="color:#F56262; padding: 5px;" ng-show="data.checks.checkAccount"> Tên tài khoản
                                        không được để trống! </p>                -->
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-asterisk"></i>
                                </div>
                                <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password" v-model="password">
                            </div>
                            <!-- <p style="color:#F56262; padding: 5px;" ng-show="data.checks.checkPassword"> Mật khẩu không
                                        được để trống! </p> -->
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="button" style="margin-top: 30px" @click="clickButton()">
                            Đăng nhập
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <!--===================================================-->
    </div>
</template>

<script>
// import openSocket from 'socket.io-client';
// const socket = openSocket('http://localhost:3003');

import config from '../config';
export default {

    mounted() {

    },
    data: function() {
        return {
            isConnected: false,
            socketMessage: '',
            account: '',
            password: '',
            idSocket: ''

        }
    },
    sockets: {
        connect: function() {
            // Fired when the socket connects.
            this.isConnected = true;
        },

        disconnect: function() {
            this.isConnected = false;
        },

        // Fired when the server sends something on the "messageChannel" channel.
        messageChannel: function(data) {
            this.socketMessage = data
        }
    },
    methods: {
        saveSocketId: function() {
            console.log('testmethod work');
        },
        _login: function() {
            var that = this;
            console.log('login');
            this.$socket.on(config.socket.statusLogin, (data) => {
                console.log(siteUrl);
                if (data.status) {
                    window.location.href = siteUrl + '/?#/jitsiLogin';
                }
            });
            console.log(this.idSocket)
            this.$socket.emit(config.socket.login, { name: this.account }, function() {

            })
        },
        clickButton: function() {
            var that = this;

            console.log(config)
            // $socket is socket.io-client instance
            this.$socket.emit('pingClient', 'PING!');

            this.$socket.on('pingClient', function(data) {
                that.idSocket = data;
                that._login();
            })
        },
    },
    components: {
    }

};



</script>

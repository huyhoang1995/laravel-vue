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
                    <form id="loginForm" v-enter="loginJitsi">
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
                        <button class="btn btn-primary btn-lg btn-block" type="button" style="margin-top: 30px" @click="loginJitsi()">
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

import config from '../config';
export default {
    created() {
    
    },
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
        loginJitsi: function() {
            var param = service.jitsiService.data.login(this.account, this.password);
            service.jitsiService.action.login(param).then((resp) => {
                console.log(resp);
                if (resp.data.token) {
                    window.location.href = siteUrl + '/?#/jitsiLogin';
                }
            }).catch((err) => {
                console.log(err);
            })
        },
    },
    components: {
    }

};



</script>

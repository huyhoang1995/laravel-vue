<template>
    <div class="row col-sm-12">
        <!-- <div class="welcome col-sm-9">
                        <div class="box-enter">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form v-enter="loginJitsi">
                                        <legend class="col-md-12">Start a new meeting</legend>
                                        <span class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="" placeholder="Nhập tên" v-model="nameRoom">
                                            </div>
                                        </span>
                                        <span class="col-md-2">
                                            <a href="javascript:void(0)" class="btn btn-primary" @click="loginJitsi()">JOIN ROOM</a>
                                            <br/>
                                             <a href="javascript:void(0)" class="btn btn-primary" @click="openModal()">Show modal</a>
                                            <br/>
                                            <a href="javascript:void(0)" class="btn btn-primary" @click="notifyMe()">Notify</a> 
                                            <button @click="getUserOnline()">test</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
        <div class="col-sm-12">
            <div class="panel panel-default" style="height:100vh">
                <div class="panel-heading">
                    <h3 style="padding: 10px">Danh sách người dùng online</h3>
                </div>

                <div class="panel-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tên người dùng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr v-for="(item, index) in listUserOnline">
                                            <td><img class="img-circle" style="width:30px;height:30px" v-bind:src="'./images/avt.png'" alt="">  {{item.name}}</td>
                                            <td> {{item.status}}</td>
                                            <td>
                                                <i class="btn btn-info btn-icon btn-circle fa fa-phone" title="Modal gọi đi" aria-hidden="true" @click="openCallModal()"></i>
                                                 <i class="btn btn-success btn-icon btn-circle fa fa-volume-control-phone" title="Modal gọi đến" aria-hidden="true" @click="openModal()"></i> 
                                            </td>
                                        </tr> -->
                            <tr v-for="(item, index) in listUserData">
                                <td><img class="img-circle" style="width:30px;height:30px" v-bind:src="'./images/avt.png'" alt=""> {{item.name}}</td>
                                <td v-if="item.status">
                                    <button class="btn btn-info">{{item.status}}</button>
                                </td>
                                <td v-if="!item.status">
                                    <button class="btn btn-primary" disabled="disabled">offline</button>
                                </td>
                                <td>
                                    <i class="btn btn-info btn-icon btn-circle fa fa-phone" title="Modal gọi đi" aria-hidden="true" @click="openCallModal(item)"></i>
                                    <i class="btn btn-success btn-icon btn-circle fa fa-volume-control-phone" title="Modal gọi đến" aria-hidden="true" @click="openReceiveCallModal()"></i>
                                    <button @click="playAudioTune()" style="display:none"> bật nhạc</button>
                                    <button @click="stopAudioTune()" style="display:none"> tắt nhạc</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <audio id="audioTune" controls style="display: none" muted="muted">
                <source v-bind:src="'./sound/ring.mp3'" type="audio/ogg">
                <source v-bind:src="'./sound/ring.mp3'" type="audio/mpeg">
            </audio>
        </div>

        <!--modal  -->
        <receive-call-modal :id="idModal" :user-call="userCall"></receive-call-modal>
        <call-modal :id="idCallModal" :user-receive-call="userReceiveCall" :ret-func="checkCancelCall"></call-modal>
    </div>
</template>
<script>
$(document).ready(function() {

    var audioTag = document.getElementById("audioTune");
    window.playAudio = function() {
        audioTag.play();
    }

    window.pauseAudio = function() {
        audioTag.pause();
    }
});

import openSocket from 'socket.io-client';
const socket = openSocket('http://localhost:3003');
import config from '../config';

export default {
    mounted() {
        // this.getUserOnline();
        this.listUser();

        // khi người dùng nhận được cuộc gọi
        this.$socket.on(config.socket.connecting, (data) => {
            console.log(data, 'data on socketCall')
            this.openReceiveCallModal(data)
            this.playAudioTune();
            this.notifyMe();
        });

        // khi người gọi hủy cuộc gọi
        // this.$socket.on(config.socket.cancelCall, () => {
        //     this.closeReceiveCallModal();
        //     myNotify.success("Bạn đã bỏ lỡ cuộc gọi");

        // });

        // khi người dùng xử lý cuộc gọi
        this.$socket.on(config.socket.statusAnswer, (data) => {
            console.log(data, 'check status answer')
            if (data.status) {
                console.log('thằng B trả lời')
                window.open(siteUrl + '/test?nameRoom=' + this.remove_unicode(data.userInfoB.name), '_blank');

            } else {
                myNotify.success("Người dùng bận");

                console.log('thằng B bận')
            }
            $("#" + this.idCallModal).modal("hide");

        });

        // đóng modal khi thằng B trả lời
        this.$socket.on(config.socket.hideModalReceiveCall, () => {
            this.stopAudioTune();
            this.closeReceiveCallModal()
            console.log('đóng modal khi b làm gì đấy');
        });

    },
    data: function() {
        return {
            dataUserInfo: {},
            nameRoom: "",
            idModal: 'receiveCallModal',
            idCallModal: 'idCallModal',
            listUserOnline: [],
            listUserData: [],
            userReceiveCall: {},
            userCall: {},
            checkStatusCallCancel: false
        }

    },
    methods: {
        playAudioTune: function() {
            $(document).ready(function() {

                window.playAudio();
            });

        },
        stopAudioTune: function() {
            $(document).ready(function() {
                window.pauseAudio();
            });

        },
        remove_unicode: function(str) {
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");

            str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1- 
            str = str.replace(/^\-+|\-+$/g, "");

            return str;
        },
        // nguời gọi hủy 

        // danh sách người dùng
        listUser: function() {
            var arr1 = [];
            var arr2 = [];

            // danh sách người dùng database
            service.jitsiService.action.listUser().then(resp => {
                arr1 = resp.data;
            }).then(() => {
                this.$socket.emit(config.socket.usersOnline);
            }).catch(err => {
                console.log(err)
            })
            // danh sách người dùng online(socket)
            this.$socket.on(config.socket.usersOnline, (listUserOnline) => {
                let arrUserOnline = [];

                for (const key in listUserOnline) {
                    if (listUserOnline.hasOwnProperty(key)) {
                        listUserOnline[key]['id'] = parseInt(key);
                        arrUserOnline.push(listUserOnline[key]);
                    }
                }

                arr2 = Object.values(arrUserOnline);
                this.listUserData = this.mergeArrayObject(arr1, arr2);
            });
        },

        // check userOnline
        mergeArrayObject: function(arr1, arr2) {
            this.dataUserInfo = JSON.parse(localStorage.getItem("dataUserInfo"));
            _.map(arr1, item1 => {
                _.map(arr2, item2 => {
                    if (item1.name == item2.name) {
                        item1.status = "online";
                        item1.socketId = item2.socketId;
                    }
                    if (this.dataUserInfo.name == item2.name) {
                        this.dataUserInfo.socketId = item2.socketId;
                    }
                })
            })

            localStorage.setItem("dataUserInfo", JSON.stringify(this.dataUserInfo));

            return arr1;
        },

        loginJitsi: function() {
            console.log(this.nameRoom);
            // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
            // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
            // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
            var win = window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, '_blank');
            // win.focus();
        },

        // hiển thị modal nhận cuộc gọi
        openReceiveCallModal: function(data) {
            console.log(data, 'open modal rêcive')
            this.userCall = data;
            $("#" + this.idModal).modal("show");

        },

        // hiển thị modal tạo cuộc gọi
        openCallModal: function(dataUser) {
            console.log(dataUser);
            this.userReceiveCall = dataUser;
            $("#" + this.idCallModal).modal("show");

            this.$socket.emit(config.socket.connecting, {
                userNameA: this.dataUserInfo.name,
                userIdA: this.dataUserInfo.id,
                userNameB: dataUser.name,
                userIdB: dataUser.id
            });

            // setTimeout(() => {
            //     if (this.checkStatusCallCancel) {

            //     } else {
            //         this.$socket.emit(config.socket.cancelCall, {
            //             socketIdB: dataUser.socketId,
            //             userNameA: this.dataUserInfo.name,
            //             userNameB: dataUser.name,
            //             userIdB: dataUser.id
            //         });
            //         $("#" + this.idCallModal).modal("hide");

            //         console.log('đóng modal sau 10s')
            //     }

            // }, 10000);

        },

        notification: function() {
            // request permission on page load
        },

        notifyMe: function() {
            document.addEventListener('DOMContentLoaded', function() {
                if (!Notification) {
                    alert('Desktop notifications not available in your browser. Try Chromium.');
                    return;
                }

                if (Notification.permission !== 'granted') {
                    Notification.requestPermission();
                }
            });

            if (Notification.permission !== 'granted') {
                Notification.requestPermission();
            }
            else {
                var notification = new Notification('Notification title', {
                    icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                    body: 'Hey there! You\'ve been notified!',
                });
                notification.onclick = function() {
                    window.open('http://stackoverflow.com/a/13328397/1269037');
                };
            }
        },

        closeReceiveCallModal: function() {
            $("#" + this.idModal).modal("hide");
        },

        // khi A gọi lâu quá ko gọi trả lời
        checkCancelCall: function(data) {
            console.log('return data', data)
            this.checkStatusCallCancel = data;
        }
    },
    components: {
        receiveCallModal: require("@component/modal/ReceiveCallModal.vue"),
        callModal: require("@component/modal/CallModal.vue")
    }
};

</script>
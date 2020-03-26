<template>
    <div class="row col-sm-12">
        <div class="col-sm-12">
            <div class="panel panel-default">
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
                            <tr v-for="(item, index) in listUserData" :key="index">
                                <td><img class="img-circle" style="width:30px;height:30px" v-bind:src="'./images/avt.png'" alt="">{{item.name}}</td>
                                <td>

                                    <button v-if="item.status" class="btn" style="color: #fff" :class="item.status">{{item.status }}</button>
                                    <button v-if="!item.status" class="btn offline" style="color: #fff">offline</button>
                                </td>
                                <td>
                                    <i class="btn btn-info btn-icon btn-circle fa fa-phone" title="Modal gọi đi" aria-hidden="true" @click="openCallModal(item)"></i>

                                    <button @click="activeNotify()">activeNotify</button>

                                    <!-- <button @click="playAudioConnecting()"> bật nhạc</button>
                                    <button @click="playAudioWaitingCall()"> bật nhạc</button>
                                    <button @click="playAudioBusy()"> bật nhạc</button>

                                    <button @click="stopAudioTune()"> tắt nhạc</button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <audio id="connecting" controls style="display: none" muted="muted" loop>
                <source v-bind:src="'./sound/connecting.mp3'" type="audio/ogg">
                <source v-bind:src="'./sound/connecting.mp3'" type="audio/mpeg">
            </audio>

            <audio id="watingcall" controls style="display: none" muted="muted" loop>
                <source v-bind:src="'./sound/watingcall.mp3'" type="audio/ogg">
                <source v-bind:src="'./sound/watingcall.mp3'" type="audio/mpeg">
            </audio>

            <audio id="busy_signal" controls style="display: none" muted="muted" loop>
                <source v-bind:src="'./sound/busy_signal.mp3'" type="audio/ogg">
                <source v-bind:src="'./sound/busy_signal.mp3'" type="audio/mpeg">
            </audio>

            <audio id="noanswer" controls style="display: none" muted="muted" loop>
                <source v-bind:src="'./sound/noanswer.mp3'" type="audio/ogg">
                <source v-bind:src="'./sound/noanswer.mp3'" type="audio/mpeg">
            </audio>
        </div>

        <!--modal  -->
        <receive-call-modal :id="idModal" :user-call="userCall" :ret-func="checkFinishedCall"></receive-call-modal>
        <call-modal :id="idCallModal" :user-receive-call="userReceiveCall" :status-call-modal="statusCallModal" :ret-func="cancelCall"></call-modal>
    </div>
</template>
<script>
    var arr1 = [];
    var arr2 = [];



    $(document).ready(function () {

        // nhạc chờ
        var audioConnecting = document.getElementById("connecting");

        window.playAudioConnecting = function () {
            audioConnecting.play();
        }

        // nhạc khi đã kết nối và đợi người nhận trả lời
        var audioWaitingCall = document.getElementById("watingcall");
        window.playAudioWaitingCall = function () {
            audioWaitingCall.play();
        }



        //nhạc khi người nhận bận 
        var audioBusy = document.getElementById("busy_signal");
        window.playAudioBusy = function () {
            audioBusy.play();
        }


        //nhạc ko ai trả lời 
        var audioNoanswer = document.getElementById("noanswer");
        window.playAudioNoanswer = function () {
            audioNoanswer.play();
        }

        // tắt hết nhạc

        window.turnOffAllMusic = function () {
            audioConnecting.pause();
            audioWaitingCall.pause();
            audioBusy.pause();
            audioNoanswer.pause();
        }
    });


    import config from '../config';
    import openSocket from 'socket.io-client';
    export default {
        created() {
            this.$socketServer.socket = openSocket('http://localhost:3003');
        },
        mounted() {
            // this.getUserOnline();
            // danh sách người online

            var that = this;

            this.$socketServer.socket.on(config.socket.usersOnline, (listUserOnline) => {

                this.dataUserInfo = JSON.parse(localStorage.getItem("dataUserInfo"));

                let arrUserOnline = [];
                for (const key in listUserOnline) {
                    // set info currentUser
                    if (this.dataUserInfo.id == key) {
                        this.dataUserInfo.socketId = listUserOnline[key]['socketId'];
                        this.dataUserInfo.status = listUserOnline[key]['status'];
                    } else {
                        for (const index in arr1) {
                            if (arr1[index].id == key) {
                                arr1[index].status = listUserOnline[key]['status']
                                arr1[index].socketId = listUserOnline[key]['socketId']
                            }
                        }
                    }
                }

                localStorage.setItem("dataUserInfo", JSON.stringify(this.dataUserInfo));

                this.preSync = arr1;
                this.reloadDataRenderList();

            });

            // list userDatabase
            service.jitsiService.action.listUser().then(resp => {
                arr1 = resp.data;
            }).then(() => {
                this.$socketServer.socket.emit(config.socket.usersOnline);
            }).catch(err => {
                console.log(err)
            })

            // khi người dùng nhận được cuộc gọi
            this.$socketServer.socket.on(config.socket.connecting, (data) => {
                this.playAudioWaitingCall();
                console.log(data, 'data on socketCall')
                this.openReceiveCallModal(data)
                this.$socketServer.socket.emit(config.socket.connected, {
                    userIdA: data.userIdA,
                    socketIdA: data.socketIdA,
                    userIdB: data.userIdB,
                });

                // this.playAudioTune();
                // this.notifyMe();
            });

            var that = this;
            // người gọi kết nối thành công
            this.$socketServer.socket.on(config.socket.connected, (data) => {
                if (data) {
                    that.stopAudioTune();
                    that.playAudioWaitingCall();

                    this.statusCallModal = "Đã kết nối thành công";
                } else {
                    that.stopAudioTune();
                    $("#" + that.idCallModal).modal("close");
                }
            });
            var that = this;
            this.$socketServer.socket.on(config.socket.timeOutCalling, (data) => {
                console.log(data, 'data timeout');
                that.stopAudioTune();

                if (data) {
                    that.playAudioNoanswer();
                    setTimeout(function () {
                        that.stopAudioTune();
                        $("#" + that.idCallModal).modal("hide");
                    }, 2000);
                } else {
                    $("#" + that.idModal).modal("hide");
                    that.getNotify(config.statusCall.missCall);

                }
            })

            // khi người gọi hủy cuộc gọi
            this.$socketServer.socket.on(config.socket.cancelCall, (data) => {
                console.log(data, 'data cancel')
                that.closeReceiveCallModal();
                that.stopAudioTune();
                that.getNotify(config.statusCall.missCall);
                // myNotify.success("Bạn đã bỏ lỡ cuộc gọi");
            });

            // khi người dùng xử lý cuộc gọi
            this.$socketServer.socket.on(config.socket.statusAnswer, (data) => {
                this.stopAudioTune();

                if (data.status) {
                    that.finishedCallUrlCall = window.open(siteUrl + '/test?nameRoom=' + that.remove_unicode(that.userReceiveCall.name) + '&myUserId=' + that.dataUserInfo.id
                        + '&partnerId=' + that.userReceiveCall.id + '&userIdA=' + that.dataUserInfo.id + '&userIdB=' + that.userReceiveCall.id, '_blank');
                    // this.$windowChatCall = window.open(siteUrl + '/test?nameRoom=' + this.remove_unicode(this.userReceiveCall.name)  +'&myUserId=' + this.dataUserInfo.id+ '&partnerId=' + this.userReceiveCall.id, "myWindow", "width='100%',height='100%'");
                    $("#" + that.idCallModal).modal("hide");

                } else {
                    that.playAudioBusy()
                    setTimeout(function () {
                        $("#" + that.idCallModal).modal("hide");
                        that.stopAudioTune();
                    }, 2000);
                    myNotify.info("Người dùng bận");
                }

            });

            // đóng modal khi thằng B trả lời
            this.$socketServer.socket.on(config.socket.hideModalReceiveCall, () => {
                this.stopAudioTune();
                this.closeReceiveCallModal()
                console.log('đóng modal khi b làm gì đấy');
            });

            var that = this;

            this.$socketServer.socket.on(config.socket.endCall, () => {

                try {
                    that.finishedCallUrl.close();
                } catch (err) {

                }

                try {
                    that.finishedCallUrlCall.close();
                } catch (err) {

                }

            });

        },

        data: function () {
            return {
                dataUserInfo: {},
                nameRoom: "",
                idModal: 'receiveCallModal',
                idCallModal: 'idCallModal',
                listUserOnline: [],
                listUserData: [],
                userReceiveCall: {},
                userCall: {},
                finishedCallUrl: "",
                finishedCallUrlCall: "",
                preSync: [],
                statusCallModal: ""

            }

        },

        methods: {

            getNotify: function (data) {

                service.jitsiService.action.getNotify(data).then(resp => {
                    console.log(resp, 'active notify');
                }).catch(err => {
                    console.log(err);
                })
            },
            // nhạc khi bắt đầu kết nối
            playAudioConnecting: function () {
                $(document).ready(function () {
                    window.playAudioConnecting();
                });
            },

            // nhạc khi kết nối thành công;
            playAudioWaitingCall: function () {
                $(document).ready(function () {
                    window.playAudioWaitingCall();
                });
            },

            // nhạc khi thằng nhận bận
            playAudioBusy: function () {
                $(document).ready(function () {
                    window.playAudioBusy();
                });
            },

            // nhạc khi ko trả lời
            playAudioNoanswer: function () {
                $(document).ready(function () {
                    window.playAudioNoanswer();
                });
            },

            playAudioTune: function () {
                $(document).ready(function () {
                    window.playAudio();
                });
            },

            reloadDataRenderList: function () {
                // this.listUserData = this.preSync;
                this.listUserData = [];
                this.listUserData = this.preSync;
            },

            stopAudioTune: function () {
                $(document).ready(function () {
                    window.turnOffAllMusic();
                });
            },
            remove_unicode: function (str) {
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

            // hiển thị modal nhận cuộc gọi
            openReceiveCallModal: function (data) {
                console.log(data, 'open modal rêcive')
                this.userCall = data;
                $("#" + this.idModal).modal("show");
            },

            // hiển thị modal tạo cuộc gọi
            openCallModal: function (dataUser) {
                this.userReceiveCall = dataUser;
                $("#" + this.idCallModal).modal("show");

                this.$socketServer.socket.emit(config.socket.connecting, {
                    userNameA: this.dataUserInfo.name,
                    userIdA: this.dataUserInfo.id,
                    userNameB: dataUser.name,
                    userIdB: dataUser.id
                });
                this.playAudioConnecting();
                this.statusCallModal = "Đang kết nối với người gọi"
            },

            notification: function () {
                // request permission on page load
            },

            notifyMe: function () {
                document.addEventListener('DOMContentLoaded', function () {
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
                    notification.onclick = function () {
                        window.open('http://stackoverflow.com/a/13328397/1269037');
                    };
                }
            },

            closeReceiveCallModal: function () {
                $("#" + this.idModal).modal("hide");
            },

            // khi A gọi lâu quá ko gọi trả lời
            checkFinishedCall: function (data) {
                console.log('return data', data)
                if (data == true) {

                } else {
                    this.finishedCallUrl = data;
                }
            },

            finishedCall: function () {
                this.$socketServer.socket.emit(config.socket.endCall, {
                    myUserId: this.dataUserInfo.id,
                    partnerId: this.userReceiveCall.id
                });

            },
            // người gọi hủy cuộc gọi;
            cancelCall: function () {
                this.stopAudioTune();
            },


        },
        components: {
            receiveCallModal: require("@component/modal/ReceiveCallModal.vue"),
            callModal: require("@component/modal/CallModal.vue")
        }

    };

</script>
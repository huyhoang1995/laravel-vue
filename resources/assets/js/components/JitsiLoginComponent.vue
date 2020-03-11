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
                            <tr v-for="(item, index) in listUserOnline">
                                <td> {{item.name}}</td>
                                <td> {{item.status}}</td>
                                <td>
                                    <i class="btn btn-info btn-icon btn-circle fa fa-phone" title="Modal gọi đi" aria-hidden="true" @click="openCallModal()"></i>
                                    <i class="btn btn-success btn-icon btn-circle fa fa-volume-control-phone" title="Modal gọi đến" aria-hidden="true" @click="openModal()"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- {{listUserOnline}} -->

                </div>
            </div>
        </div>
        <receive-call-modal :id="idModal"></receive-call-modal>
        <call-modal :id="idCallModal"></call-modal>
    </div>
</template>
<script>
    import openSocket from 'socket.io-client';
    const socket = openSocket('http://localhost:3003');
    import config from '../config';

    export default {
        mounted() {
            this.getUserOnline();
        },
        data: function () {
            return {
                nameRoom: "",
                idModal: 'receiveCallModal',
                idCallModal: 'idCallModal',
                listUserOnline: []

            }

        },
        methods: {

            getUserOnline: function () {
                var arr = [];
                socket.emit(config.socket.usersOnline);

                socket.on(config.socket.usersOnline, (usersOnline) => {
                    this.listUserOnline = usersOnline;
                    _.each(usersOnline, (data, index) => {
                        console.log(data, index)
                        arr.push({
                            name: index,
                            socketId: data.socketId[0],
                            status: data.status
                        })
                    })
                    this.listUserOnline = arr;
                });
            },
            loginJitsi: function () {
                console.log(this.nameRoom);
                // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
                // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
                // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
                var win = window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, '_blank');
                // win.focus();
            },
            // hiển thị modal gọi
            openModal: function () {
                $("#" + this.idModal).modal("show");
            },
            openCallModal: function () {
                $("#" + this.idCallModal).modal("show");
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
            }
        },
        components: {
            receiveCallModal: require("@component/modal/ReceiveCallModal.vue"),
            callModal: require("@component/modal/CallModal.vue")
        }
    };

</script>
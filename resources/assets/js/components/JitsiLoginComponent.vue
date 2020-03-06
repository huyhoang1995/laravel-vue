<template>
    <div class="row col-sm-12">
        <div class="welcome">
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
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <call-modal :id="idModal"></call-modal>
    </div>
</template>
<script>


export default {
    mounted() {

    },
    data: function() {
        return {
            nameRoom: "",
            idModal: 'callModal'
        }

    },
    methods: {
        loginJitsi: function() {
            console.log(this.nameRoom);
            // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
            // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
            // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
            var win = window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, '_blank');
            // win.focus();
        },
        // hiển thị modal gọi
        openModal:function(){
            $("#" + this.idModal).modal("show");
        },
        notification:function(){
            // request permission on page load
        },
        notifyMe:function () {
            document.addEventListener('DOMContentLoaded', function() {
            if (!Notification) {
                alert('Desktop notifications not available in your browser. Try Chromium.');
                return;
            }

            if (Notification.permission !== 'granted'){
                Notification.requestPermission();
            }
            });

            if (Notification.permission !== 'granted'){
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
        }
    },
    components: {
        callModal: require("@component/modal/CallModal.vue")
    }
};
</script>

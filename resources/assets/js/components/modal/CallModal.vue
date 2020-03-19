<template>
    <div class="modal modalCall fade" role="dialog" tabindex="-1" :id="id">
        <div class="modal-dialog modalCall">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cuộc gọi đi</h4>
                </div>
                <div class="modal-body">
                    <form data-parsley-validate class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-12" style="text-align: center">
                                <span>
                                    <img class="img-circle" style="width:200px;height:200px" v-bind:src="'./images/avt.png'" alt="">
                                </span>
                                <br/>
                                <br/>
                                <p>
                                    <b>{{currentUserInfo.name}}</b>
                                </p>
                                <p>Đang chờ người khác tham gia cuộc gọi</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button @click="cancelCall()" style="font-size: 30px;" type="button" class="btn btn-danger btn-icon btn-circle fa fa-phone"
                        data-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import config from '../../config';

    const CallModal = {
        props: ["id", "userReceiveCall", ],

        created: function () {
            var app = this;
            this.$watch("userReceiveCall", function (newVal, oldVal) {
                app.userReceiveCallInfo = Object.assign({}, newVal);
            });
            app.currentUserInfo = JSON.parse(localStorage.getItem("dataUserInfo"));

        },

        mounted() {
           
        },

        data: function () {
            return {
                userReceiveCallInfo: {
                },
                currentUserInfo: {
                }
            };
        },

        methods: {
   
            loginJitsi: function () {
                console.log('123123213');
                // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
                // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
                // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
                var win = window.open(siteUrl + '/test?nameRoom=' + 'huyhoang', '_blank');
                // win.focus();
            },

            cancelCall: function () {
                this.$socket.emit(config.socket.cancelCall, {
                    userIdA: this.currentUserInfo.id,
                    userIdB: this.userReceiveCallInfo.id
                });
            },
        }
    };

    export default CallModal;

</script>
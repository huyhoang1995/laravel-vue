<template>
    <div class="modal modalCall fade" role="dialog" tabindex="-1" :id="id">
        <div class="modal-dialog modalCall">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cuộc gọi đến</h4>
                </div>
                <div class="modal-body">
                    <form data-parsley-validate class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <span>
                                    <img style="width:50px;height:50px" v-bind:src="'./images/avt.png'" alt="">
                                </span>
                                <span>
                                    <b>{{userCallInfo.userNameA}}</b> đang gọi...</span>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="reactCallAnswer(false)">Đóng</button>
                    <button type="button" class="btn btn-primary" @click="reactCallAnswer(true)">Trả lời</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import config from '../../config';

    const ReceiveCallModal = {
        props: ["id", "userCall","retFunc"],

        created: function () {
            var app = this;
            this.$watch("userCall", function (newVal, oldVal) {
                app.userCallInfo = Object.assign({}, newVal);
                console.log(app.userCallInfo)
            });
        },

        data: function () {
            return {
                userCallInfo: {}
            };
        },

        methods: {
            // đăng nhập vào jitsi
            loginJitsi: function () {
                console.log('123123213');
                // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
                // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
                // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
                var win = window.open(siteUrl + '/test?nameRoom=' + 'huyhoang', '_blank');
                // win.focus();
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

            // xử lý cuộc gọi 
            reactCallAnswer: function (status) {
                var currentUserInfo = JSON.parse(localStorage.getItem("dataUserInfo"));

                this.$socket.emit(config.socket.statusAnswer, {
                    statusAnswer: status,
                    socketIdA: this.userCallInfo.socketIdA,
                    userNameA: this.userCallInfo.userNameA,
                    socketIdB: currentUserInfo.socketId,
                    userNameB: currentUserInfo.name,
                    userIdA: this.userCallInfo.userIdA,
                    userIdB: currentUserInfo.id
                });

                //  khi người gọi đồng ý trả lời
                if (status) {
                    console.log('trả lời cuộc gọi')
                    console.log(this.$cmdCloseWindow)
                    var urlData= window.open(siteUrl + '/test?nameRoom=' + this.remove_unicode(currentUserInfo.name) +'&myUserId=' + currentUserInfo.id  + '&partnerId=' +  this.userCallInfo.userIdA , '_blank');

                    this.retFunc(urlData);

                } else {
                    // người gọi từ chối
                    myNotify.success("Bạn đã từ chối cuộc gọi");
                    console.log('thông báo thằng B từ chối')
                }

            }
        }
    };

    export default ReceiveCallModal;

</script>
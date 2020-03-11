<template>
    <div class="modal modalCall fade" role="dialog"  tabindex="-1" :id="id" >
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
                                <span><b>Nguyễn Huy Hoàng</b> đang gọi</span>

                            </div>
						
						</div>
					</form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Đóng</button>
                    <button type="button" class="btn btn-primary" @click="loginJitsi()">Trả lời</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const ReceiveCallModal = {
    props: ["id"],
    
    created: function() {
      
    },
    
    data: function() {
        return {

        };
    },
    methods: {
         loginJitsi: function() {
             console.log('123123213');
            // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
            // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
            // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
            var win = window.open(siteUrl + '/test?nameRoom=' + 'huyhoang', '_blank');
            // win.focus();
        },
    }
};

export default ReceiveCallModal;
</script>

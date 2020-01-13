<template>
  <div class="modal fade" role="dialog" id="messModal">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mời vào phòng</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Số điện thoại:</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model="data.phoneNumber" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nội dung:</label>
              <div class="col-sm-8">
                <textarea class="form-control" v-model="data.content"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="sendMess()">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const MessengerModal = {
  props: ["retFuncMess"],
  created: function() {},
  mounted() {},
  data: function() {
    return {
      data: {}
    };
  },
  methods: {
    sendMess: function() {
      var param = service.matrixService.data.sendMess(
        this.data.phoneNumber,
        this.data.content
      );
      service.matrixService.action
        .sendMess(param)
        .then(result => {
          console.log(result);
        })
        .catch(err => {});
    }
  }
};

export default MessengerModal;
</script>

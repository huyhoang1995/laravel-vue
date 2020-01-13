<template>
  <div class="modal fade" role="dialog" id="createRoom">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tạo phòng chat</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Tên phòng:</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model="data.roomName" required />
                <!-- <textarea class="form-control" name="" v-model="data.name" required></textarea> -->
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="createChatRoom()">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const CreateRoomModal = {
  props: ["retFuncCreate"],
  created: function() {},
  data: function() {
    return {
      data: {}
    };
  },
  methods: {
    createChatRoom: function() {
      var app = this;

      var param = service.matrixService.data.createChatRoom(this.data.roomName);
      service.matrixService.action
        .createChatRoom(param)
        .then(result => {
          console.log(result);
          if (result.data.room_id) {
            app.retFunc();
          }
        })
        .catch(err => {});
    }
  }
};

export default CreateRoomModal;
</script>

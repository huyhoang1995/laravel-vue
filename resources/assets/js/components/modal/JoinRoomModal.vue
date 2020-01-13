<template>
  <div class="modal fade" role="dialog" id="joinRoom">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Vào phòng</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">ID phòng:</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model="data.idRoom" required />
                <!-- <textarea class="form-control" name="" v-model="data.name" required></textarea> -->
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="joinRoom()">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const JoinRoomModal = {
  props: ["retFuncJoin"],

  created: function() {},
  mounted() {},
  data: function() {
    return {
      data: {}
    };
  },
  methods: {
    joinRoom: function() {
      var app = this;

      var param = service.matrixService.data.chatRoomHistory(this.data.idRoom);
      service.matrixService.action
        .joinRoom(param)
        .then(result => {
          if (result.data.room_id) {
            app.retFuncJoin();
          }
        })
        .catch(err => {});
    }
  }
};

export default JoinRoomModal;
</script>

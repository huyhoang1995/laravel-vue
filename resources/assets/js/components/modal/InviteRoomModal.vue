<template>
  <div class="modal fade" role="dialog" id="inviteRoom">
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
              <label class="col-sm-3 control-label">ID Người dùng:</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model="data.userId" required />
                <!-- <textarea class="form-control" name="" v-model="data.name" required></textarea> -->
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="inviteMember()">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const InviteRoomModal = {
  props: ["idRoom", "retFuncInvite"],
  created: function() {},
  mounted() {},
  data: function() {
    return {
      data: {}
    };
  },
  methods: {
    inviteMember: function() {
      console.log(this.data.userId);
      console.log(this.idRoom);
      var app = this;
      var param = service.matrixService.data.inviteMember(
        this.idRoom,
        this.data.userId
      );
      service.matrixService.action
        .inviteMember(param)
        .then(result => {
          console.log(result);
          app.retFuncInvite();

          //   if (result.data.room_id) {
          //     app.retFunc();
          //   }
        })
        .catch(err => {});
    }
  }
};

export default InviteRoomModal;
</script>

<template>
  <div class="modal fade" role="dialog" id="roomInvited">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Đanh sách phòng mời tham gia</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group pad-ver">
              <label class="col-md-3 control-label">Danh sách</label>
              <div class="col-md-9">
                <!-- Radio Buttons -->
                <div
                  class="radio"
                  v-for="room in listRoom"
                  :key="room.id"
                  @click="selectRoom(room.id)"
                >
                  <input
                    id="demo-form-radio-3"
                    class="magic-radio"
                    type="radio"
                    name="form-radio-button"
                  />
                  <label for="demo-form-radio-3">{{room.id}}</label>
                </div>
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
const RoomInvitedModal = {
  props: ["retFuncInvited"],
  created: function() {
    this.getListRoom();
  },
  data: function() {
    return {
      data: {},
      listRoom: [],
      roomSelected: ""
    };
  },
  methods: {
    selectRoom: function(data) {
      this.roomSelected = data;
      // this.getNameRoom(data);
    },
    getListRoom: function() {
      service.matrixService.action
        .getListRoom()
        .then(result => {
          // this.listRoom = result.data.rooms.join;
          // console.log(this.listRoom);
          var data = result.data.rooms.invite;
          var arr = [];
          for (var key in data) {
            data[key].id = key;
            arr.push(data[key]);
          }
          this.listRoom = arr;
        })
        .catch(err => {
          console.log(err);
        });
    },
    joinRoom: function() {
      var app = this;

      var param = service.matrixService.data.chatRoomHistory(this.roomSelected);
      service.matrixService.action
        .joinRoom(param)
        .then(result => {
          console.log(result);
          // if (result.data.room_id) {
          app.retFuncInvited();
          // }
        })
        .catch(err => {});
    }
  }
};

export default RoomInvitedModal;
</script>

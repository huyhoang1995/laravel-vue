<template>
  <div>
    <div id="page-head"></div>

    <div class="page-fixedbar-container">
      <div class="page-fixedbar-content">
        <div class="nano">
          <div class="nano-content">
            <div class="pad-all bord-btm">
              <input type="text" placeholder="Search or start new chat" class="form-control" />
            </div>
            <div class="chat-user-list">
              <a
                v-for="room in listRoom"
                :key="room.id"
                @click="selectRoom(room.id)"
                href="#"
                class="chat-unread"
              >
                <div class="media-left">
                  <img class="img-circle img-xs" src="img/avt.png" alt="Profile Picture" />
                  <i class="badge badge-success badge-stat badge-icon pull-left"></i>
                </div>
                <div class="media-body">
                  <span class="chat-info">
                    <span class="text-xs">11:39</span>
                    <span class="badge badge-success">9</span>
                  </span>
                  <div class="chat-text">
                    <p class="chat-username">{{renderName(room.id)}}</p>
                    <p>I will give you a complete account of the system.</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End Fixedbar-->

    <!--Page content-->
    <!--===================================================-->
    <div class="col-md-10" style="float:right !important">
      <div id="page-content">
        <div class="panel">
          <div class="media-block pad-all bord-btm">
            <div class="pull-right">
              <div class="btn-group dropdown">
                <a
                  href="#"
                  class="dropdown-toggle btn btn-trans"
                  data-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="pci-ver-dots"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style>
                  <li @click="showmodal">
                    <a href="#">
                      <i class="icon-lg icon-fw fa fa-plus-square-o"></i> CreateRoom
                    </a>
                  </li>
                  <li @click="showmodalInvite">
                    <a href="#">
                      <i class="icon-lg icon-fw demo-psi-pen-5"></i> Invite To Room
                    </a>
                  </li>
                  <li @click="showmodalJoinRoom">
                    <a href="#">
                      <i class="icon-lg icon-fw demo-pli-recycling"></i> JoinRoom
                    </a>
                  </li>
                  <li class="divider"></li>
                  <li @click="showmodalInvitedRoom">
                    <a href="#">
                      <i class="icon-lg icon-fw demo-pli-mail"></i> List room invited
                    </a>
                  </li>
                  <li @click="leaveRoom">
                    <a href="javascript:void(0)">
                      <i class="icon-lg icon-fw fa fa-sign-out"></i> Leave Room
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="media-left">
              <img class="img-circle img-xs" src="img/avt.png" alt="Profile Picture" />
            </div>
            <div class="media-body">
              <p class="mar-no text-main text-bold text-lg">{{renderName(this.roomSelected)}}</p>
              <small class="text-muteds">Online....</small>
            </div>
          </div>

          <div class="nano" style="height: 60vh">
            <div class="nano-content" ref="chatHistory" id="myscroll">
              <div class="panel-body chat-body media-block">
                <div v-for="history in historyChat" :key="history.age">
                  <div class="chat-user" v-if="history.user_id != myDataLogin.user_id">
                    <div class="media-left">
                      <img src="img/avt.png" class="img-circle img-sm" alt="Profile Picture" />
                    </div>
                    <div class="media-body">
                      <div>
                        <p v-if="!history.content.formatted_body">
                          {{history.content.body}}
                          <small>{{history.user_id}}</small>
                        </p>
                        <p
                          v-html="history.content.formatted_body"
                          v-if="history.content.formatted_body"
                          style="padding-left:30px"
                        >
                          <small>{{history.user_id}}</small>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div v-if="history.user_id == myDataLogin.user_id" class="chat-me">
                    <div class="media-left">
                      <img src="img/avt1.png" class="img-circle img-sm" alt="Profile Picture" />
                    </div>
                    <div class="media-body">
                      <div>
                        <p>
                          {{history.content.body}}
                          <small>{{history.user_id}}</small>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="pad-all">
            <div class="input-group">
              <input
                type="text"
                placeholder="Type your message"
                class="form-control form-control-trans"
                v-model="chatData.content"
                v-enter="sendMessgae"
              />
              <span class="input-group-btn">
                <button
                  class="btn btn-icon add-tooltip"
                  data-original-title="Add file"
                  type="button"
                  @click.prevent="$refs.file.click()"
                >
                  <i class="fa fa-file-image-o icon-lg"></i>
                </button>
                <input
                  type="file"
                  ref="file"
                  name="images"
                  v-on:change="uploadFileCommon"
                  id="upload-user"
                  style="display: none;"
                />

                <button
                  class="btn btn-icon add-tooltip"
                  data-original-title="Messenger"
                  type="button"
                  @click.prevent="showModalMess"
                >
                  <i class="fa fa-commenting icon-lg"></i>
                </button>
                <button
                  class="btn btn-icon add-tooltip"
                  data-original-title="Emoticons"
                  type="button"
                >
                  <i class="demo-pli-smile icon-lg"></i>
                </button>
                <button
                  @click="sendMessgae()"
                  class="btn btn-icon add-tooltip"
                  data-original-title="Send"
                  type="button"
                >
                  <i class="demo-pli-paper-plane icon-lg"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <join-room-modal :ret-func-join="successFuncJoin"></join-room-modal>
    <upload-modal
      :data-image="dataImage"
      :id-room="roomSelected"
      :ret-func-upload="successUploadModal"
    ></upload-modal>
    <room-invited-modal :ret-func-invited="succesInvited"></room-invited-modal>
    <create-room-modal :ret-func-create="retFuncCreate"></create-room-modal>
    <invite-room-modal :id-room="roomSelected" :ret-func-invite="successFuncInvite"></invite-room-modal>
    <messenger-modal :ret-func-mess="successMessenger"></messenger-modal>
  </div>
</template>

<script>
import sdk from "matrix-js-sdk";

var client;

// client.on("Room.timeline", function(event, roomId, toStartOfTimeline) {
//   // we know we only want to respond to messages
//   console.log(event);
//   console.log(roomId);
// });
var myDataLogin = JSON.parse(localStorage.getItem("dataLogin"));

export default {
  mounted() {
    // client.once("sync", function(state, prevState, res) {
    //   console.log(state); // state will be 'PREPARED' when the client is ready to use
    // });
    var app = this;
    client = sdk.createClient({
      // baseUrl: "http://" + myDataLogin.home_server + ":8008",
      baseUrl: "https://matrix.org",
      accessToken: myDataLogin.access_token,
      userId: myDataLogin.user_id
    });
    client.startClient();
    client.on("Room.timeline", function(event, room, toStartOfTimeline) {
      // we know we only want to respond to messages
      // console.log(event);

      if (event.event.type == "m.room.message") {
        app.chatRoomHistory(event.event.room_id);
      }
    });
    app.getListRoom();
  },

  data() {
    return {
      chatData: {},
      listRoom: [],
      roomSelected: "",
      historyChat: [],
      arrNameRoom: [],
      myDataLogin: myDataLogin,
      checkEvent: "",
      content_uri: "",
      dataImage: ""
    };
  },

  methods: {
    scrollToEnd: function() {
      var container = this.$el.querySelector("#myscroll");
      container.scrollTop = container.scrollHeight;
    },

    selectRoom: function(data) {
      this.roomSelected = data;
      this.chatRoomHistory();
      this.listMemberRoom();
      // this.getNameRoom(data);
    },
    sendMessgae: function() {
      // console.log(this.chatData.content);

      var param = service.matrixService.data.sendMessage(
        this.chatData.content,
        this.roomSelected
      );
      service.matrixService.action
        .sendMessage(param)
        .then(result => {
          this.chatData.content = "";
          // this.chatRoomHistory();

          // console.log(result);
        })
        .catch(err => {
          console.log(err);
        });
    },

    getListRoom: function() {
      var arr = [];
      this.listRoom = [];
      service.matrixService.action
        .getListRoom()
        .then(result => {
          // this.listRoom = result.data.rooms.join;
          // console.log(this.listRoom);
          // console.log(result.data.rooms);
          console.log(result.data.rooms);
          var data = result.data.rooms.join;
          for (var key in data) {
            data[key].id = key;
            arr.push(data[key]);
            this.getNameRoom(data[key].id);
          }
          this.listRoom = arr;
        })
        .catch(err => {
          console.log(err);
        });
    },
    chatRoomHistory: function() {
      var param = service.matrixService.data.chatRoomHistory(this.roomSelected);
      service.matrixService.action
        .chatRoomHistory(param)
        .then(result => {
          // console.log(result);
          if (result.data.chunk) {
            this.historyChat = result.data.chunk.reverse();
          }
        })
        .then(resp => {
          this.scrollToEnd();
        })
        .catch(err => {
          console.log(err);
        });
    },
    listMemberRoom: function() {
      var param = service.matrixService.data.chatRoomHistory(this.roomSelected);
      service.matrixService.action
        .listMemberRoom(param)
        .then(result => {
          //   console.log(result);
        })
        .catch(err => {
          console.log(err);
        });
    },
    getNameRoom: async function(id) {
      // console.log(id);
      var arr = [];
      var dataName = "";
      var param = service.matrixService.data.chatRoomHistory(id);
      var nameData = await service.matrixService.action
        .getNameRoom(param)
        .then(result => {
          if (result.data.name) {
            dataName = result.data.name;
          } else {
            dataName = "Tên phòng chưa định danh";
          }

          this.arrNameRoom.push({ id: id, name: dataName });
        })
        .catch(err => {
          dataName = "Tên phòng mặc định";
        });
    },
    renderName: function(id) {
      var data = id;
      this.arrNameRoom.map(roomName => {
        if (roomName.id == id) {
          data = roomName.name;
        }
      });
      return data;
    },
    leaveRoom: function() {
      var app = this;
      myBootbox.confirm(
        "Bạn có muốn reset mật khẩu bệnh nhân này này không",
        function(result) {
          if (result) {
            var param = service.matrixService.data.chatRoomHistory(
              app.roomSelected
            );
            service.matrixService.action
              .leaveRoom(param)
              .then(result => {
                console.log(result);
                app.getListRoom();
              })
              .catch(err => {
                console.log(err);
              });
          }
        }
      );
    },
    tokenRefresh: function() {
      console.log("token refresh");
      service.matrixService.action
        .tokenRefresh()
        .then(result => {
          console.log(result);
        })
        .catch(err => {
          console.log(err);
        });
    },
    uploadImages: function() {
      var content = $("input[name*=images]")[0].files[0];
      var param = service.matrixService.data.uploadImages(
        this.roomSelected,
        content,
        this.content_uri
      );
      service.matrixService.action
        .uploadImages(param)
        .then(result => {
          console.log(result);
        })
        .catch(err => {
          console.log(err);
        });
    },
    uploadFileCommon: function(e) {
      //   //   console.log(e);
      //   //   var files = e.target.files || e.dataTransfer.files; files == content
      var content = $("input[name*=images]")[0].files[0];
      //   console.log(content, "uploadcommon load");

      //   var param = service.matrixService.data.uploadFileCommon(content);
      //   service.matrixService.action
      //     .uploadFileCommon(param)
      //     .then(result => {
      //       this.content_uri = result.data.content_uri;
      //       console.log(result);
      //     })
      //     .catch(err => {
      //       console.log(err);
      //     });
      this.showUploadModal(content);
    },

    // control modal
    showmodal: function() {
      $("#createRoom").modal("show");
    },
    showUploadModal: function(data) {
      $("#uploadModal").modal("show");
      this.dataImage = data;
    },
    showmodalInvite: function() {
      $("#inviteRoom").modal("show");
    },
    showmodalJoinRoom: function() {
      $("#joinRoom").modal("show");
    },
    showmodalInvitedRoom: function() {
      $("#roomInvited").modal("show");
    },
    showModalMess: function() {
      $("#messModal").modal("show");
    },

    //return function
    retFuncCreate: function() {
      $("#createRoom").modal("hide");

      console.log("success create room");
      // var app = this;
      // this.tokenRefresh();
      this.getListRoom();
    },
    successFuncInvite: function() {
      $("#inviteRoom").modal("hide");
      this.getListRoom();
    },
    successFuncJoin: function() {
      $("#joinRoom").modal("hide");
      this.getListRoom();
    },
    succesInvited: function() {
      $("#roomInvited").modal("hide");
      this.getListRoom();
    },
    successUploadModal: function() {
      $("#uploadModal").modal("hide");
    },
    successMessenger: function() {
      $("#messModal").modal("hide");
    }
  },
  components: {
    createRoomModal: require("@component/modal/CreateRoomModal.vue"),
    inviteRoomModal: require("@component/modal/InviteRoomModal.vue"),
    joinRoomModal: require("@component/modal/JoinRoomModal.vue"),
    roomInvitedModal: require("@component/modal/RoomInvitedModal.vue"),
    uploadModal: require("@component/modal/UploadModal.vue"),
    messengerModal: require("@component/modal/MessengerModal.vue")
  }
};
</script>
<template>
  <div class="row col-sm-12">
    <!-- <div class="welcome col-sm-9">
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
                                            <button @click="getUserOnline()">test</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
    </div>-->
    <div class="col-sm-12">
      <div class="panel panel-default" style="height:100vh">
        <div class="panel-heading">
          <h3 style="padding: 10px">Danh sách người dùng online</h3>
        </div>

        <div class="panel-body">
          {{listUserData}}
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Tên người dùng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in listUserData" :key="index">
                <td>
                  <img
                    class="img-circle"
                    style="width:30px;height:30px"
                    v-bind:src="'./images/avt.png'"
                    alt
                  />
                  {{item.name}}
                </td>
                <td>
                  <button
                    class="btn online"
                    style="color: #fff"
                    v-if="checkStatus(item.status, item.socketId) == 'online' "
                  >{{checkStatus(item.status, item.socketId)}}</button>
                  <button
                    class="btn busy"
                    style="color: #fff"
                    v-if="checkStatus(item.status, item.socketId) == 'busy' "
                  >{{checkStatus(item.status, item.socketId)}}</button>
                  <button
                    class="btn incall"
                    style="color: #fff"
                    v-if="checkStatus(item.status, item.socketId) == 'incall' "
                  >{{checkStatus(item.status, item.socketId)}}</button>
                  <button
                    class="btn offline"
                    style="color: #fff"
                    v-if="checkStatus(item.status, item.socketId) == 'offline' "
                  >{{checkStatus(item.status, item.socketId)}}</button>
                </td>
                <td>
                  <i
                    class="btn btn-info btn-icon btn-circle fa fa-phone"
                    title="Modal gọi đi"
                    aria-hidden="true"
                    @click="openCallModal(item)"
                  ></i>
                  <i
                    class="btn btn-success btn-icon btn-circle fa fa-volume-control-phone"
                    title="Modal gọi đến"
                    aria-hidden="true"
                    @click="openReceiveCallModal()"
                  ></i>
                  <button @click="playAudioTune()" style="display:none">bật nhạc</button>
                  <button @click="stopAudioTune()" style="display:none">tắt nhạc</button>

                  <button @click="finishedCall()">finishedCall</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <i
        class="btn btn-info btn-icon btn-circle fa fa-phone"
        title="Modal gọi đi"
        aria-hidden="true"
        @click="reloadDataRenderList()"
      ></i>

      <audio id="audioTune" controls style="display: none" muted="muted">
        <source v-bind:src="'./sound/ring.mp3'" type="audio/ogg" />
        <source v-bind:src="'./sound/ring.mp3'" type="audio/mpeg" />
      </audio>
    </div>

    <!--modal  -->
    <receive-call-modal :id="idModal" :user-call="userCall" :ret-func="checkFinishedCall"></receive-call-modal>
    <call-modal :id="idCallModal" :user-receive-call="userReceiveCall"></call-modal>
  </div>
</template>
<script>
var arr1 = [];
var arr2 = [];

$(document).ready(function() {
  var audioTag = document.getElementById("audioTune");
  window.playAudio = function() {
    audioTag.play();
  };

  window.pauseAudio = function() {
    audioTag.pause();
  };
});

import config from "../config";
import openSocket from "socket.io-client";
export default {
  created() {
    this.$socketServer.socket = openSocket("http://172.16.20.89:3003");
  },
  mounted() {
    // this.getUserOnline();
    // danh sách người online

    var that = this;

    // list userDatabase

    this.$socketServer.socket.on(config.socket.usersOnline, listUserOnline => {
      console.log(listUserOnline, "listUserSocket");

      let arrUserOnline = [];
      for (const key in listUserOnline) {
        // set info currentUser
        if (this.dataUserInfo.id == key) {
            if(listUserOnline[key]["socketId"])
                this.dataUserInfo.socketId = listUserOnline[key]["socketId"];
            if(listUserOnline[key]["status"])
                this.dataUserInfo.status = listUserOnline[key]["status"];
        } else {
          for (const index in arr1) {
            if (arr1[index].id == key) {
                if(listUserOnline[key]["socketId"])
                    arr1[index].status = listUserOnline[key]["status"];
                if(listUserOnline[key]["status"])
                    arr1[index].socketId = listUserOnline[key]["socketId"];
            }
          }
        }
      }
      localStorage.setItem("dataUserInfo", JSON.stringify(this.dataUserInfo));

      this.preSync = arr1;

      this.reloadDataRenderList();
    });

     service.jitsiService.action
      .listUser()
      .then(resp => {
        alert(1);
        arr1 = resp.data;
        this.$socketServer.socket.emit(config.socket.usersOnline);
      })
      .catch(err => {
        console.log(err);
      });

    // khi người dùng nhận được cuộc gọi
    this.$socketServer.socket.on(config.socket.connecting, data => {
      // console.log(data, 'data on socketCall')
      this.openReceiveCallModal(data);
      this.$socketServer.socket.emit(config.socket.connected, {
        userIdA: data.userIdA,
        socketIdA: data.socketIdA,
        userIdB: data.userIdB
      });

      // this.playAudioTune();
      // this.notifyMe();
    });

    this.$socketServer.socket.on(config.socket.connected, data => {
      console.log(data, "data on connected");
      if (data) {
        this.playAudioTune();
      } else {
      }
    });

    this.$socketServer.socket.on(config.socket.timeOutCalling, () => {
      $("#" + this.idCallModal).modal("hide");
      $("#" + this.idModal).modal("hide");
      this.stopAudioTune();
    });

    // khi người gọi hủy cuộc gọi
    this.$socketServer.socket.on(config.socket.cancelCall, () => {
      this.closeReceiveCallModal();
      myNotify.success("Bạn đã bỏ lỡ cuộc gọi");
    });

    // khi người dùng xử lý cuộc gọi
    this.$socketServer.socket.on(config.socket.statusAnswer, data => {
      console.log(data, "check status answer");

      if (data.status) {
        console.log("thằng B trả lời");
        window.open(
          siteUrl +
            "/test?nameRoom=" +
            this.remove_unicode(this.userReceiveCall.name) +
            "&myUserId=" +
            this.dataUserInfo.id +
            "&partnerId=" +
            this.userReceiveCall.id,
          "_blank"
        );
        // this.$windowChatCall = window.open(siteUrl + '/test?nameRoom=' + this.remove_unicode(this.userReceiveCall.name)  +'&myUserId=' + this.dataUserInfo.id+ '&partnerId=' + this.userReceiveCall.id, "myWindow", "width='100%',height='100%'");
      } else {
        myNotify.success("Người dùng bận");

        console.log("thằng B bận");
      }
      $("#" + this.idCallModal).modal("hide");
      this.stopAudioTune();
    });

    // đóng modal khi thằng B trả lời
    this.$socketServer.socket.on(config.socket.hideModalReceiveCall, () => {
      this.stopAudioTune();
      this.closeReceiveCallModal();
      console.log("đóng modal khi b làm gì đấy");
    });

    var that = this;

    this.$socketServer.socket.on(config.socket.endCall, () => {
      console.log("data endCall");
      that.finishedCallUrl.close();
    });
  },

  data: function() {
    return {
      dataUserInfo: {},
      nameRoom: "",
      idModal: "receiveCallModal",
      idCallModal: "idCallModal",
      listUserOnline: [],
      listUserData: [],
      userReceiveCall: {},
      userCall: {},
      finishedCallUrl: "",
      preSync: [],
      statusClassCheck: {
        online: false,
        busy: false,
        incall: false,
        offline: false
      }
    };
  },

  methods: {
    checkStatus: function(status, socketId) {
      if (!status || !socketId) {
        return "offline";
      }

      if (socketId && socketId.length > 0 && status == "online") {
        this.statusClassCheck.online = true;
        return "online";
      }

      if (status == "busy") {
        this.statusClassCheck.busy = true;
        return "busy";
      }

      if (status == "incall") {
        this.statusClassCheck.incall = true;
        return "incall";
      }
    },

    reloadDataRenderList: function() {
      // this.listUserData = this.preSync;
      this.listUserData = [];
      this.listUserData = this.preSync;
      console.log(this.preSync);
    },

    playAudioTune: function() {
      $(document).ready(function() {
        window.playAudio();
      });
    },
    stopAudioTune: function() {
      $(document).ready(function() {
        window.pauseAudio();
      });
    },
    remove_unicode: function(str) {
      str = str.toLowerCase();
      str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
      str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
      str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
      str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
      str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
      str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
      str = str.replace(/đ/g, "d");
      str = str.replace(
        /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,
        "-"
      );

      str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
      str = str.replace(/^\-+|\-+$/g, "");

      return str;
    },
    // nguời gọi hủy

    // danh sách người dùng

    // check userOnline
    mergeArrayObject: function(arr1, arr2) {
      console.log(arr1, "listUserDatabase");
      console.log(arr2, "listUserOnline");
      this.dataUserInfo = JSON.parse(localStorage.getItem("dataUserInfo"));

      return _.map(arr1, function(obj) {
        return _.assign(
          obj,
          _.find(arr2, {
            id: obj.id
          })
        );
      });
      // _.map(arr1, item1 => {
      //     _.map(arr2, item2 => {
      //         if (item1.name == item2.name) {
      //             item1.socketId = item2.socketId;
      //             item1.status = item2.status
      //         }else{
      //             item1.status = ""

      //         }

      //         if (this.dataUserInfo.name == item2.name) {
      //             this.dataUserInfo.socketId = item2.socketId;
      //         }
      //     })
      // })

      localStorage.setItem("dataUserInfo", JSON.stringify(this.dataUserInfo));
      this.preSync = arr1;
      console.log(arr1, "data mutation");
      this.reloadDataRenderList();
    },

    loginJitsi: function() {
      console.log(this.nameRoom);
      // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
      // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
      // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
      var win = window.open(
        siteUrl + "/test?nameRoom=" + this.nameRoom,
        "_blank"
      );
      // win.focus();
    },

    // hiển thị modal nhận cuộc gọi
    openReceiveCallModal: function(data) {
      console.log(data, "open modal rêcive");
      this.userCall = data;
      $("#" + this.idModal).modal("show");
    },

    // hiển thị modal tạo cuộc gọi
    openCallModal: function(dataUser) {
      this.userReceiveCall = dataUser;
      $("#" + this.idCallModal).modal("show");

      this.$socketServer.socket.emit(config.socket.connecting, {
        userNameA: this.dataUserInfo.name,
        userIdA: this.dataUserInfo.id,
        userNameB: dataUser.name,
        userIdB: dataUser.id
      });
    },

    notification: function() {
      // request permission on page load
    },

    notifyMe: function() {
      document.addEventListener("DOMContentLoaded", function() {
        if (!Notification) {
          alert(
            "Desktop notifications not available in your browser. Try Chromium."
          );
          return;
        }

        if (Notification.permission !== "granted") {
          Notification.requestPermission();
        }
      });

      if (Notification.permission !== "granted") {
        Notification.requestPermission();
      } else {
        var notification = new Notification("Notification title", {
          icon: "http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png",
          body: "Hey there! You've been notified!"
        });
        notification.onclick = function() {
          window.open("http://stackoverflow.com/a/13328397/1269037");
        };
      }
    },

    closeReceiveCallModal: function() {
      $("#" + this.idModal).modal("hide");
    },

    // khi A gọi lâu quá ko gọi trả lời
    checkFinishedCall: function(data) {
      console.log("return data", data);
      this.finishedCallUrl = data;
    },

    finishedCall: function() {
      this.$socketServer.socket.emit(config.socket.endCall, {
        myUserId: this.dataUserInfo.id,
        partnerId: this.userReceiveCall.id
      });
    }
  },
  components: {
    receiveCallModal: require("@component/modal/ReceiveCallModal.vue"),
    callModal: require("@component/modal/CallModal.vue")
  }
};
</script>
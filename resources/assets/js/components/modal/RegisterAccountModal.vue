<template>
  <div class="modal fade" role="dialog" id="register">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Đăng ký</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Tài khoản:</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model="data.userName" required />
                <!-- <textarea class="form-control" name="" v-model="data.name" required></textarea> -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Mật khẩu :</label>
              <div class="col-sm-8">
                <input class="form-control" type="password" v-model="data.password" required />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="registerAccount()">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const RegisterAccountModal = {
  props: ["retFunc"],
  created: function() {},
  data: function() {
    return {
      data: {}
    };
  },
  methods: {
    registerAccount: function() {
      var app = this;

      var param = service.matrixService.data.loginMatrix(
        this.data.userName,
        this.data.password
      );
      service.matrixService.action
        .registerAccount(param)
        .then(result => {
          if (result.data.access_token) {
            app.retFunc();
          }
          console.log(result);
        })
        .catch(err => {});
    }
  }
};

export default RegisterAccountModal;
</script>

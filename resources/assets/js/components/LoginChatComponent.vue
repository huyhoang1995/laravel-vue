<template>
  <div class="cls-content">
    <div class="cls-content-sm panel">
      <div class="panel-body">
        <div class="mar-ver pad-btm">
          <div class="cls-brand logoLogin">
            <a class="box-inline" href="javascript:void(0)">
              <img
                v-bind:src="'./images/AppLogin.png'"
                alt="Nifty Logo"
                class="brand-icon"
                style="padding: 0; width: 100%;height: auto;"
              />
            </a>
          </div>
          <p>Đăng nhập hệ thống</p>
        </div>
        <form id="loginForm" data-parsley-validate v-enter="loginMatrix">
          <!-- <p style="color: red">{{validate}}</p> -->

          <div class="form-group">
            <input
              type="text"
              class="form-control"
              id="account"
              placeholder="Tài khoản"
              v-model="loginData.userName"
              name="account"
              value
              autofocus
              required
            />
          </div>

          <div class="form-group">
            <input
              type="password"
              class="form-control"
              id="password"
              v-model="loginData.password"
              placeholder="Mật khẩu"
              name="password"
              required
            />
          </div>
          <div class="checkbox pad-btm text-left">
            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" />
            <label for="demo-form-checkbox">Nhớ tài khoản</label>
          </div>
          <a
            class="btn btn-primary btn-lg btn-block"
            style="color: #fff"
            @click.prevent="loginMatrix()"
          >Đăng nhập</a>
          <a
            class="btn btn-success btn-lg btn-block"
            style="color: #fff"
            @click.prevent="showmodal()"
          >Đăng ký</a>
        </form>
        <br />
        <p class>
          <i class="fa fa-copyright" aria-hidden="true"></i> Công ty cổ phần Viễn Thông New-Telecom
        </p>
      </div>
    </div>
    <register-account-modal :ret-func="successFunc"></register-account-modal>
  </div>
</template>
<script>
import axios from "axios";

export default {
  mounted() {},
  data: function() {
    return {
      loginData: {
        userName: "bongbeo1995",
        password: "0382924061"
      }
    };
  },
  methods: {
    testData: function() {
      service.matrixService.action
        .getClient()
        .then(result => {
          console.log(result);
        })
        .catch(err => {});
    },
    loginMatrix: function() {
      var param = service.matrixService.data.loginMatrix(
        this.loginData.userName,
        this.loginData.password
      );
      service.matrixService.action
        .loginMatrix(param)
        .then(result => {
          console.log(result);
          localStorage.setItem("dataLogin", JSON.stringify(result.data));
          if (result.data.access_token) {
            window.location.href = siteUrl;
          }
        })

        .catch(err => {
          console.log(err);
        });
    },
    showmodal: function() {
      $("#register").modal("show");
    },

    successFunc: function() {
      $("#register").modal("hide");
    }

    // ...mapActions(["changeDataLogin"])
  },
  components: {
    registerAccountModal: require("@component/modal/RegisterAccountModal.vue")
  }
};
</script>

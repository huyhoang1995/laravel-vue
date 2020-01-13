<template>
  <div>
    <div class="col-md-6">
      <h3>Quản lý bệnh nhân</h3>
    </div>
    <div class="clearfix"></div>
    <br />
    <div class="col-md-10">
      <form class="form-inline">
        <label style="font-size: 15px;" for="demo-remember-me">Tìm kiếm</label>
        <input
          style="width:92%;height: 31px;"
          type="email"
          placeholder="Tên,sđt,email"
          class="form-control"
        />
      </form>
    </div>
    <div class="col-md-2">
      <span>
        <a @click="showUserModal()" class="btn btn-info">Thêm mới</a>
      </span>
    </div>
    <div class="clearfix"></div>
    <br />
    <br />
    <div class="col-md-12">
      <table class="table table-bordered table-hover">
        <thead>
          <tr style="background: #008000b5;color: #fff;">
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <router-link :to="{name: 'patientDetailClinic'}">Nguyễn Văn A</router-link>
            </td>
            <td>ABC@gmail.com</td>
            <td>123456789</td>
            <th>Nam</th>
            <th>Hà Nội</th>
            <td>
              <a class="btn btn-danger" @click="deleteUser()">
                <i class="fa fa-trash"></i>
              </a>
              <a class="btn btn-default" @click="showUserModal()">
                <i class="fa fa-edit"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modal -->
    <patient-modal :id="patientModal.id"></patient-modal>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      patientModal: {
        id: "patientModal"
      }
    };
  },
  methods: {
    showUserModal: function() {
      $("#" + this.patientModal.id).modal("show");
    },
    deleteUser: function(id) {
      myBootbox.confirm("Bạn có muốn xóa người dùng này không", function(
        result
      ) {
        if (result) {
          console.log("bạn đã xóa thành công");
        }
      });
    }
  },
  components: {
    patientModal: require("@component/modal/clinic/PatientComponentModal.vue")
  }
};
</script>

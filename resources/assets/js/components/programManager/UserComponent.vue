<template>
	<div>
		<div class="col-md-6">
			<h3>Quản lý người dùng</h3>
		</div>
		<div class="clearfix"></div>
		<br>
		<div class="col-md-10">
			<form class="form-inline">
				<label style="font-size: 15px;" for="demo-remember-me">Tìm kiếm</label>
				<input style="width:92%;height: 31px;" type="email" placeholder="Tên,sđt,email" class="form-control">
			</form>
		</div>
		<div class="col-md-2">
			<span><a class="btn btn-info" >Tìm kiếm nâng cao</a></span>
			<span><a @click="showUserModal()" class="btn btn-info" >Thêm mới</a></span>
		</div>
		<div class="clearfix"></div>
		<br><br>
		<div class="col-md-12">

			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #008000b5;color: #fff;">
						<th>Tên người dùng</th>
						<th>Email</th>
						<th>Vai trò</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nguyễn Văn A</td>
						<td>ABC@gmail.com</td>
						<td>Admin</td>
						<td> 
							<a class="btn btn-danger" @click="deleteUser()"><i class="fa fa-trash"></i></a>
							<a class="btn btn-default"  @click="showUserModal()"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Modal -->
		<user-modal :id="userModal.id" ></user-modal>
	</div>
</template>
<script>
	export default {
		data: function() {
			return{
				userModal:{
					id: "userModal"
				}
			}
		},
		methods:{
			showUserModal: function () {
				$("#" + this.userModal.id).modal("show");
			},
			deleteUser: function (id) {
				myBootbox.confirm("Bạn có muốn xóa người dùng này không", function (result) {
					if (result) {
						console.log('bạn đã xóa thành công');
					}
				});

			}

		},
		components: {
			userModal: require("@component/modal/programManager/UserComponentModal.vue")
		}
	}
</script>

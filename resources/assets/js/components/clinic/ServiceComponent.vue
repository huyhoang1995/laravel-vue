<template>
	<div>
		<div class="col-md-6">
			<h3>Quản lý dịch vụ</h3>
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
			<span><a @click="showUserModal()" class="btn btn-info" >Thêm mới</a></span>
		</div>
		<div class="clearfix"></div>
		<br><br>
		<div class="col-md-12">

			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #008000b5;color: #fff;">
						<th>Tên dịch vụ</th>
						<th>Số người dụng</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Dịch vụ 1</td>
						<td>100</td>
						<td> 
							<a class="btn btn-danger" @click="deleteUser()"><i class="fa fa-trash"></i></a>
							<a class="btn btn-default" @click="showUserModal()"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Modal -->
		<service-modal :id="serviceModal.id" ></service-modal>
	</div>
</template>
<script>
	export default {
		data: function() {
			return{
				serviceModal:{
					id: "serviceModal"
				}
			}
		},
		methods:{
			showUserModal: function () {
				$("#" + this.serviceModal.id).modal("show");
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
			serviceModal: require("@component/modal/clinic/ServiceComponentModal.vue")
		}
	}
</script>

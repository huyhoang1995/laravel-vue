<template>
	<div>
		<div class="col-md-6">
			<h3>Quản lý người dùng</h3>
		</div>
		<div class="clearfix"></div>
		<br>
		<div id="demo-panel-collapse-default" class="collapse" aria-expanded="true" style="">
			<div class="panel panel-bordered panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Tìm kiếm nâng cao</h3>
				</div>
				<div class="panel-body">
					<form action="" ng-enter='data.list()'>
						<div class="col-md-6 advanced_fillter">
							<label class="col-md-4">Họ và tên</label>
							<input class="col-md-8" ng-model='filter.name' type="text" placeholder="Họ và tên">
						</div>
						<div class="col-md-6 advanced_fillter">
							<label class="col-md-4">Vai trò</label>
							<select name="" class="col-md-8" required="required" ng-model="filter.status">
								<option value="">---Tất cả---</option>
								<option value=""> Bác sĩ </option>
								<option value="">Admin</option>									
							</select>

						</div>
						<div class="col-md-6 advanced_fillter">
							<label class="col-md-4">Email</label>
							<input class="col-md-8" ng-model='filter.name' type="text" placeholder="Email">
						</div>
						<div class="col-md-6 advanced_fillter">
							<label class="col-md-4">Số điện thoại</label>
							<input class="col-md-8" type="Email" placeholder="Số điện thoại" ng-model="filter.email">
						</div>
						<a href="" style="float: right; margin-right: 15px" class="find btn btn-primary" ng-click="data.list()"> Tìm kiếm</a>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<form class="form-inline" v-show='toggle'>
				<label style="font-size: 15px;" for="demo-remember-me">Tìm kiếm</label>
				<input style="width:92%;height: 31px;" type="text" placeholder="Tên" class="form-control">
			</form>
		</div>
		<div class="col-md-2">
			<button class="btn btn-primary" data-target="#demo-panel-collapse-default" data-toggle="collapse" aria-expanded="true" 
			@click='toggle = !toggle'>Tìm kiếm nâng cao</button>
			<span><a @click="showUserModal()" class="btn btn-info" >Thêm mới</a></span>
		</div>
		<div class="clearfix"></div>
		<br><br>
		<div class="col-md-12">

			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #008000b5;color: #fff;">
						<th>Tên người dùng</th>
						<th>Số điện thoại</th>
						<th>Giới tính</th>
						<th>Email</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nguyễn Văn A</td>
						<td>01682924061</td>
						<td>Nam</td>
						<td>ABC@gmail.com</td>
						<td> 
							<a class="btn btn-danger" @click="deleteUser()"><i class="fa fa-trash"></i></a>
							<a class="btn btn-default" @click="showUserModal()"><i class="fa fa-edit"></i></a>
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
				toggle:true,
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
			userModal: require("@component/modal/clinic/UserComponentModal.vue")
		}
	}
</script>

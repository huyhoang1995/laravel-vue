<template>
	<div>
		<div class="col-md-12">
			<div class="panel panel-bordered panel-success ">
				<div class="panel-heading">
					<h3 class="panel-title">Thông tin người dùng</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-2">
						<img  v-bind:src="'./images/avatar.png'" alt="">
					</div>
					<div class="col-md-10">
						<h3>
							Nguyễn Văn A
						</h3>
						<table class="table table-hover" style="font-size: 18px;">
							<thead>
								<tr>
									<td>Giới tính</td>
									<td>Tuổi</td>
									<td>Gói dịch vụ</td>
									<td>Thời gian</td>
								</tr>
							</thead>
							<tbody>
								<tr style="font-weight: bold">
									<td>Nam</td>
									<td>54 Tuổi</td>
									<td>Huyết áp cao</td>
									<td>3 tháng</td>
								</tr>
							</tbody>

						</table>
						<div style="font-size: 20px;margin-left: -10px">
							<i class="fa fa-home col-md-4" aria-hidden="true">Thanh Trình - Hà Nội</i>
							<i class="fa fa-envelope-o col-md-4" aria-hidden="true">hoangnh@newtel.com</i>
							<i class="fa fa-id-card-o col-md-4" aria-hidden="true">0382924061</i>
						</div>	
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="panel panel-bordered panel-success">
				<div class="panel-heading" style="position: relative;">
					<h3 class="panel-title">Lịch sử</h3>
					<button class="btn btn-info" style="position: absolute; right: 20px;top: 20%;">Chọn ngày</button>
				</div>
				<div class="panel-body">
					<div class="table-responsive" style="font-size: 25px;overflow: auto:;height: 200px" >
						<table class="table table-hover">
							<tbody>
								<tr>
									<td @click="showModal()"><i class="fa fa-home" aria-hidden="true"></i> <button ></button> 21/10/2018 HomeWork1</td>
								</tr>
								<tr>
									<td><i class="fa fa-home" aria-hidden="true"></i> 21/10/2018 HomeWork2</td>
								</tr>
								<tr>
									<td><i class="fa fa-home" aria-hidden="true"></i> 21/10/2018 HomeWork3</td>
								</tr>
								<tr>
									<td><i class="fa fa-home" aria-hidden="true"></i> 21/10/2018 HomeWork4</td>
								</tr>
								<tr>
									<td><i class="fa fa-home" aria-hidden="true"></i> 21/10/2018 HomeWork5</td>
								</tr>
								<tr>
									<td><i class="fa fa-home" aria-hidden="true"></i> 21/10/2018 HomeWork6</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Huyết áp</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>
					</div>
				</div>
				<div class="panel-body">
					
					<router-link to="/patientChartDetail">
						<a class="btn btn-info">
							Detail
						</a>
					</router-link>           

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Nhịp tim</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>

					</div>

				</div>
				<div class="panel-body">

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Số bước đi</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>

					</div>

				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Đường huyết</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>

					</div>

				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Đông máu</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>

					</div>

				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-bordered panel-warning">
				<div class="panel-heading"  style="position: relative;">
					<h3 class="panel-title">Lượng nước tiểu</h3>
					<div style="position: absolute; right: 20px;top: 20%;">
						<button class="btn btn-info" >Hôm nay</button>
						<button class="btn btn-info" >Tuần</button>
						<button class="btn btn-info" >Tháng</button>
						<button class="btn btn-info" >Năm</button>

					</div>

				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: function() {
			return{
				historyModal:{
					id: "historyModal"
				}
			}
		},
		methods:{
			showModal: function() {
				$("#" + this.historyModal.id).modal("show");
			}
		},
		components: {
			historyModal: require("@component/modal/clinic/PatientDetailHistoryComponent.vue")
		}
	}
</script>
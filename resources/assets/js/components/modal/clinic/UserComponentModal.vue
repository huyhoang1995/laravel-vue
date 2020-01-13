<template>
	<div :id="id" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cập nhật người dùng</h4>
				</div>
				<div class="modal-body">
					<form  class="form-horizontal" >
						<div class="form-group">
							<label class="col-sm-3 control-label">Họ và tên: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text"   min="1" max="80" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Vai trò: </label>
							<div class="col-sm-8">
								<select name="" id="input" class="form-control" required="required">
									<option value="">Doctor</option>
									<option value="">Nurse</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Số điện thoại: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text"  required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Giới tính: </label>
							<div class="col-sm-8">
								<select name="" id="input" class="form-control" required="required">
									<option value="">Nam</option>
									<option value="">Nữ</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" @click="update()">Cập nhật</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	const UserComponentModal = {
		props:['id']
	}
	export default UserComponentModal;
</script>

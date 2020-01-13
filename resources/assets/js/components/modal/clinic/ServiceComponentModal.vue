<template>
	<div :id="id" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cập nhật dịch vụ</h4>
				</div>
				<div class="modal-body">
					<form  class="form-horizontal" >
						<div class="form-group">
							<label class="col-sm-3 control-label">Tên dịch vụ: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text" required placeholder="Tên dịch vụ" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Giá tiền: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text"  placeholder="Giá tiền"  required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Thời gian: </label>
							<div class="col-sm-8">
								<div class="input-group mar-btm">
									<input type="text" placeholder="Thời gian" class="form-control">
									<span class="input-group-btn">	
										<button class="btn btn-primary" type="button">Tháng</button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Chương trình: </label>
							<div class="col-sm-8">
								<select name="" id="input" class="form-control" required="required">
									<option value="">Chương trình 1</option>
									<option value="">Chương trình 2</option>
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
	const ServiceComponentModal = {
		props:['id']
	}
	export default ServiceComponentModal;
</script>

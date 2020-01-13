<template>
	<div :id="id" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">21/10/2018 HomeWork1</h4>
				</div>
				<div class="modal-body">
					<form  class="form-horizontal" >
						<div class="form-group">
							<label class="col-sm-3 control-label">Tiêu đề: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Mô tả: </label>
							<div class="col-sm-8">
								<textarea class="form-control" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Trạng thái: </label>
							<div class="col-sm-8">
								<input class="form-control" type="text" required/>
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
	const PatientDetailHistoryComponent = {
		props:['id']
	}
	export default PatientDetailHistoryComponent;
</script>

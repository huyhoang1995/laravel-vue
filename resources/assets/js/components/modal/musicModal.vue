<template>
    <div class="modal fade" role="dialog" :id="id">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Item </h4>
                </div>
                <div class="modal-body">
                    <form data-parsley-validate class="form-horizontal" >
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name: </label>
                            <div class="col-sm-8">
                               test
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
    const musicModal = {
        props:['id'],
    }
export default musicModal;

</script>

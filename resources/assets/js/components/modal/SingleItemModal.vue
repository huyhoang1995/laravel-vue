    <template>
        <div class="modal fade" role="dialog" :id="id">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{data.title}} </h4>
                        <button type="button" class="close" data data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form data-parsley-validate class="form-horizontal" :id="formId">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name: </label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" v-model="data.name" required/>
                                    <span v-html="data.name"></span>

                                    <!-- <textarea class="form-control" name="" v-model="data.name" required></textarea> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Price : </label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="number" v-model="data.price"  min="1" max="9999" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Avatar: </label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="file" name="avatar"/>
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
    const singleItemModal = {
    props: ["id", "itemData", "retFunc"],
    created: function() {
        var app = this;
        this.$watch("itemData", function(newVal, oldVal) {
        app.data = Object.assign({}, newVal);
        });
    },
    data: function() {
        return {
            data: {},
            formId: myFunc.uniqueId(this.id)
        };
    },
    methods: {
        update: function() {
            if ($("#" + this.formId).parsley().validate()) {
                var avatar = $("input[name*=avatar]")[0].files[0];
                var param = service.itemService.data.insertUpdateData(
                this.data.name,
                this.data.price,
                avatar
                );
                var app = this;
                if (this.data.id > 0) {
                //thuc hien update
                service.itemService.action
                    .update(this.data.id, param)
                    .then(respData => {
                    console.log(respData);
                    app.retFunc(this.data.id);
                    })
                    .catch(function(err) {
                    console.log(err);
                    });
                } else {
                //thuc hien insert
                service.itemService.action
                    .insert(param)
                    .then(respData => {
                    console.log(respData);
                    app.retFunc();
                    })
                    .catch(function(err) {
                    console.log(err);
                    });
                }
            }
        }
    }
};

export default singleItemModal;
</script>

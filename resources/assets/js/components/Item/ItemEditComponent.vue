<template>
    <div>
        <router-link to="/item" class="btn btn-default" >back</router-link>


        <form data-parsley-validate class="form-horizontal" :id="formId" >
            <div class="col-md-12">
                <label >Name: </label>
                <div>
                    <!-- <textarea name="" id="" v-model="data.name"  required></textarea> -->
                    <!-- <input class="form-control" type="text" v-model="data.name"  required/> -->
                    <!-- <vue-ckeditor v-model="data.name"  required  :config="config" @blur="onBlur($event)" @focus="onFocus($event)" /> -->
                    <check-editor :mydata="data.name" :ret-data="getDataEditor"></check-editor>
                    <!-- <div>
                        <p v-for="(item, key) in validate.name" :key="key">
                            {{item}}
                        </p>
                    </div> -->
                </div>
            </div>
            <div class="col-md-12">
                <label >Price : </label>
                <div>
                    <input class="form-control" type="number" v-model="data.price"  min="1" max="9999" required/>
                </div>
            </div>
            <div class="col-md-12">
                <label >Avatar: </label>
                <div >
                    <input class="form-control" type="file" name="avatar"/>
                    <img style="width:200px;height:200px" v-bind:src="'./images/'+ data.avatar" alt="">
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-success" @click="update()">Cập nhật</button>
            </div>
        </form>
    </div>
</template>

<script>
    // import VueCkeditor from "vue-ckeditor2";

    export default {
        props:['id'],
        // components: { VueCkeditor },
        mounted(){
            this.getData(); 
        },
        data() {
            return {
                data: {
                    id: 0,
                    name: "",
                    price: 0,
                    avatar: ""
                },

            //bắt lỗi dành cho ckeditor
            validate:{
                name:""
            },
            formId: myFunc.uniqueId(this.id),

        };
    },
    methods: {
        getData(){
            let app = this;
            let id = app.$route.params.id;
            service.itemService.action.singleItem(id)
            .then(resData=>{
                app.data = resData.data;
            })
            .catch(err=>{
                console.log(err);
            })
        },
        update(){
            if ($('#' + this.formId).parsley().validate()) {
                var avatar = $('input[name*=avatar]')[0].files[0];
                var param = service.itemService.data.insertUpdateData(
                    this.data.name,
                    this.data.price,
                    avatar
                    );
                var app =this;
                service.itemService.action.update(this.data.id, param).then((resData)=>{
                    myNotify.success("Cập nhật thành công");
                    app.getData();
                    console.log(resData);
                    // window.location.href('/item');
                })
                .catch((err)=>{
                    myNotify.err("Cập nhật thất bại");
                    app.validate = err;
                    console.log(err.name);  
                    console.log(err);
                })
            }
        },
        getDataEditor: function(data) {
            this.data.name = data;
        },
    },
    components: { 
        checkEditor: require("@component/config/checkEditor.vue")
    },
};

</script>
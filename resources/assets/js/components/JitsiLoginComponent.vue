<template>
    <div class="row col-sm-12">
        <div class="welcome">
            <div class="box-enter">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form v-enter="loginJitsi">
                            <legend class="col-md-12">Start a new meeting</legend>
                            <span class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" placeholder="Nhập tên" v-model="nameRoom">
                                </div>
                            </span>
                            <span class="col-md-2">
                                <a href="javascript:void(0)" class="btn btn-primary" @click="loginJitsi()">JOIN ROOM</a>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</template>
<script>


export default {
    mounted() {
        
    },
    data: function() {
        return {
            nameRoom: ""
        }
        
    },
    methods: {
        loginJitsi:function(){
            console.log(this.nameRoom);
            // window.location.href= siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom ;
            // window.open(siteUrl + '/videoJitsi?nameRoom=' + this.nameRoom);
            // window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, "myWindow", "width='100%',height='100%'");
            var win = window.open(siteUrl + '/test?nameRoom=' + this.nameRoom, '_blank');
            // win.focus();
        }
    },
    components: {
    }
};
</script>

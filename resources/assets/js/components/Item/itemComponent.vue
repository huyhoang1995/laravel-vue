<template>
    <div class="row col-sm-12">
        <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class>Item list || {{ $t("message.hello") }}</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        </div>

        <div class="col-md12 col-sm-12 eq-box-sm">
        <div class="panel">
            <div class="panel-body">
            <button
                class="btn btn-info pull-right"
                v-show="!active"
                @click="changeLanguage('en')"
            >tiếng anh</button>
            <button
                class="btn btn-success pull-right"
                v-show="active"
                @click="changeLanguage('vn')"
            >tiếng việt</button>
            <br />
            <br />
            <button class="btn btn-info" @click="showModal()">Thêm mới</button>
            <div class="pull-right">
                <form v-on:submit="fillter()">
                <input type="text" placeholder="nhập tên item" v-model="filter.name" />
                <button class="btn btn-success">tìm kiếm</button>
                </form>
            </div>
            <div class>
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>STT</th>
                    <th>{{ $t("message.name") }}</th>
                    <th>{{ $t("message.price") }}</th>
                    <th>{{ $t("message.image") }}</th>
                    <th>{{ $t("message.action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,key) in listData" :key="key">
                    <td>{{showOrder(key)}}</td>
                    <td>
                        <span v-html="item.name"></span>
                    </td>
                    <td>{{item.price}}</td>
                    <td>
                        <img style="width:100px;height:100px" v-bind:src="'./images/'+ item.avatar" alt />
                    </td>
                    <td>
                        <a
                        href="javascript:void(0)"
                        class="btn btn-primary btn-icon btn-circle fa fa-pencil-square-o"
                        @click="showModal(item)"
                        ></a>
                        <a
                        href="javascript:void(0)"
                        class="btn btn-danger btn-icon btn-circle fa fa-trash"
                        @click="deleteItem(item.id)"
                        ></a>
                        <router-link
                        :to="{name: 'itemEdit', params: {id: item.id}}"
                        class="btn btn-info btn-icon btn-circle fa fa-paper-plane-o"
                        ></router-link>
                    </td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <pagination
                        :pagination="filter.pagination"
                        :callback="listItem"
                        :options="filter.paginationOptions"
                    ></pagination>
                </div>
            </div>
            <single-item-modal
                :id="singleModal.id"
                :item-data="singleModal.data"
                :ret-func="successFunc"
            ></single-item-modal>
            </div>
        </div>
        </div>
    </div>
</template>

<script>

export default {
    // name: 'Tiếng việt',
    mounted() {
        this.listItem();
        
    },
    data: function() {
        return {
            active: false,
            startDate: "2017-09-05",
            endDate: "2017-09-15",
            locale: {
                direction: "ltr", //direction of text
                format: "DD-MM-YYYY", //fomart of the dates displayed
                separator: " - ", //separator between the two ranges
                applyLabel: "Apply",
                cancelLabel: "Cancel",
                weekLabel: "W",
                customRangeLabel: "Custom Range",
                daysOfWeek: moment.weekdaysMin(), //array of days - see moment documenations for details
                monthNames: moment.monthsShort(), //array of month names - see moment documenations for details
                firstDay: 1 //ISO first day of week - see moment documenations for details
            },
            listData: [],
            filter: {
                // phân trang
                pagination: {
                total: 0,
                per_page: 5, // required
                current_page: 1, // required
                last_page: 0, // required
                from: 1,
                to: 1
                },
                paginationOptions: {
                offset: 4,
                previousText: "<",
                nextText: ">",
                alwaysShowPrevNext: true
                },
                name: ""
            },
            singleModal: {
                id: "singleItemModal",
                data: {
                    id: 0,
                    name: "",
                    price: 0,
                    avatar: "",
                    title: ""
                }
            }
        };
    },
    methods: {
    
        changeLanguage: function(data) {
            this.active = !this.active;

            this.$i18n.locale = data;
            localStorage.setItem("lang", data);
        },
        //danh sách item
        listItem: function() {
            var app = this;
            var param = service.itemService.data.list(
                this.filter.name,
                this.filter.pagination.current_page,
                this.filter.pagination.per_page
            );

            service.itemService.action.list(param).then(resData => {
                //data
                app.listData = resData.data.data;
                //pagination
                app.filter.pagination.total = resData.data.total;
                app.filter.pagination.from = resData.data.from;
                app.filter.pagination.to = resData.data.to;
                app.filter.pagination.last_page = resData.data.last_page;
            }).catch(err => {
                console.log(err);
            });
        },
        //xóa item
        deleteItem: function(id) {
            var app = this;
            myBootbox.confirm("Bạn có muốn xóa Item này không", function(result) {
                if (result) {
                service.itemService.action.delete(id).then(() => {
                    myNotify.success("Xóa thành công");
                    app.listItem();
                    })
                    .catch(err => {
                    console.log(err);
                    });
                }
            });
        },
        //hiển thị stt
        showOrder: function(index) {
            return ( index + 1 + (this.filter.pagination.current_page - 1) * this.filter.pagination.per_page );
        },
        //tìm kiếm
        fillter: function() {
            this.filter.pagination.current_page = 1;
            var app = this;
            app.listItem(this.filter.pagination.current_page);
        },
        //hiển thị modal
        showModal: function(item) {
            this.singleModal.data = item ? item : this.resetForm();
            if (item) {
                this.singleModal.data.title = "Cập nhật item";
            } else {
                this.singleModal.data.title = "Thêm mới item";
            }
            $("#" + this.singleModal.id).modal("show");
        },
        resetForm: function() {
            return {
                id: 0,
                name: "",
                price: 0,
                avatar: ""
            };
        },
        //nhận kết quả từ modal
        successFunc: function(id) {
            $("#" + this.singleModal.id).modal("hide");
            if (id) {
                myNotify.success("Cập nhật thành công");
            } else {
                myNotify.success("Thêm mới thành công");
            }
            this.listItem();
        }
    },
    components: {
        singleItemModal: require("@component/modal/SingleItemModal.vue")
    }
};
</script>

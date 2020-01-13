<template>
  <div class="modal fade" role="dialog" id="uploadModal">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hình ảnh</h4>
        </div>
        <div class="modal-body">
          <form data-parsley-validate class="form-horizontal">
            <div class="form-group pad-ver">
              <!-- <label class="col-md-3 control-label">Danh sách</label> -->
              <div class="col-md-12">
                <!-- Radio Buttons -->
                <img :src="image" style="width: 100% !important" />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="uploadImages()">Tải lên</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const UploadModal = {
  props: ["dataImage", "idRoom", "retFuncUpload"],
  created: function() {
    var app = this;

    this.$watch("dataImage", function(newVal, oldVal) {
      app.nameImages = newVal.name;
      app.dataFile = newVal;
      app.createImage(newVal);
    });
  },
  data: function() {
    return {
      dataFile: "",
      listRoom: [],
      image: "",
      id: "",
      content_uri: "",
      nameImages: ""
    };
  },
  methods: {
    createImage(file) {
      this.createFileUploadUrl(file);

      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    createFileUploadUrl: function(data) {
      myLoader.show();

      //   console.log(e);
      //   var files = e.target.files || e.dataTransfer.files; files == content
      //   var content = $("input[name*=images]")[0].files[0];
      //   console.log(content, "uploadcommon load");

      var param = service.matrixService.data.uploadFileCommon(data);
      service.matrixService.action
        .uploadFileCommon(param)
        .then(result => {
          this.content_uri = result.data.content_uri;
          console.log(result);
          //   myLoader.hide();
        })
        .catch(err => {
          console.log(err);
          myLoader.hide();
        });
    },
    uploadImages: function() {
      var param = service.matrixService.data.uploadImages(
        this.idRoom,
        this.nameImages,
        this.content_uri
      );
      var app = this;
      service.matrixService.action
        .uploadImages(param)
        .then(result => {
          if (result.data.event_id) {
            app.retFuncUpload();
          }
          console.log(result);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};

export default UploadModal;
</script>

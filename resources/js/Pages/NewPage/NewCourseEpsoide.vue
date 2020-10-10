<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">اضافة دورة جديدة</h4>
            </template>
           <template slot="default">
               <form @submit="formSubmit" enctype="multipart/form-data">
               <div class="formis">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="name_ar">الاسم بالعربي</label>
                                   <input type="text" v-model="form.name_ar" class="form-control" id="name_ar">
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group"><label for="name_en">الاسم بالانجليزي</label>
                                    <input type="text" class="form-control" v-model="form.name_en" id="name_en">
                               </div>
                           </div>
                       </div>
                       <div style="height:20px;"></div>
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                    <label for="description_ar">الوصف بالعربي</label>
                                    <textarea name="description_ar" id="description_ar" v-model="form.description_ar" class="form-control" rows="5"></textarea>
                               </div>
                               
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                    <label for="description_en">الوصف بالانجليزي</label>
                                    <textarea id="description_en" rows="5" class="form-control" v-model="form.description_en"></textarea>
                               </div>
                               
                           </div>
                       </div>
                       <div style="height:20px;"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration">المدة</label>
                                    <input type="text" class="form-control" id="duration" v-model="form.duration">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">صورة الغلاف</label>
                                    <input type="file" id="image" v-on:change="onFileChange" ref="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">الفيديو</label>
                                    <input type="file" id="video" v-on:change="onVideoChange"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="error">
                            <div class="col-md-12">
                                <div class="error">
                                    يوجد خطا في الحقول الرجاء التاكد منها
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                   </div>
               </div>
               <div v-if="uploadProgress !== 0">
                   {{uploadProgress}}
               </div>
                                <button class="btn btn-success btn-block">حفظ المعلومات</button>
               </form>
           </template>
          </card>
        </div>
      </div>
    </div>
    <loader v-if="show_loader" />
  </div>
</template>
<script>
  import Card from '../../components/Cards/Card.vue'
  import loader from '../../components/loader.vue';
  export default {
    components: {
      Card,
      loader
    },
    data () {
      return {
          form:{},
          uploadProgress: 0,
          show_loader:false,
          error:false
      }
    },
    computed: {
        config () {
            return {
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: progressEvent => {
                this.uploadProgress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
            }
            };
        },
    },
    methods: {
        onFileChange(e) {
        let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
        this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.form.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        openImage() {
            const vm = this;
            vm.$refs.image.click();
        },
        onVideoChange(e) {
            this.form.video = e.target.files[0];
        },
        formSubmit(e) {
            const vm = this;
            vm.show_loader = true;
            vm.error = false;
            e.preventDefault();
            let currentObj = this;

            const config = {
               headers: { 'content-type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2) }
            }

            let formData = new FormData();
            formData.append('video', vm.form.video);
            formData.append('image', vm.form.image);
            formData.append('name_ar', vm.form.name_ar);
            formData.append('name_en', vm.form.name_en);
            formData.append('duration', vm.form.duration);
            formData.append('description_ar', vm.form.description_ar);
            formData.append('course_id', vm.$route.params.id);
            formData.append('description_en', vm.form.description_en);

            axios.post('admin/course/epsoide/store',formData,vm.config).then(response => {
                
                vm.show_loader = false;
                vm.error = false;
                confirm('تمت الاضافة بنجاح') && 

                location.reload();
            }).catch(err => {
                console.log(err.response)
                vm.show_loader = false;
                vm.error = true;
            });


        }
    }
  }
</script>
<style scoped>
.fileInput{position: fixed; left:-99999px;}
.error {color:red; font-weight: 700;}
</style>

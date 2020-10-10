<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">اضافة اختبار جديدة</h4>
            </template>
           <template slot="default">
               <div class="formis">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="title_ar">السوال بالعربي</label>
                                   <input type="text" v-model="form.title_ar" class="form-control" id="title_ar">
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group"><label for="title_en">السوال بالانجليزي</label>
                                    <input type="text" class="form-control" v-model="form.title_en" id="title_en">
                               </div>
                           </div>
                       </div>
                       <div style="height:20px;"></div>
                        <div class="row" v-if="error">
                          <div class="col-md-12">
                            <div class="error">
                              الرجاء التاكد من الحقول
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block" @click="store">حفظ المعلومات</button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                   </div>
               </div>
           </template>
          </card>
        </div>
      </div>
    </div>
    <loader v-if="show_loader"></loader>
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
          show_loader:false,
          error:false
      }
    },
    methods: {
        store() {
            const vm = this;
            vm.show_loader = true;
            vm.error = false;
            vm.form.quiz_id = vm.$route.params.id
            axios.post('admin/quiz/question/store',vm.form).then(response => {
              vm.show_loader = false;
            vm.error = false;

                confirm('Added Success') && 

                location.reload();
            }).catch(err => {
              vm.show_loader = false;
            vm.error = true;
                console.log(err.response)
            });
        }
    }
  }
</script>
<style scoped>
.fileInput{position: fixed; left:-99999px;}
.error {color:red;font-weight: 700;}
</style>

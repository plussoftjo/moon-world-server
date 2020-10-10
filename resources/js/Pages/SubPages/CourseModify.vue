<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">معلومات الدورة</h4>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th v-for="column in columns" :key="column">{{column}}</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr >
                  <td>{{data.id}}</td>
                  <td>{{data.name_ar}}</td>
                  <td>{{data.name_en}}</td>
                  <td>{{data.description_ar}}</td>
                  <td>{{data.description_en}}</td>
                  <td>{{data.price}}</td>
                  <td><img :src="'/' + data.image" width="50" height="50"/></td>
                  <td><div style="color:green;font-weight:700;cursor:pointer;" @click="$router.push({name:'CourseEdit',params:{id:data.id}})">Edit</div></td>
                  <td><div style="color:red;font-weight:700;cursor:pointer;" @click="remove()">Delete</div></td>
              </tr>
              </tbody>
            </table>
          </card>

        <!-- Course Epsoide  -->
        <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
        <template slot="header">
            <h4 class="card-title">حلقات الدورة</h4>
            <p>يمكنك اضافة حلقات للدورة من هنا</p>
              <a class="btn btn-info" :href="'#/admin/NewCourseEpsoide/' + $route.params.id">اضافة حلقة جديدة</a>
        </template>
        <table class="table">
            <thead>
            <slot name="columns">
                <tr>
                    <th v-for="column in columns" :key="column">{{column}}</th>
                    <th>Delete</th>
                </tr>
            </slot>
            </thead>
            <tbody>
            <tr v-for="(item,index) in data.course_epsoide" :key="index">
                <td>{{item.id}}</td>
                <td>{{item.name_ar}}</td>
                <td>{{item.name_en}}</td>
                <td>{{item.description_ar}}</td>
                <td>{{item.description_en}}</td>
                <td>{{item.duration}}</td>
                <td><img :src="'/' + item.image" width="50" height="50"/></td>
                <td><video class="embed-responsive embed-responsive-16by9" controls>
                <source  :src="item.video" type="video/mp4">
                Your browser does not support HTML5 video.
                </video></td>
                <td><div style="color:red;font-weight:700;cursor:pointer;" @click="removeEpsoide(item.id)">Delete</div></td>
            </tr>
            </tbody>
        </table>
        </card>
        <!-- Course epsoide end -->

        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import LTable from '../../components/Table.vue'
  import Card from '../../components/Cards/Card.vue'
  const tableColumns = ['id', 'name_ar', 'name_en', 'description_ar','description_en', 'duration','image']
  export default {
    components: {
      LTable,
      Card
    },
    data () {
      return {
          columns: [...tableColumns],
          data: []
      }
    },
    methods: {
      install() {
        const vm = this;
        axios.get('admin/course/show/' + vm.$route.params.id).then(response => {
          vm.data= response.data;
        }).catch(err => {
          console.log(err.response)
        });
      },
      remove() {
        const vm = this;
        axios.get('admin/course/remove/' + vm.$route.params.id).then(response => {
          confirm('هل تريد الحذف ؟') && 

          vm.$router.push({name:'الدورات'});
        }).catch(err => {
          console.log(err)
        });
      },
      removeEpsoide(id) {
        const vm = this;
        axios.get('admin/course/epsoide/remove/' + id).then(response => {
          confirm('هل تريد حذف الحلقة ؟؟') && 

          location.reload()
        }).catch(err => {
          console.log(err)
        });
      }
    },
    created() {
      const vm = this;
      vm.install();
    }
  }
</script>
<style>
</style>

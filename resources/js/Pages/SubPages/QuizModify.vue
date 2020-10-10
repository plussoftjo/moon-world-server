<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">معلومات الاختبار</h4>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th v-for="column in columns" :key="column">{{column}}</th>
                    <th>EDIT</th>
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
                  <td><div style="color:green;font-weight:700;cursor:pointer;" @click="$router.push({name:'QuizEdit',params:{id:data.id}})">EDIT</div></td>
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
            <h4 class="card-title">اسئلة الاختبار</h4>
            <p>يمكنك اضافة اسئلة للاختبار من هنا</p>
              <a class="btn btn-info" :href="'#/admin/NewQuizQuestion/' + $route.params.id">اضافة سوال جديد</a>
        </template>
        <table class="table">
            <thead>
            <slot name="columns">
                <tr>
                    <th>id</th>
                    <th>name-ar</th>
                    <th>name-en</th>
                    <th>Delete</th>
                </tr>
            </slot>
            </thead>
            <tbody>
            <tr v-for="(item,index) in data.quiz_question" :key="index">
                <td>{{item.id}}</td>
                <td>{{item.title_ar}}</td>
                <td>{{item.title_en}}</td>
                <td><div style="color:red;font-weight:700;cursor:pointer;" @click="removeQuestion(item.id)">Delete</div></td>
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
  const tableColumns = ['id', 'title_ar', 'title_en','description_ar','description_en','price','image']
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
        axios.get('admin/quiz/show/' + vm.$route.params.id).then(response => {
          vm.data= response.data;
        }).catch(err => {
          console.log(err.response)
        });
      },
      remove() {
        const vm = this;

        confirm('هل تريد الحذف ؟ ') &&
        axios.get('admin/quiz/remove/' + vm.$route.params.id).then(response => {
          vm.$router.push({name:'الاختبارات'});
        });
      },
      removeQuestion(id) {
        const vm = this;

        confirm('هل تريد الحذف ؟') &&

        axios.get('admin/quiz/question/remove/' + id).then(response => {
          location.reload();
}).catch(err => {
          console.log(err.response)
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

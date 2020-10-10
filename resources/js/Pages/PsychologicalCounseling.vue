<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">قائمة الاستشارات</h4>
              <p class="card-category">يمكنك اضافة وتعديل الاستشارات واسعارها من خلال القائمة هنا </p>
              <a class="btn btn-info" href="#/admin/newPsychologicalCounseling">نوع استشارة جديد</a>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th v-for="column in columns" :key="column">{{column}}</th>
                    <th>Edit</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <slot :row="item">
                  <td v-for="column in columns" :key="column" v-if="hasValue(item, column)">
                    <div v-if="column == 'image'">
                      <img :src="'/' + itemValue(item, column)" width="50" height="50"/>
                    </div>
                    <div v-else>
                      {{itemValue(item, column)}}
                    </div>
                  </td>
                  <td>
                    <span style="color:red;font-weight:700;cursor:pointer;" @click="remove(item.id)">حذف</span>
                    <span style="width:10px;"> </span>
                  <span style="color:green;font-weight:700;cursor:pointer;" @click="$router.push({name:'PsychologicalCounselingEdit',params:{id:item.id}})">تعديل</span>
                  </td>
                </slot>
              </tr>
              </tbody>
            </table>
          </card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import LTable from '../components/Table.vue'
  import Card from '../components/Cards/Card.vue'
  const tableColumns = ['id', 'name_ar', 'name_en', 'description_ar','description_en', 'price','image']
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
      hasValue (item, column) {
        return item[column.toLowerCase()] !== 'undefined'
      },
      itemValue (item, column) {
        return item[column.toLowerCase()]
      },
      install() {
        const vm = this;
        axios.get('admin/psychologicalcounseling/index').then(response => {
          vm.data = response.data;
        }).catch(err => {
          console.log(err.response)
        });
      },
      remove(id) {
        const vm = this;
          confirm('هل تريد الحذف ؟ ') && 
          axios.get('admin/psychologicalcounseling/remove/' + id).then(response => {
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

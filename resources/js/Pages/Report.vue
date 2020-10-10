<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <span class="nav-link" :class="state == 0 ? 'active_tab':'not_active'" @click="state = 0;">الاستشارات النفسية</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" :class="state == 1 ? 'active_tab':'not_active'" @click="state = 1;">الدورات</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" :class="state == 2 ? 'active_tab':'not_active'" @click="state = 2;">المتجر</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" :class="state == 3 ? 'active_tab':'not_active'" @click="state = 3;">الاختبارات</span>
                            </li>
                        </ul>
                    </card>
                    <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
                        <PsychologicalCounselingReport v-if="state == 0" />
                        <CourseReport v-if="state == 1" />
                        <ShopReport v-if="state == 2" />
                        <QuizReport v-if="state == 3" />
                       
                    </card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import Card from '../components/Cards/Card.vue';
  import PsychologicalCounselingReport from './ReportPages/PsychologicalCounselingReport.vue';
  import CourseReport from './ReportPages/CourseReport.vue';
  import ShopReport from './ReportPages/ShopReport.vue';
  import QuizReport from './ReportPages/QuizReport.vue';
export default {
    components: {
      Card,
      PsychologicalCounselingReport,
      CourseReport,
      ShopReport,
      QuizReport
     
    },
    data() {
        return {
            state:0
        }
    }
}
</script>
<style>
    .active_tab{color:blue;}
    .nav-link:hover{color:cadetblue;}
    .nav-link{cursor: pointer;font-weight: 800;font-size: 18px;}
</style>
<template>
    <div class="sectionaShow" v-if="show">
        <div class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <card class="strpied-tabled-with-hover"
                    body-classes="table-full-width table-responsive">
                        <!-- Show The Order Info  -->

                        <div class="order-info">
                        <h3 style="font-weight:900;text-align:center!important;">معلومات الطلب</h3>
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>اسم الاختبار</th>
                                    <th>ألسعر</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{item.id}}</td>
                                    <td>{{item.quiz.name_ar}}</td>
                                    <td>{{item.price}}KWD</td>
                                    <td>
                                        <div v-if="item.state == 0" style="color:blue;font-weight:700;">في الانتظار</div>
                                        <div v-if="item.state == 1" style="font-weight:700;color:green;">تم ارسال الاجابات</div>
                                        <div v-if="item.state == 2" style="font-weight:700;color:green;">تم ارسال النتيجة</div>
                                    </td>
                                    <td>{{item.created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <!-- End The Order Info  -->
                        <hr/>
                        <!-- Show The User Info  -->

                        <div class="order-info">
                        <h3 style="font-weight:900;text-align:center!important;">معلومات المستخدم</h3>
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>الاسم</th>
                                    <th>رقم الهاتف</th>
                                    <th>تاريخ التسجيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.phone}}</td>
                                    <td>{{item.created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <!-- End The User Info  -->


                        <hr/>
                        <!-- Show The Awnser Info  -->

                        <div class="order-info" v-if="quiz_awnser.length !== 0">
                        <h3 style="font-weight:900;text-align:center!important;">اجوبة الاختبار</h3>
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>ألسوال</th>
                                    <th>الجواب</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in quiz_awnser" :key="index">
                                    <slot :row="item">
                                        <td>#{{item.id}}</td>
                                        <td>{{item.question}}</td>
                                        <td>{{item.awnser}}</td>
                                    </slot>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <!-- End The Awnser Info  -->


                    </card>

                    <Card class="strpied-tabled-with-hover"
                    body-classes="table-full-width table-responsive"
                    v-if="quiz_awnser.length !== 0">
                           <h3 class="header-title" style="font-weight:900;text-align:center!important;">ارسال الرد</h3>
                           <hr/>
                           <div class="form-group">
                               <textarea class="form-control" rows="5" placeholder="ادخل محتوى الرسالة" v-model="inpt"></textarea>
                           </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block" @click="send_result">ارسال</button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                    </Card>
                </div>
            </div>
        </div>  
    </div>    
</template>
<script>
import Card from '../../components/Cards/Card.vue';
export default {
    components:{
        Card,
    },
    data() {
        return {
            item:{quiz:{}},
            user:{},
            show:false,
            quiz_awnser:[],
            inpt:''
        }
    },
    methods:{
        install () {
            const vm = this;
            axios.get('admin/process/quiz/show/' + vm.$route.params.id).then(response => {
                vm.item = response.data.quiz_ticket;
                vm.user = response.data.user;
                vm.quiz_awnser = response.data.quiz_awnser;
                vm.show = true;
            }).catch(err => {
                console.log(err)
            });
        },
        send_result() {
            const vm = this;
            axios.post('admin/process/quiz/send_result',{quiz_id:vm.item.quiz_id,awnser:vm.inpt,user_id:vm.user.id,id:vm.item.id}).then(response => {
                confirm('تم ارسال النتيجة') &&

                location.reload();
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
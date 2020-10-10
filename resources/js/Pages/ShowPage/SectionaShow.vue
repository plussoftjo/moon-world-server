<template>
    <div class="sectionaShow">
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
                                    <th>اسم الاستشارة</th>
                                    <th>ألسعر</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{item.id}}</td>
                                    <td>{{item.psychologicalcounseling.name_ar}}</td>
                                    <td>{{item.price}}KWD</td>
                                    <td>
                                        <div v-if="item.state == 0" style="color:blue;font-weight:700;">في الانتظار</div>
                                        <div v-if="item.state == 1" style="font-weight:700;color:green;">تم التاكيد</div>
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


                    </card>

                    <Card class="strpied-tabled-with-hover"
                    body-classes="table-full-width table-responsive">
                           <h3 class="header-title" style="font-weight:900;text-align:center!important;">محادثة مباشرة</h3>
                           <hr/>
                        <chat :id="item.id" :user_id="user.id" :state="item.state" />
                    </Card>
                </div>
            </div>
        </div>  
    </div>    
</template>
<script>
import Card from '../../components/Cards/Card.vue';
import chat from './sectionaParts/chat.vue';
export default {
    components:{
        Card,
        chat
    },
    data() {
        return {
            item:{psychologicalcounselings:{}},
            user:{}
        }
    },
    methods:{
        install () {
            const vm = this;
            axios.get('admin/process/sectiona/show/' + vm.$route.params.id).then(response => {
                vm.item = response.data.sectiona;
                vm.user = response.data.user;
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
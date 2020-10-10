<template>
            <div class="mesgs">
          <div class="msg_history">

              <div v-for="(item,index) in data" :key="index">
                  <div class="incoming_msg" v-if="item.sender == 1">
                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                    <div class="received_msg">
                        <div class="received_withd_msg">
                        <p>{{item.message}}</p>
                        <span class="time_date"> {{item.created_at}}</span></div>
                    </div>
                  </div>
                  <div class="outgoing_msg" v-if="item.sender == 2">
                    <div class="sent_msg">
                        <p>{{item.message}}</p>
                        <span class="time_date"> {{item.created_at}}</span></div>
                   </div>
              </div>

          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" v-model="inpt" v-on:keyup.enter="store" />
              <button class="msg_send_btn" type="button" @click="store">></button>
            </div>
          </div>
        </div>
</template>
<script>
export default {
    props:['id','user_id','state'],
    data() {
        return {
            data:[],
            inpt:''
        }
    },
    methods:{
        install () {
            const vm = this;
            axios.get('admin/process/sectiona/fetch_messages/' + vm.id).then(response => {
                vm.data = response.data;
                setTimeout(() => {
                document.querySelector(".msg_history").scrollTo(0,document.querySelector(".msg_history").scrollHeight);
                },100);
            }).catch(err => {
                console.log(err)
            });
        },
        store() {
            const vm = this;
            let inpt = vm.inpt;
            vm.data.push({user_id:vm.user_id,sectiona_ticket_id:vm.id,sender:2,message:inpt,created_at:new Date()});
            vm.inpt = '';
            setTimeout(() => {
                document.querySelector(".msg_history").scrollTo(0,document.querySelector(".msg_history").scrollHeight);
                },100);
            axios.post('admin/process/sectiona/admin_send_message',{user_id:vm.user_id,sectiona_ticket_id:vm.id,message:inpt}).then(response => {

            }).catch(err => {
                console.log(err)
            });

            if(vm.state == 0) {
                axios.get('admin/process/sectiona/change_state/' + vm.id).then(response => {
                    vm.state = 1;
                }).catch(err => {
                    console.log(err)
                });
            }
        }
    },
    created() {
        const vm = this;
        vm.install();
    }
}
</script>
<style scoped>
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>
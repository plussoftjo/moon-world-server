import DashboardLayout from '../layout/DashboardLayout.vue'
// GeneralViews
import NotFound from '../pages/NotFoundPage.vue'

// Admin pages
import Overview from '../Pages/Overview.vue'



//Pages 
import PsychologicalCounseling from '../pages/PsychologicalCounseling.vue';
import PsychologicalCounselingNew from '../pages/NewPage/PsychologicalCounselingNew.vue';
import PsychologicalCounselingEdit from '../Pages/EditPage/PsychologicalCounselingEdit.vue';

import Courses from '../pages/Courses.vue';
import NewCourse from '../Pages/NewPage/NewCourse.vue';
import CourseModify from '../Pages/SubPages/CourseModify.vue';
import NewCourseEpsoide from '../Pages/NewPage/NewCourseEpsoide.vue';
import CourseEdit from '../Pages/EditPage/CourseEdit.vue';

import Quiz from '../Pages/Quiz.vue';
import NewQuiz from '../Pages/NewPage/NewQuiz.vue';
import NewQuizQuestion from '../Pages/NewPage/NewQuizQuestion.vue';
import QuizModify from '../Pages/SubPages/QuizModify.vue';
import QuizEdit from '../Pages/EditPage/QuizEdit.vue';


import Store from '../Pages/Store.vue';
import NewCategory from '../Pages/NewPage/NewCategory.vue';
import NewItems from '../Pages/NewPage/NewItems.vue';
import ShopCategoryEdit from '../Pages/EditPage/ShopCategoryEdit.vue';
import ItemsEdit from '../Pages/EditPage/ItemsEdit.vue';
import OrderShow from '../Pages/ShowPage/OrderShow.vue';

import Report from '../Pages/Report.vue';
import Process from '../Pages/Process.vue';

/** Process Routes */
import SectionaShow from '../Pages/ShowPage/SectionaShow.vue';
import QuizShow from '../Pages/ShowPage/QuizShow.vue';

import Users from '../Pages/Users.vue';

import chat from '../Pages/chat.vue';

const routes = [
  {
    path: '/',
    component: DashboardLayout,
    redirect: '/admin/overview'
  },
  {
    path: '/admin',
    component: DashboardLayout,
    redirect: '/admin/overview',
    children: [
      {
        path: 'overview',
        name: 'Overview',
        component: Overview
      },
      {
        path:'PsychologicalCounseling',
        name:'الاستشارات',
        component:PsychologicalCounseling
      },
      {
        path:'newPsychologicalCounseling',
        name:'استشارة جديدة',
        component:PsychologicalCounselingNew
      },
      {
        path:'Courses',
        name:'الدورات',
        component:Courses
      },
      {
        path:'NewCourses',
        name:'دورة جديدة',
        component:NewCourse
      },
      {
        path:'Quiz',
        name:'الاختبارات',
        component:Quiz
      },
      {
        path:'NewQuiz',
        name:'اختبار جديد',
        component:NewQuiz
      },
      {
        path:'CourseModify/:id',
        name:'معلومات الدورة',
        component:CourseModify
      },
      {
        path:'NewCourseEpsoide/:id',
        name:'اضافة حلقة جديدة',
        component:NewCourseEpsoide
      },
      {
        path:'NewQuizQuestion/:id',
        name:'اضافة سوال جديد',
        component:NewQuizQuestion
      },
      {
        path:'QuizModify/:id',
        name:'الاختبار',
        component:QuizModify
      },
      {
        path:'Store',
        name:'المتجر',
        component:Store
      },
      {
        path:'NewCategory',
        name:'اضافة فئة',
        component:NewCategory
      },
      {
        path:'NewItems',
        name:'مادة جديدة',
        component:NewItems
      },
      {
        path:'chat',
        name:'الدردشة',
        component:chat
      },
      {
        path:'PsychologicalCounselingEdit/:id',
        name:'PsychologicalCounselingEdit',
        component:PsychologicalCounselingEdit
      },
      {
        path:'CourseEdit/:id',
        name:'CourseEdit',
        component:CourseEdit
      },
      {
        path:'QuizEdit/:id',
        name:'QuizEdit',
        component:QuizEdit
      },
      {
        path:'ShopCategoryEdit/:id',
        name:'ShopCategoryEdit',
        component:ShopCategoryEdit
      },
      {
        path:'ItemsEdit/:id',
        name:'ItemsEdit',
        component:ItemsEdit
      },
      {
        path:'OrderShow/:id',
        name:'OrderShow',
        component:OrderShow
      },
      {
        path:'Report',
        name:'Report',
        component:Report
      },
      {
        path:'Process',
        name:'Process',
        component:Process
      },
      {
        path:'SectionaShow/:id',
        name:'SectionaShow',
        component:SectionaShow
      },
      {
        path:'QuizShow/:id',
        name:'QuizShow',
        component:QuizShow
      },
      {
        path:'Users',
        name:'Users',
        component:Users
      }
    ]
  },
  { path: '*', component: NotFound }
]

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes

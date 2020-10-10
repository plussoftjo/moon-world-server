import VTooltip from 'v-tooltip'
// Notifications plugin
import Notifications from './components/NotificationPlugin'
// A plugin file where you could register global components used across the app
import GlobalComponents from './globalComponents'
// A plugin file where you could register global directives
import GlobalDirectives from './globalDirectives'
// Sidebar on the right. Used as a local plugin in DashboardLayout.vue
import SideBar from './components/SidebarPlugin'

export default {
  install (Vue) {
    Vue.use(GlobalComponents)
    Vue.use(GlobalDirectives)
    Vue.use(SideBar)
    Vue.use(Notifications)
    Vue.use(VTooltip)
  }
}

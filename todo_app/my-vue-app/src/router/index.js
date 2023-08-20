import {createRouter, createWebHashHistory} from 'vue-router';


const routes = [
   {
    path:'/',
    name:'Todo',
    component:TodoComponent
   }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
  
})

export default router

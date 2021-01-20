import VueRouter from "vue-router";
import homeComp from "./components/ExampleComponent.vue";
import SecondComp from "./components/Example2.vue";
import Bookables from "./bookables/bookables.vue";
const routes = [
    {
        path: "/",
        component:Bookables,
        name: "home"
    },

    {
        path: "/second",
        component:SecondComp,
        name: "second"
    }
]

const router = new VueRouter({
    routes,
    mode: "history"
})

export default router;

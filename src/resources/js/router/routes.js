
const Home = { template: '<div>Home</div>' }
const routes = [
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: () => import("@/views/error/NotFound.vue"),
    },
    {
        path: "/registration",
        name: "registration-index",
        component: () => import("@/views/registration/Index.vue"),
    },
 
];

export default routes;

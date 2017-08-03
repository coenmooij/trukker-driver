import Vue from "vue";
import Router from "vue-router";
import Auth from "../components/authentication/Auth.vue";
import SignUp from "../components/authentication/SignUp.vue";

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'auth',
            component: Auth,
            redirect: {name: 'SignUp'},
            children: [
                {
                    path: 'sign-up',
                    name: 'SignUp',
                    component: SignUp,
                }
            ],
        },
    ]
})

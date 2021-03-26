// Imports
import Login from "../../views/auth/Login";
import Register from "../../views/auth/Register";
import Reset from "../../views/auth/reset"
export default [
    {
        component: Login,
        name: "Login",
        path: "/login",
        meta: {
            NoAuth: true
        }
    },
    {
        component: Register,
        name: "Register",
        path: "/register"
    },
    {
        component: Reset,
        name: "Reset",
        path: "/reset",
    },
    {
        component: Reset,
        name: "Reset",
        path: "/reset/:token",
        props: true,
    }
];

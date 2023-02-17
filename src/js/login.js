import axios from "axios"
import { mapGetters } from "vuex"
export default {
    data() {
        return {
            userData : {
                email : '',
                password : ''
            },
            userStatus : false
        }
    },
    computed: {
        ...mapGetters(["token","userData"]),
    },
    methods : {
        login() {
            this.$router.push({
                name : 'login'
            })
        },
        home() {
            this.$router.push({
                name : 'home'
            })
        },
        accountLogin() {
            axios
            .post("http://localhost:8000/api/user/login",this.userData)
            .then((response) => {
                if(response.data.token == null) {
                    this.userStatus = true;
                }else {
                    this.userData.email = "";
                    this.userData.password ="";
                    this.storeUserInfo(response);
                    this.home();
                }
            })
            .catch(err => console.log(err.message));
        },
        storeUserInfo (response) {
            this.$store.dispatch("setToken",response.data.token);
            this.$store.dispatch("setUserData",response.data.user);
        },
    }
}
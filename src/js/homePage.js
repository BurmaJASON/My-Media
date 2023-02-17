import axios from "axios"
import { mapGetters } from "vuex";
export default {
    
    name : 'HomePage',
    data() {
        return {
            postLists : [],
            categoryLists : [],
            searchKey : "",
            tokenStatus : false
        }
    },
    computed : {
        ...mapGetters(["token","userData"])
    },
    methods:  {
        getAllPost() {
            axios.get("http://localhost:8000/api/post").then((response) => {
                
               
                for (let i = 0; i < response.data.posts.length; i++) {
                    if(response.data.posts[i].image != null) {
                        response.data.posts[i].image = 'http://localhost:8000/storage/postImage/'+ response.data.posts[i].image;
                    }else {
                        response.data.posts[i].image = 'http://localhost:8000/defaultImage/default-image.jpg';
                    }
                }

                this.postLists = response.data.posts;
            });
        },
        loadCategory() {
            axios.get("http://localhost:8000/api/allCategory").then((response) => {
                this.categoryLists = response.data.categories;
            }).catch((err) => {
                console.log(err.message);
            });
        },
        search() {
            let search = {
                key : this.searchKey
            };
            axios.post("http://localhost:8000/api/post/search",search).then((response) => {
                console.log(response.data);
                for (let i = 0; i < response.data.searchPosts.length; i++) {
                    if(response.data.searchPosts[i].image != null) {
                        response.data.searchPosts[i].image = 'http://localhost:8000/storage/postImage/'+ response.data.searchPosts[i].image;
                    }else {
                        response.data.searchPosts[i].image = 'http://localhost:8000/defaultImage/default-image.jpg';
                    }
                }
                this.postLists = response.data.searchPosts;
            });   
        },
        categorySearch(searchKey) {
            let search = {
                key : searchKey
            };

            axios.post("http://localhost:8000/api/category/search",search).then((response) => {

                for (let i = 0; i < response.data.result.length; i++) {
                    if(response.data.result[i].image != null) {
                        response.data.result[i].image = 'http://localhost:8000/storage/postImage/'+ response.data.result[i].image;
                    }else {
                        response.data.result[i].image = 'http://localhost:8000/defaultImage/default-image.jpg';
                    }
                }

                this.postLists = response.data.result;

            }).catch(error => console.log(error.message));
        },
        newsDetail(id) {
            this.$router.push({
                name : 'newsDetail',
                query : {
                    newsId : id,
                },
            });
        },
        home() {
            this.$router.push({
                name : 'home'
            })
        },
        login() {
            this.$router.push({
                name : 'login'
            })
        },
        logout() {
            this.$store.dispatch("setToken",null);
            this.login();
        },
        checkToken() {
            if(this.token != null && this.token != undefined && this.token != "") {
                this.tokenStatus = true;
            }else {
                this.tokenStatus = false;
            }
        }
    },
    mounted() {
        this.checkToken();
        this.getAllPost();
        this.loadCategory();
    }
   
}
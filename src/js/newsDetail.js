import axios from "axios";
import { mapGetters } from "vuex"
export default {
    name : 'newsDetail',
    data() {
        return {
            postId : 0,
            post : {},
            viewCount  : 0
        }
    },
    computed: {
        ...mapGetters(['token', 'userData'])
    },
    methods : {
        loadPost (id) {

            let post = {
                postId : id,
            }
            axios.post("http://localhost:8000/api/post/details",post).then((response) => {

                
                if(response.data.post.image != null) {
                    response.data.post.image = 'http://localhost:8000/storage/postImage/'+ response.data.post.image;
                }else {
                    response.data.post.image = 'http://localhost:8000/defaultImage/default-image.jpg';
                }
                

                this.post = response.data.post;
            }).catch(error => console.log(error.message));
        },
        back() {
            history.back();
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
        viewCountLoad () {
            let data = {
                userId : this.userData.id,
                postId : this.$route.query.newsId,
            };
            axios.post("http://localhost:8000/api/post/actionLog",data).then((response) => {
                this.viewCount = response.data.post.length;
            });
        }
    },
    mounted(){
        this.viewCountLoad();
       this.postId = this.$route.query.newsId;
       this.loadPost(this.postId);
    }

}
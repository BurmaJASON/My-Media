import axios from "axios";
export default {
    name : 'newsDetail',
    data() {
        return {
            postId : 0,
            post : {},
        }
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
        }
    },
    mounted(){
       this.postId = this.$route.query.newsId;
       this.loadPost(this.postId);
    }

}
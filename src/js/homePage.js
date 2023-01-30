import axios from "axios"
export default {
    name : 'HomePage',
    data() {
        return {
            postLists : [],
        }
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
                console.log(response.data.posts);
                this.postLists = response.data.posts;
            });

        }
    },
    mounted() {
        this.getAllPost();
    }
   
}
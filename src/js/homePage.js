import axios from "axios"
export default {
    name : 'HomePage',
    data() {
        return {
            postLists : [],
            categoryLists : []
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
                this.postLists = response.data.posts;
            });
        },
        loadCategory() {
            axios.get("http://localhost:8000/api/allCategory").then((response) => {
                this.categoryLists = response.data.categories;
            }).catch((err) => {
                console.log(err.message);
            });
        }
    },
    mounted() {
        this.getAllPost();
        this.loadCategory();
    }
   
}
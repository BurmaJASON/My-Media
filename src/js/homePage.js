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
                this.postLists = response.data.posts;
            });

        }
    },
    mounted() {
        this.getAllPost();
    }
   
}
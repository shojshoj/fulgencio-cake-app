<div id="app">
    <v-container fluid>
        <v-row>
            <v-col
                v-if="!posts[0]"
            >
                <v-card>
                    <v-card-title>No Posts to Show</v-card-title>
                    <v-card-body>
                        <div class="d-flex align-center justify-center fill-height py-10">
                            <v-progress-circular indeterminate>
                            </v-progress-circular>
                        </div>
                    </v-card-body>
                </v-card>
            </v-col>
            <v-col
                v-else
                cols="12"
                v-for="post in posts"
                :key="post.id"
            >
                <v-card>
                    <v-card-title>{{post.title}}</v-card-title>
                    <v-card-text>{{post.body}}</v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>


<script type="importmap">
    {
        "imports" : {
            "postService" : "./js/axios/services/PostService.js"
        }
    }
</script>
<script type="module">
const { createApp, onMounted, ref, reactive } = Vue;
const { createVuetify } = Vuetify
const vuetify = createVuetify()

import { postService } from "postService"

createApp({
    setup() {
        const message = ref('Hello Josh :>')
        console.log(message.value)
        const posts = ref([])

        onMounted( async () => {
            await postService.getAllPosts().then((response) => {
                console.log(response.data.data)
                console.log(response.data.data.length)
                for(let i=0; i<response.data.data.length; i++) {
                    console.log(response.data.data[i].Post)
                    posts.value.push(response.data.data[i].Post)
                    console.log(posts.value)
                }
            })
        })

        return {
            message,
            posts
        }
    }
}).use(vuetify).mount('#app')
</script>
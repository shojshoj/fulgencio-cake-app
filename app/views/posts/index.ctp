<div id="app">
    <v-container fluid>
        <v-row>
            <v-col
                cols="12"
                sm="4"
            >
                <v-card>
                    
                </v-card>
            </v-col>
            <v-col
                cols="12"
                sm="4"
                v-if="!posts[0]"
            >
                <v-card class="text-center">
                    <v-card-title>Loading Posts</v-card-title>
                    <v-card-text>
                        <div class="d-flex align-center justify-center fill-height py-10">
                            <v-progress-circular indeterminate>
                            </v-progress-circular>
                        </div>
                    </v-card-text>
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

<!-- <script type="importmap">
    {
        "imports" : {
            "postService" : "/fuldev/app/webroot/js/services/PostService.js"
        }
    }
</script> -->

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
<div id="app">
    <v-container fluid>
        <v-row>
            <v-col
                cols="12"
                sm="3"
            >
                <v-card
                    class="pa-5"
                >
                    <v-card-text>
                        Navigations
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                sm="6"
            >
                <v-row>
                    <v-col
                        cols="12"
                    >
                        <v-card
                            class="pa-5"
                        >
                            <v-card-title>Create a Post</v-card-title>
                            <v-card-text>
                                <textarea name="" id="" cols="70" rows="10"></textarea>
                            </v-card-text>
                            <v-btn>Test</v-btn>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col
                        v-if="posts[0]"
                        cols="12"
                        v-for="post in posts"
                        :key="post.id"
                    >
                        <v-card>
                            <v-card-title>{{ post.Post.title }}</v-card-title>
                            <v-card-text>{{ post.Post.body }}</v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
            <v-col
                cols="12"
                sm="3"
            >

            </v-col>
            <!-- <v-col
                v-if="posts[0]"
                cols="12"
                v-for="post in posts"
                :key="post.id"
            >
                <v-card>
                    <v-card-title>{{post.Post.title}}</v-card-title>
                    <v-card-text>{{post.Post.body}}</v-card-text>
                </v-card>
            </v-col>
            <v-col
                v-else
                cols="12"
            >
                <v-card class="text-center">
                    <v-card-title>You have no Posts to show...</v-card-title>
                    <v-card-text>
                        <div class="d-flex align-center justify-center fill-height py-10">
                            <v-progress-circular indeterminate>
                            </v-progress-circular>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col> -->
        </v-row>
    </v-container>
</div>

<script>
const { createApp, onMounted, ref } = Vue;
const { createVuetify } = Vuetify

const vuetify = createVuetify()

createApp({
    setup() {
        const message = ref('Hello :>')
        const posts = <?php echo $this->Javascript->object($posts);?>
        
        console.log(posts)

        return {
            message,
            posts
        }
    }
}).use(vuetify).mount('#app')
</script>
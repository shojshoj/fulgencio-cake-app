<div id="app">
    <v-container fluid>
        <v-row>
            <v-col
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
            <v-col>
                <v-card class="text-center">
                    <v-card-title>You have no Posts to show...</v-card-title>
                    <v-card-text>
                        <div class="d-flex align-center justify-center fill-height py-10">
                            <v-progress-circular indeterminate>
                            </v-progress-circular>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
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
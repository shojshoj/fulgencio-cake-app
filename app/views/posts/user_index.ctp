<div id="app">
    <v-container fluid>
        <v-row>
            <v-col
                cols="12"
                v-for="post in posts"
                :key="post.id"
            >
                <v-card>
                    <v-card-title>{{post.Post.title}}</v-card-title>
                    <v-card-text>{{post.Post.body}}</v-card-text>
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

<div id="app">
    <!-- <el-input
        v-model="username"
        placeholder="Username"
    ></el-input>
    <el-button
        @click="clickedHere"
    >
        {{message}}
    </el-button> -->
    <v-container fluid>
        <v-row no-gutters>
            <v-col
                cols="12"
                sm="5"
                class=""
            >
                <v-row>
                    <v-col>
                        <v-sheet
                            class="mx-auto rounded-xl py-10 px-15"
                            color="grey-lighten-3"
                        >
                            <v-row>
                                <v-col>
                                    <div>Register</div>
                                </v-col>
                            </v-row>
                            <v-form
                                action="/fulgencio-cake-app/users/register"
                                method="post"
                            >
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            v-model="formData.username"
                                            label="Username"
                                            name="data[User][username]"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            v-model="formData.password"
                                            label="Password"
                                            name="data[User][password]"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-btn
                                            type="submit"
                                            @click="submit"
                                        >
                                            Submit?
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</div>

<script>
const { createApp, onMounted, ref, reactive } = Vue;
// const { FormInstance, FormRules } = ElementPlus
const { createVuetify } = Vuetify
const vuetify = createVuetify()

createApp({
    setup() {
        const username = ref("")
        const message = ref('Hello :>')
        
        const formData = reactive({
            username: "",
            password: ""
        })

        function clickedHere(){
            console.log(username.value)
        }

        return {
            message,
            username,
            clickedHere,
            formData
        }
    }
}).use(vuetify).mount('#app')
</script>
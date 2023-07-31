<div id="login-app">
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
    <v-row class="text-center justify-center">
        <v-col>
            <v-card 
                class="pa-5"
                elevation="5"
            >
                <v-row>
                    <v-col cols="12">
                        <v-card-title class="text-center">Login</v-card-title>
                    </v-col>
                    <v-col>
                        <v-text-field
                            v-model="username"
                            label="Username"
                            type="text"
                        ></v-text-field>
                        <v-text-field
                            v-model="password"
                            label="Password"
                            type="password"
                        ></v-text-field>
                        <p 
                            v-if="authError" 
                            v-html="authError"
                            class="text-center text-caption text-red-darken-3"
                        ></p>
                        <p 
                            v-if="authMessage" 
                            class="text-center text-caption text-blue-darken-3"
                        >
                            {{ authMessage }}
                        </p>
                        <v-btn
                            block
                            @click="handleLogin"
                        >
                            Login
                        </v-btn>
                        <v-btn
                            color="grey-darken-1"
                            class="mt-2"
                            block
                            density="compact"
                            @click="redirectPage('/fuldev/users/register')"
                        >
                            Register Here
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>
    <v-row>
        <v-col>
            <p class="text-center text-subtitle-1 text-info">Ignore this: Testing Vuetify Themes</p>
        </v-col>
    </v-row>
</v-container>
</div>

<!-- <script type="importmap">
    {
        "imports" : {
            "authService" : "./js/services/AuthService.js"
        }
    }
</script> -->

<script type="module">
const { createApp, onMounted, ref, reactive } = Vue;
// const { FormInstance, FormRules } = ElementPlus
const { createVuetify } = Vuetify

import vuetifyThemeConfig from 'vuetifyThemeConfig';

const vuetify = createVuetify(vuetifyThemeConfig)

import { authService } from "authService"


createApp({
    setup() {
        const message = ref('Hello Josh :>')

        const authError = ref('<?php echo $this->Session->flash('auth');?>')
        
        
        const queryParams = new URLSearchParams(window.location.search);
        const authMessage = ref(queryParams.get('authMessage'))

        const formData = reactive({
            username: "",
            password: ""
        })

        
        const username = ref("")
        const password = ref("")

        function clickedHere(){
            console.log(username.value)
        }

        // function redirectPage(url){
        //     console.log(url)
		//     window.location.assign(url)
	    // }

        function redirectPage(url, query=""){
		    window.location.href = url+query;
	    }

        async function handleLogin() {
            let data = JSON.stringify({
                "username": username.value,
                "password": password.value
            });
            await authService.login(data).then((response) => {
                console.log(response.data);
                if (response.data.status){
                    window.location.replace('/fuldev/user/posts')
                }
            })
        }

        return {
            authMessage,
            authError,
            message,
            clickedHere,
            formData,
            handleLogin,
            username,
            password,
            redirectPage
        }
    }
}).use(vuetify).mount('#login-app')
</script>
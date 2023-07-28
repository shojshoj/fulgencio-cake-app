<div id="register-page">
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
    <v-row>
        <v-col cols="12">
            <v-card-title class="text-center">Register</v-card-title>
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
            <v-btn
                block
                @click="handleRegister"
            >
                Register
            </v-btn>
            <v-btn
                color="grey-darken-1"
                class="mt-2"
                block
                density="compact"
                @click="redirect('/fuldev/users/login')"
            >
                Login Here
            </v-btn>
        </v-col>
    </v-row>
</v-container>
</div>

<script type="importmap">
    {
        "imports" : {
            "authService" : "/fuldev/app/webroot/js/services/AuthService.js"
        }
    }
</script>

<script type="module">
const { createApp, onMounted, ref, reactive } = Vue;
// const { FormInstance, FormRules } = ElementPlus
const { createVuetify } = Vuetify
const vuetify = createVuetify()

//try removing the authservice, it might be imported in other values

import { authService } from "authService"

createApp({
    setup() {
        const message = ref('Hello Josh :>')

        const formData = reactive({
            username: "",
            password: ""
        })

        
        const username = ref("")
        const password = ref("")

        function clickedHere(){
            console.log(username.value)
        }

        function redirect(url){
		    window.location.href = url;
	    }

        async function handleRegister() {
            let data = JSON.stringify({
                "username": username.value,
                "password": password.value
            });
            await authService.register(data).then((response) => {
                console.log(response.data);
                if (response.data.status){
                    
                }
            })
        }

        return {
            message,
            clickedHere,
            formData,
            handleRegister,
            username,
            password,
            redirect
        }
    }
}).use(vuetify).mount('#register-page')
</script>
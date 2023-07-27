<div id="app">
<v-container fluid>
    <v-row>
        <v-col>
            <v-text-field
                v-model="username"
            ></v-text-field>
            <v-text-field
                v-model="password"
            ></v-text-field>
            <v-btn
                block
                @click="handleLogin"
            >
                Login
            </v-btn>
        </v-col>
    </v-row>
</v-container>
</div>

<script type="importmap">
    {
        "imports" : {
            "authService" : "./js/axios/services/AuthService.js"
        }
    }
</script>
<script type="module">
const { createApp, onMounted, ref, reactive } = Vue;
// const { FormInstance, FormRules } = ElementPlus
const { createVuetify } = Vuetify
const vuetify = createVuetify()

import { authService } from "authService"
// import { authService } from './js/axios/services/AuthService.js'
<?php //$this->Javascript->link('./axios/services/AuthService.js')?>

createApp({
    setup() {
        const message = ref('Hello :>')
        
        const formData = reactive({
            username: "",
            password: ""
        })

        const username = ref("")
        const password = ref("")

        function clickedHere(){
            console.log(username.value)
        }
        
        async function handleLogin() {
            let data = JSON.stringify({
                "username": username.value,
                "password": password.value
            });
            await authService.login(data).then((response) => {
                console.log(response.data);
            })
        }

        return {
            message,
            clickedHere,
            formData,
            handleLogin,
            username,
            password
        }
    }
}).use(vuetify).mount('#app')
</script>
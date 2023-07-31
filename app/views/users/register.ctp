<div id="register-page">
    <!-- <el-input
        v-model="username"
        placeholder="Username"
    ></el-input>
    <el-button
        @click="handleRegister"
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
                        <v-card-title class="text-center">Register</v-card-title>
                    </v-col>
                    <v-col>
                        <v-text-field
                            v-model="formData.username"
                            label="Username"
                            type="text"
                            :error-messages="
                                v$.username.$errors.map(
                                    (e) => e.$message
                                )
                            "
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.password"
                            label="Password"
                            type="password"
                            :error-messages="
                                v$.password.$errors.map(
                                    (e) => e.$message
                                )
                            "
                            @update:model-value="testFunction"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.confirmPassword"
                            label="Confirm your Password"
                            type="password"
                            :error-messages="
                                v$.confirmPassword.$errors.map(
                                    (e) => e.$message
                                )
                            "
                        ></v-text-field>
                        <v-col cols="12">
                            <div class="text-red-lighten-2 text-center" v-for="error in v$.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </v-col>
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
                            @click="redirectPage('/fuldev/users/login')"
                        >
                            Login Here
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>
</v-container>
</div>

<!-- <script type="importmap">
    {
        "imports" : {
            "authService" : "/fuldev/app/webroot/js/services/AuthService.js"
        }
    }
</script> -->

<script type="module">
const { createApp, onMounted, ref, reactive, computed } = Vue;
// const { FormInstance, FormRules } = ElementPlus
const { createVuetify } = Vuetify
const vuetify = createVuetify()
// const { withValidators, useValidation } = VueDemi;
// const { withValidation, required, minLength, maxLength } = VuelidateValidators


//Validation?
// const { withValidators, useValidation } = VueDemi;

const { useVuelidate } = Vuelidate
const { required, email, sameAs, helpers } = VuelidateValidators

//try removing the authservice, it might be imported in other values, this is solved by the giga import

import { authService } from "authService"



createApp({
    setup() {
        const message = ref('Hello Josh :>')
        
        function testFunction() {
            console.log(message.value)
        }

        const formData = reactive({
            username: "",
            password: "",
            confirmPassword: "",
        })

        const rules = computed(() =>{
            return {
                username: { 
                    required: helpers.withMessage(
                        "Enter a Username",
                        required
                    ), 
                }, 
                password: { 
                    required: helpers.withMessage(
                        "Enter a Password",
                        required
                    ),
                },
                confirmPassword: {
                    required: helpers.withMessage(
                        "Confirm your Password",
                        required
                    ),
                    sameAs: helpers.withMessage(
                        "This does not match your Password",
                        sameAs(formData.password)
                    )
                } 
            }
        })

        const v$ = useVuelidate(rules, formData)
        
        // const username = ref("")
        // const password = ref("")

        // const validations = useValidate({
        //     username: {
        //         required: required
        //     },
        // });

        function redirectPage(url, query=""){
		    window.location.href = url+query;
	    }

        async function handleRegister(){
            v$.value.$touch();
            const result = await v$.value.$validate();
            if(result) {
                await registerUser(
                    formData.username,
                    formData.password
                )
                let slug = {authMessage: "Login with your Username and Password."}
                let queryString = new URLSearchParams(slug).toString();
                redirectPage('/fuldev/users/login?', queryString)
            } else {
                console.log("Validation Failed")
            }
        }

        async function registerUser(username, password) {
            let data = JSON.stringify({
                "username": username,
                "password": password
            });
            await authService.register(data).then((response) => {
                // console.log(response.data);
                if (response.data.status){
                    return true
                } else {
                    return false
                }
            })
        }

        return {
            testFunction,
            v$,
            message,
            handleRegister,
            formData,
            redirectPage
        }
    }
}).use(vuetify).mount('#register-page')
</script>
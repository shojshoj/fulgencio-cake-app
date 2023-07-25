
<div id="app">
    <el-input
        v-model="username"
        placeholder="Username"
    ></el-input>
    <el-button
        @click="clickedHere"
    >
        {{message}}
    </el-button>
</div>

<script>
const { createApp, onMounted, ref } = Vue;
const { FormInstance, FormRules } = ElementPlus

createApp({
    setup() {
        const username = ref("")
        const message = ref('Hello :>')

        function clickedHere(){
            console.log(username.value)
        }
        
        return {
            message,
            username,
            clickedHere
        }
    }
}).use(ElementPlus).mount('#app')
</script>
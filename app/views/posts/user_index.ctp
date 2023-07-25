<div id="app">{{ message }}</div>

<?php print_r($user)?>

<script>
const { createApp, onMounted, ref } = Vue;

const { createVuetify } = Vuetify

const vuetify = createVuetify

createApp({
    setup() {
        const message = ref('Hello :>')
        return {
            message
        }
    }
}).mount('#app')
</script>
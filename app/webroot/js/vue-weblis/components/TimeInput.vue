<template>
<v-menu ref="menu" v-model="menu" :close-on-content-click="false" :nudge-right="40" :return-value.sync="time" transition="scale-transition" offset-y max-width="290px" min-width="290px">
    <template v-slot:activator="{ on, attrs }">
        <v-text-field v-model="time" :label="lebel" :rules="requiredRule" readonly v-bind="attrs" v-on="on"></v-text-field>
    </template>
    <v-time-picker v-if="menu" v-model="time" full-width @click:minute="$refs.menu.save(time)"></v-time-picker>
</v-menu>
</template>

<script>
import moment from 'moment'
export default {
    props: ['value', 'lebel', 'required'],
    computed: {
        time: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        },
        requiredRule: {
            get() {
                if (this.required) {
                    return [v => !!v || 'This field is required'];
                } else {
                    return [];
                }
            }
        }
    },
    data() {
        return {
            menu: false,
            maxTime: moment().format('H:mm:ss'),
        }
    }
}
</script>

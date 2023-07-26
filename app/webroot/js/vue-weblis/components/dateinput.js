
export default {
    props: ['value', 'lebel', 'required'],
    computed: {
        computedDateFormatted() {
            return this.formatDate(this.date)
        },
        dateInput: {
            get() {
                console.log("get:" + this.value);
                return this.value;
            },
            set(val) {
                console.log("set:" + val);
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
        },
        config: {
            get() {
                return {force_not_required:{enabled:1},date_collected_max_not_required:{enabled:1}};
            }
        },
    },
    watch: {
        date(val) {
            this.dateFormatted = this.formatDate(this.date)
        }
    },
    data() {
        return {
            menu: false,
            date: null,
            dateFormatted: null,
            maxDate: new Date(new Date().getTime() - (new Date().getTimezoneOffset() * 60000)).toISOString(),
        }
    },
    methods: {
        formatDate(date) {
            if (!date) return null

            const [year, month, day] = date.split('-')
            return `${month}/${day}/${year}`
        },
        parseDate(date) {
            if (!date) return null

            const [month, day, year] = date.split('/')
            return `${day.padStart(2, '0')}-${month.padStart(2, '0')}-${year}`
        }
    },
	template:`
		<v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="290px">
			<template v-slot:activator="{ on, attrs }">
				<v-text-field clearable v-model="dateInput" :label="lebel" :rules="config.force_not_required.enabled == 1 ? [] : requiredRule" readonly v-bind="attrs" v-on="on"></v-text-field>
			</template>
			<v-date-picker v-model="dateInput" @input="menu=false" :max="config.date_collected_max_not_required.enabled == 1 ? maxDate : new Date(new Date().getTime() + 86400000).toISOString().substr(0, 10)"></v-date-picker>
		</v-menu>
	`
}


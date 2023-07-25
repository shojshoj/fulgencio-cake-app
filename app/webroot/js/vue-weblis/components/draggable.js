
import Sortable from 'sortablejs';

export default {
  name: 'Content',
  props:['list'],
  template: `
	  <div ref="sortablednd">
		  <template v-for="(item,id) in list">
			<span :class="'text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 border ' + (item.enabled?'bg-blue-100 text-blue-800  dark:text-blue-400 border-blue-400':'bg-gray-100 text-gray-800  dark:text-gray-400 border-gray-500 ignored-item')">
			  
				<input :id="'cb'+rid+'_'+id" v-model="item.enabled" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
				<label :for="'cb'+rid+'_'+id" >{{ item.name }}</label>
        
			</span>
			
			
		  </template>
	 </div>
  `,
  data() {
    return {
      rid: Math.floor(Math.random() * 1000000)
    }
  },
  mounted(){
	
	var sortable = Sortable.create(this.$refs['sortablednd'],{filter:'.ignored-item'});
	
  },
  
}



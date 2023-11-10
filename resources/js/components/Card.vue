<template>
  <Card class="flex" :style="{height: card.height}">
    <div class="p-4 w-full">
        <div class="px-2 mb-2 w-full flex justify-end">
            <div class="pr-2" v-if="displayGroupByOption">
                <group-by-picker @input="groupOption = $event.target.value" :model-value="groupOption" :items="groupByOptions"></group-by-picker>
            </div>
            <date-range-picker @input="dateRange = $event" v-model="dateRange" v-if="card.date_picker_available"></date-range-picker>
        </div>
        <chart :chart="{
            options: card.options,
            series: card.series,
            type: card.type,
            date_picker_available: card.date_picker_available,
            darkModeOptions: card.darkModeOptions,
            darkMode: darkMode
        }"></chart>
    </div>
  </Card>
</template>

<script>
import DateRangePicker from "./picker";
import Chart from "./chart";
import GroupByPicker from "./groupByPicker";
export default {
  props: [
    'card',
    'name'
    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],
  components:{GroupByPicker, Chart, DateRangePicker},
    watch:{
      dateRange(){
          if(this.initialized) this.getSeries();
      },
        groupOption(){
            if(this.initialized) this.getSeries();
        },
    },
  beforeUnmount() {
      clearInterval(this.interval);
  },
    data:() => {
      return{
          dateRange: null,
          initialized: false,
          darkMode: null,
          groupOption: null,
          interval : null
      }
  },

    computed:{
        displayGroupByOption(){
            return this.card.defaultGroupOption && this.card.groupOptions;
        },
        groupByOptions(){
            return Object.keys(this.card.groupOptions).map((key) => {
                return {
                    'key': key,
                    'value': this.card.groupOptions[key]
                }
            })
        }
    },
  mounted() {
      this.interval = setInterval(() => {
          this.darkMode = document.documentElement.classList.contains('dark');
      },100)
      this.dateRange = this.card.dateRange;
      this.groupOption = this.card.defaultGroupOption;
      setTimeout(() => {
          this.initialized = true;
      },200)
  },

  methods:{
      getSeries(){
          Nova.request().post('/nova-vendor/novaapex/apexcharts/series', {
              groupOption: this.groupOption,
              date: this.dateRange,
              key: this.card.key
          }).then(({data}) => {
              this.card.series = data.series;
          });
      },
  }
}
</script>

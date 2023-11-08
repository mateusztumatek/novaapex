<template>
  <Card class="flex" :style="{height: card.height}">
    <div class="p-4 w-full">
        <date-range-picker @input="dateRange = $event" v-model="dateRange" v-if="card.date_picker_available"></date-range-picker>
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
export default {
  props: [
    'card',
    'name'
    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],
  components:{Chart, DateRangePicker},
    watch:{
      dateRange(){
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
          interval : null
      }
  },

  mounted() {
      this.interval = setInterval(() => {
          this.darkMode = document.documentElement.classList.contains('dark');
      },100)
      this.dateRange = this.card.dateRange;
      setTimeout(() => {
          this.initialized = true;
      },200)
  },

  methods:{
      getSeries(){
          Nova.request().post('/nova-vendor/novaapex/apexcharts/series', {
              date: this.dateRange,
              key: this.card.key
          }).then(({data}) => {
              this.card.series = data.series;
          });
      },
  }
}
</script>

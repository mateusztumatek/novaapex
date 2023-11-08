<template>
    <div class="h-full" ref="holder">
        <apexchart
            :key="chart.darkMode"
            v-if="totalAvailableHeight"
            width="100%"
            :height="height"
            :type="type"
            :options="options"
            :series="series"
        ></apexchart>
    </div>
</template>
<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    props:{
        chart:{
            type: Object,
            required: true
        }
    },
    data:() => {
        return{
            totalAvailableHeight: null
        }
    },
    components: {
        'apexchart': VueApexCharts,
    },
    computed:{
        height(){
            if(this.chart.date_picker_available){
                return this.totalAvailableHeight - 42;
            }
            return this.totalAvailableHeight;
        },
        type(){
            return this.chart.type;
        },
        options(){
            if(this.chart.darkMode && this.chart.darkModeOptions) return this.chart.darkModeOptions;
            return this.chart.options;
        },
        series(){
            return this.chart.series;
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.totalAvailableHeight = this.$refs.holder.clientHeight;
        })
    }
}
</script>

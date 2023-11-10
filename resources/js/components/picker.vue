<template>
    <div class="w-full max-w-xs">
        <Datepicker
            :dark="isDarkMode"
            range
            :utc="'preserve'"
            :enableTimePicker="false"
            @update:modelValue="emitValue"
            :model-value="modelValue"></Datepicker>
    </div>
</template>
<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    props:['modelValue'],

    components:{Datepicker},
    methods:{
        emitValue(val){
            this.$emit('input', val);
        }
    }
}
</script>
<style>
    .dark .dp__theme_light{
        --dp-text-color: #ffffff;
        --dp-hover-color: #484848;
        --dp-hover-text-color: #ffffff;
        --dp-hover-icon-color: #959595;
        --dp-primary-color: #005cb2;
        --dp-primary-text-color: #ffffff;
        --dp-secondary-color: #a9a9a9;
        --dp-menu-border-color: #2d2d2d;
        --dp-border-color-hover: #aaaeb7;
        --dp-disabled-color: #737373;
        --dp-scroll-bar-background: #212121;
        --dp-scroll-bar-color: #484848;
        --dp-success-color: #00701a;
        --dp-success-color-disabled: #428f59;
        --dp-icon-color: #959595;
        --dp-danger-color: #e53935;
        --dp-highlight-color: rgba(0, 92, 178, 0.2);
        --dp-background-color: rgb(30, 41, 59);
        --dp-border-color: rgba(255,255,255,0.6)
    }
</style>

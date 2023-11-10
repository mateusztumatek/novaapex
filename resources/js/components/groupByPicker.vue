<template>
    <select
        :model-value="modelValue"
        id="countries" style="border-radius: 4px" class=" bg-transparent border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:border-white dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option v-for="item in items" :value="item.key">{{ item.value }}</option>
    </select>
</template>
<script>
export default {
    props:['modelValue', 'items'],
}
</script>

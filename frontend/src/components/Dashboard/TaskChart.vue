<script setup>
import { computed} from 'vue'
import { Pie } from 'vue-chartjs'
import {Chart, ArcElement, Tooltip, Legend} from 'chart.js'

Chart.register(ArcElement, Tooltip, Legend)

const props = defineProps({
data:{
type: Object,
default: () => ({
      completed_tasks:0,
      pending_tasks:0
    })
}
})
const chartData = computed(() => ({
  labels: [
    'Completed',
    'Pending'
  ],
  datasets: [
    {
      data: [
        props.data.completed_tasks,
        props.data.pending_tasks
      ]
    }
  ]
}))
</script>

<template>
<p>
Completed: {{ props.data.completed_tasks }}
</p>

<p>
Pending: {{ props.data.pending_tasks }}
</p>
<div style="width:400px">
<Pie :data="chartData"/>
</div>

</template>

<style scoped>


</style>
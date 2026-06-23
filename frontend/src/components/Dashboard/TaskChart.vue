<script setup>
import { computed} from 'vue'
import { Pie } from 'vue-chartjs'
import {Chart, ArcElement, Tooltip, Legend} from 'chart.js'
Chart.register(ArcElement, Tooltip, Legend)
const props = defineProps({
data:{
type: Object,
required:true
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
<Pie />
<div>
  Completed:
  {{ props.data.completed_tasks }}

  <br>

  Pending:
  {{props.data.pending_tasks }}
</div>


</template>

<style scoped>


</style>
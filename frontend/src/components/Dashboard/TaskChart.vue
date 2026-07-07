<script setup>
import { computed } from "vue";
import { Pie } from "vue-chartjs";
import { Chart, ArcElement, Tooltip, Legend } from "chart.js";

Chart.register(ArcElement, Tooltip, Legend);

const props = defineProps({
  data: {
    type: Object,
    default: () => ({
      completed_tasks: 0,
      pending_tasks: 0,
    }),
  },
});
const chartData = computed(() => ({
  labels: ["Completed", "Pending"],
  datasets: [
    {
      data: [props.data.completed_tasks, props.data.pending_tasks],

      backgroundColor: [
        "#22c55e", // green completed
        "#f97316", // orange pending
      ],
      borderColor: ["#ffffff", "#ffffff"],
      borderWidth: 3,
      hoverOffset: 10,
    },
  ],
}));

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,

  plugins: {
    legend: {
      position: "bottom",
      labels: {
        padding: 20,
        font: {
          size: 14,
          family: "Inter",
          weight: "600",
        },
      },
    },

    tooltip: {},
  },
};
</script>

<template>
  <div class="task-chart-card">
    <div class="chart-header">
      <h3>Task Progress</h3>
      <div class="stats-summary">
        <div class="stat-item">
          <span class="stat-label">Completed</span>
          <span class="stat-value completed">{{
            props.data.completed_tasks
          }}</span>
        </div>
        <div class="stat-item">
          <span class="stat-label">Pending</span>
          <span class="stat-value pending">{{ props.data.pending_tasks }}</span>
        </div>
      </div>
    </div>
    <div class="chart-content">
      <div class="chart-wrapper">
        <Pie :data="chartData" :options="chartOptions" />
      </div>
    </div>
  </div>
</template>

<style scoped>
.task-chart-card {
  background: white;

  padding: 28px;

  border-radius: 20px;

  border: 1px solid #e5e7eb;

  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);

  height: 420px;

  transition: 0.3s;
}

.task-chart-card:hover {
  transform: translateY(-5px);

  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

/* Header */

.chart-header {
  margin-bottom: 20px;
}

.chart-header h3 {
  font-size: 22px;

  font-weight: 800;

  color: #064e3b;

  margin-bottom: 20px;
}

/* Summary numbers */

.stats-summary {
  display: flex;

  gap: 40px;
}

.stat-item {
  display: flex;

  flex-direction: column;

  gap: 5px;
}

.stat-label {
  font-size: 14px;

  color: #64748b;

  font-weight: 600;
}

.stat-value {
  font-size: 24px;

  font-weight: 800;
}

.stat-value.completed {
  color: #16a34a;
}

.stat-value.pending {
  color: #f97316;
}

/* Chart */

.chart-content {
  height: 250px;

  display: flex;

  justify-content: center;

  align-items: center;
}

.chart-wrapper {
  height: 250px;

  width: 250px;
}
</style>

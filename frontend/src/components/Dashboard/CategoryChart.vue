<script setup>
import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
);

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
});

const chartData = {
  labels: props.categories.map((item) => item.category),
  datasets: [
    {
      label: "Tasks",
      data: props.categories.map((item) => item.total),
      backgroundColor: [
        "#064e3b",
        "#059669",
        "#22c55e",
        "#f97316",
        "#dc2626",
        "#8b5cf6",
        "#0ea5e9",
        "#f59e0b",
      ],
      borderColor: [
        "#064e3b",
        "#059669",
        "#22c55e",
        "#f97316",
        "#dc2626",
        "#8b5cf6",
        "#0ea5e9",
        "#f59e0b",
      ],
      borderWidth: 1,
      borderRadius: 8,
      borderSkipped: false,
    },
  ],
};

const options = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: false,
    },
    title: {
      display: false,
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        color: "rgba(0,0,0,0.05)",
      },
      ticks: {
        color: "#64748b",
        font: {
          size: 12,
        },
      },
    },
    x: {
      grid: {
        display: false,
      },
      ticks: {
        color: "#64748b",
        font: {
          size: 12,
        },
      },
    },
  },
};
</script>

<template>
  <div class="chart-card">
    <div class="chart-header">
      <h3>Tasks by Category</h3>
      <p>Distribution of tasks across different categories</p>
    </div>
    <div class="chart-content">
      <Bar :data="chartData" :options="options" />
    </div>
  </div>
</template>

<style scoped>
.chart-card {
  background: white;

  padding: 28px;

  border-radius: 20px;

  border: 1px solid #e5e7eb;

  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);

  transition: all 0.3s ease;

  height: 420px;
}

.chart-card:hover {
  transform: translateY(-5px);

  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

/* Header */

.chart-header {
  margin-bottom: 25px;
}

.chart-header h3 {
  font-size: 22px;

  font-weight: 800;

  color: #064e3b;

  margin: 0 0 8px 0;
}

.chart-header p {
  font-size: 14px;

  color: #64748b;

  margin: 0;
}

/* Chart area */

.chart-content {
  height: 300px;

  width: 100%;
}
</style>

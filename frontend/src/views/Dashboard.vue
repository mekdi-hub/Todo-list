<script setup>
import { ref, onMounted } from "vue";
import TaskChart from "../components/Dashboard/TaskChart.vue";
import CategoryChart from "../components/Dashboard/CategoryChart.vue";
import {
  ListTodo,
  CircleCheck,
  Clock,
  AlertTriangle,
  Folder,
} from "lucide-vue-next";
const loading = ref(true);
import api from "../api/axios";
import TaskCard from "../components/task/TaskCard.vue";

const user = JSON.parse(localStorage.getItem("user")) || {};

const data = ref({});
const todayTasks = ref([]);

const dashboard = async () => {
  loading.value = true;
  try {
    const response = await api.get("/dashboard");

    console.log(response.data);

    data.value = response.data;
    todayTasks.value = response.data.today_tasks;
  } catch (error) {
    console.error(error.response?.data);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  dashboard();
});
</script>

<template>
  <div class="dashboard">
    <!-- Header -->

    <section v-if="loading" class="cards">
      <div class="card skeleton" v-for="i in 5" :key="i">
        <div class="skeleton-icon"></div>
        <div class="skeleton-content">
          <div class="skeleton-title"></div>
          <div class="skeleton-number"></div>
        </div>
      </div>
    </section>
    <section v-else class="cards">
      <div class="card">
        <div class="icon-box">
          <ListTodo :size="22" />
        </div>
        <div>
          <h3>Total Tasks</h3>
          <p>{{ data.total_tasks }}</p>
        </div>
      </div>

      <div class="card completed">
        <div class="icon-box completed-icon">
          <CircleCheck :size="22" />
        </div>
        <div>
          <h3>Completed</h3>
          <p>{{ data.completed_tasks }}</p>
        </div>
      </div>

      <div class="card pending">
        <div class="icon-box pending-icon">
          <Clock :size="22" />
        </div>
        <div>
          <h3>Pending</h3>
          <p>{{ data.pending_tasks }}</p>
        </div>
      </div>

      <div class="card">
        <div class="icon-box warning-icon">
          <AlertTriangle :size="22" />
        </div>
        <div>
          <h3>High Priority</h3>
          <p>{{ data.high_priority_tasks }}</p>
        </div>
      </div>

      <div class="card">
        <div class="icon-box">
          <Folder :size="22" />
        </div>
        <div>
          <h3>Categories</h3>
          <p>{{ data.total_categories }}</p>
        </div>
      </div>
    </section>

    <section class="today-section">
      <h2>Today's Tasks</h2>

      <div v-if="todayTasks.length" class="today-tasks-grid">
        <TaskCard
          v-for="task in todayTasks"
          :key="task.id"
          :task="task"
          compact
        />
      </div>

      <p v-else>No tasks for today 🎉</p>
    </section>

    <div class="charts">
      <div class="chart-card">
        <CategoryChart
          v-if="data.tasks_by_category"
          :categories="data.tasks_by_category"
        />
      </div>

      <div class="chart-card">
        <TaskChart v-if="data.total_tasks !== undefined" :data="data" />
      </div>
    </div>
  </div>
</template>

<style scoped>
.dashboard {
  padding: 40px;
  background: #f8fafc;
  min-height: 100vh;
}
.header {
  margin-bottom: 35px;
}

.header h1 {
  font-size: 36px;
  font-weight: 800;
  color: #064e3b;
  margin-bottom: 10px;
}

.header p {
  font-size: 18px;
  color: #64748b;
}

.cards {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 25px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 18px;

  display: flex;
  align-items: center;
  gap: 15px;

  border: 1px solid #e5e7eb;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);

  transition: 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}

.card h3 {
  font-size: 13px;
  font-weight: 600;
  color: #64748b;
  margin: 0;
}

.card p {
  font-size: 26px;
  font-weight: 800;
  color: #064e3b;
  margin: 0;
}

.completed p {
  color: #16a34a;
}

.pending p {
  color: #ea580c;
}

.today-section {
  margin-top: 45px;
}

.today-section h2 {
  font-size: 28px;

  font-weight: 800;

  color: #064e3b;

  margin-bottom: 25px;
}

.today-section > p {
  color: #64748b;
}

.today-tasks-grid {
  display: grid;

  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));

  gap: 25px;
}

.charts {
  display: grid;

  grid-template-columns: 1fr 1fr;

  gap: 30px;

  margin-top: 45px;
}

.chart-card {
  background: white;

  padding: 25px;

  border-radius: 20px;

  border: 1px solid #e5e7eb;

  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
}
.icon-box {
  width: 45px;
  height: 45px;
  border-radius: 12px;

  display: flex;
  align-items: center;
  justify-content: center;
  color: #064e3b;
}

/* Variants */
.completed-icon {
  color: #16a34a;
}

.pending-icon {
  color: #ea580c;
}

.warning-icon {
  color: #f59e0b;
}
.skeleton {
  display: flex;
  align-items: center;
  gap: 15px;
}

.skeleton-icon {
  width: 45px;
  height: 45px;
  border-radius: 12px;
  background: #e5e7eb;
}

.skeleton-content {
  flex: 1;
}

.skeleton-title {
  width: 70%;
  height: 14px;
  border-radius: 6px;
  background: #e5e7eb;
  margin-bottom: 12px;
}

.skeleton-number {
  width: 40%;
  height: 24px;
  border-radius: 6px;
  background: #e5e7eb;
}
@keyframes shimmer {
  0% {
    background-position: -300px 0;
  }

  100% {
    background-position: 300px 0;
  }
}

.skeleton-icon,
.skeleton-title,
.skeleton-number {
  background: linear-gradient(
    90deg,
    #e5e7eb 25%,
    #f3f4f6 50%,
    #e5e7eb 75%
  );

  background-size: 600px 100%;
  animation: shimmer 1.4s infinite linear;
}
@media (max-width: 1200px) {
  .cards {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .dashboard {
    padding: 20px;
  }

  .cards {
    grid-template-columns: 1fr;
  }

  .charts {
    grid-template-columns: 1fr;
  }

  .header h1 {
    font-size: 30px;
  }
}
</style>

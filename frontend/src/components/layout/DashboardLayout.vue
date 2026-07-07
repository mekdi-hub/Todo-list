<script setup>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>
<template>
  <div class="layout">
    <Sidebar />
    <main class="content">
      <Navbar />
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.layout {
  display: flex;
  min-height: 100vh;
}

.content {
  flex: 1;
  background: #f8fafc;
  overflow: auto;
}

/* Desktop */
@media (min-width: 769px) {
  .content {
    margin-left: 260px;
  }
}

/* Mobile */
@media (max-width: 768px) {
  .content {
    margin-left: 0;
  }
}
</style>

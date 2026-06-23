<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  currentView: String,
  user: Object,
  isOpen: Boolean
})

const emit = defineEmits(['setView', 'logout', 'close'])
</script>

<template>
  <aside class="sidebar" :class="{ 'sidebar-open': isOpen }">
    <div class="sidebar-header">
      <h1 class="sidebar-logo">TODO</h1>
      <button @click="emit('close')" class="sidebar-close">×</button>
    </div>
    
    <nav class="sidebar-nav">
      <button 
        @click="emit('setView', 'dashboard')" 
        class="nav-item"
        :class="{ active: currentView === 'dashboard' }"
      >
        <span>Dashboard</span>
      </button>
      
      <button 
        @click="emit('setView', 'tasks')" 
        class="nav-item"
        :class="{ active: currentView === 'tasks' }"
      >
        <span>Tasks</span>
      </button>
      
      <button 
        @click="emit('setView', 'categories')" 
        class="nav-item"
        :class="{ active: currentView === 'categories' }"
      >
        <span>Categories</span>
      </button>
    </nav>
    
    <div class="sidebar-footer">
      <div class="user-info">
        <div class="user-avatar">{{ user?.name?.charAt(0).toUpperCase() }}</div>
        <div class="user-details">
          <div class="user-name">{{ user?.name }}</div>
          <div class="user-email">{{ user?.email }}</div>
        </div>
      </div>
      <button @click="emit('logout')" class="btn btn-outline">Logout</button>
    </div>
  </aside>
</template>

<style scoped>
.sidebar {
  width: 260px;
  background: white;
  border-right: 1px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  position: fixed;
  height: 100vh;
  left: 0;
  top: 0;
  z-index: 200;
  transition: transform 0.3s;
}

.sidebar-header {
  padding: 1.5rem;
  border-bottom: 1px solid #e5e7eb;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.sidebar-logo {
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(to right, #16a34a, #15803d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin: 0;
}

.sidebar-close {
  display: none;
  background: none;
  border: none;
  font-size: 2rem;
  color: #6b7280;
  cursor: pointer;
  padding: 0;
  width: 2rem;
  height: 2rem;
}

.sidebar-nav {
  flex: 1;
  padding: 1rem 0;
  overflow-y: auto;
}

.nav-item {
  width: 100%;
  padding: 0.875rem 1.5rem;
  display: flex;
  align-items: center;
  background: none;
  border: none;
  cursor: pointer;
  color: #6b7280;
  font-size: 0.9375rem;
  font-weight: 500;
  transition: all 0.2s;
  text-align: left;
  border-left: 3px solid transparent;
}

.nav-item:hover {
  background: #f9fafb;
  color: #16a34a;
}

.nav-item.active {
  background: #f0fdf4;
  color: #16a34a;
  border-left-color: #16a34a;
}

.sidebar-footer {
  padding: 1.5rem;
  border-top: 1px solid #e5e7eb;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1rem;
}

.user-avatar {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #16a34a, #15803d);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1rem;
}

.user-details {
  flex: 1;
  min-width: 0;
}

.user-name {
  font-weight: 600;
  color: #111827;
  font-size: 0.875rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.user-email {
  font-size: 0.75rem;
  color: #6b7280;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.btn {
  width: 100%;
  padding: 0.5rem 1rem;
  font-weight: 600;
  border-radius: 0.5rem;
  text-decoration: none;
  transition: all 0.3s;
  display: inline-block;
  cursor: pointer;
  border: none;
  font-size: 0.875rem;
}

.btn-outline {
  color: #16a34a;
  border: 2px solid #16a34a;
  background-color: white;
}

.btn-outline:hover {
  background-color: #f0fdf4;
}

@media (max-width: 768px) {
  .sidebar {
    transform: translateX(-100%);
  }
  
  .sidebar.sidebar-open {
    transform: translateX(0);
  }
  
  .sidebar-close {
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
</style>

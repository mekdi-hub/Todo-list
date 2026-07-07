<script setup>
import { ref } from "vue";
import Swal from "sweetalert2";
import {
  LayoutDashboard,
  ListTodo,
  CheckSquare,
  Folder,
  LogOut,
  Menu,
} from "lucide-vue-next";
import { useRouter } from "vue-router";
const router = useRouter();
const isOpen = ref(false);
const toggleSidebar = () => {
  isOpen.value = !isOpen.value;
};
const goTo = (path) => {
  router.push(path);
};
const logout = async () => {
  const result = await Swal.fire({
    title: "Logout?",
    text: "Are you sure you want to logout?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Logout",
    cancelButtonText: "Cancel",
  });

  if (!result.isConfirmed) return;
  localStorage.removeItem("token");
  router.push("/login");
};
</script>
<template>
  <button class="menu-btn" @click="toggleSidebar"><Menu :size="24" /></button>

  <div v-if="isOpen" class="overlay" @click="toggleSidebar"></div>
  <aside class="sidebar" :class="{ open: isOpen }">
    <div class="logo">
      <ListTodo :size="24" /><router-link to="/">TODO</router-link>
    </div>
    <nav>
      <button @click="goTo('/dashboard')">
        <LayoutDashboard :size="20" /> Dashboard
      </button>

      <button @click="goTo('/tasks')"><CheckSquare :size="20" /> Tasks</button>
      <button @click="goTo('/categories')">
        <Folder :size="20" /> Categories
      </button>
    </nav>
    <button class="logout" @click="logout"><LogOut :size="20" /> Logout</button>
  </aside>
</template>
<style scoped>
.sidebar {
  width: 260px;
  height: 100vh;
  background: white;
  color: #064e3b;
  padding: 30px 20px;
  display: flex;
  flex-direction: column;
  position: fixed;
  left: 0;
  top: 0;
  transition: transform 0.3s ease;
  z-index: 1000;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 28px;
  font-weight: 800;
  margin-bottom: 40px;
}

nav {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

button {
  display: flex;
  align-items: center;
  gap: 12px;

  width: 100%;
  padding: 14px;

  background: none;
  border: none;
  border-radius: 10px;

  color: #064e3b;
  font-size: 16px;
  font-weight: bold;

  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background: #eefdf5;
  border-left: 4px solid #064e3b;
}

.logout {
  margin-top: auto;
}

/* Hamburger button */
.menu-btn {
  display: none;
  position: fixed;
  top: 15px;
  left: 15px;
  background: #064e3b;
  color: white;
  width: auto;
  padding: 10px 14px;
  border-radius: 8px;
  z-index: 1100;
  font-size: 22px;
}

/* Overlay */
.overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  z-index: 999;
}

/* Mobile */
@media (max-width: 768px) {
  .menu-btn {
    display: block;
  }

  .sidebar {
    transform: translateX(-100%);
  }

  .sidebar.open {
    transform: translateX(0);
  }
}
</style>

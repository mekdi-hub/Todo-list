<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
const isLoggedIn = ref(false);
import Swal from "sweetalert2";
const router = useRouter();

onMounted(() => {
  const token = localStorage.getItem("token");
  if (token) {
    isLoggedIn.value = true;
  }
});
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
  localStorage.removeItem("user");
  isLoggedIn.value = false;
  router.push("/login");
};
</script>

<template>
  <nav class="navbar">
    <div class="navibar">
      <h1 class="logo"><router-link to="/">TODO</router-link></h1>
    </div>

    <div v-if="!isLoggedIn" class="nav-links">
      <router-link to="/login" class="nav-link">Login </router-link>
      <router-link to="/Register" class="nav-link"> Register </router-link>
    </div>
    <div v-else class="nav-links">
      <router-link to="/dashboard" class="nav-link"> Dashboard </router-link>
      <router-link to="/tasks" class="nav-link"> Tasks </router-link>
      <button @click="logout" class="auth-button">Logout</button>
    </div>
  </nav>
</template>
<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  padding: 18px 50px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  position: sticky;
  top: 0;
  z-index: 100;
}
.logo {
  color: #064e3b;
  font-size: 25px;
  font-weight: 800;
}
.nav-links {
  display: flex;
  align-items: center;
  gap: 20px;
}
.nav-link {
  text-decoration: none;
  color: #064e3b;
  font-weight: 600;
  padding: 8px 12px;
  border-radius: 8px;
  transition: 0.3s;
}

.nav-link:hover {
  background: #eefdf5;
  color: #047857;
}
.auth-button {
  background: #064e3b;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
}
.auth-button:hover {
  background: #047857;
}
</style>

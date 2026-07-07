<script setup>
import BaseButton from "../components/ui/BaseButton.vue";
import BaseInput from "../components/ui/BaseInput.vue";
import Navbar from "../components/layout/Navbar.vue";

import Footer from "../components/layout/Footer.vue";
import BaseCard from "../components/ui/BaseCard.vue";
import { useToast } from "vue-toastification";
const toast = useToast();
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../api/axios";
const email = ref("");
const password = ref("");
const message = ref("");
const router = useRouter();
const login = async () => {
  if (email.value === "" || password.value === "") {
    message.value = "Please fill in all fields";
    return;
  }
  try {
    const response = await api.post("/login", {
      email: email.value,
      password: password.value,
    });

    localStorage.setItem("token", response.data.token);

    localStorage.setItem("user", JSON.stringify(response.data.user));
    toast.info("Logged in successfully.");
    message.value = "Logged in successfully 👏👏";
    router.push("/dashboard");
  } catch (error) {
    console.log(error.response.data);

    message.value = "Login failed Check your email and password.";
  }
};
</script>

<template>
  <Navbar />

  <div class="auth-page">
    <div class="card">
      <h1>Welcome Back</h1>
      <BaseInput placeholder="Email" v-model="email" type="email" />
      <BaseInput placeholder="Password" v-model="password" type="password" />
      <BaseButton @click="login">Login</BaseButton>
      <p>{{ message }}</p>
    </div>
  </div>
  <Footer />
</template>

<style scoped>
.auth-page {
  min-height: calc(100vh - 120px);
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f7f5;
}

.card {
  width: 400px;
  background: white;
  padding: 35px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
  display: flex;
  flex-direction: column;
  gap: 18px;
}

h1 {
  text-align: center;
  color: #064e3b;
  font-size: 32px;
  font-weight: bold;
}

p {
  text-align: center;
  color: #555;
}
</style>

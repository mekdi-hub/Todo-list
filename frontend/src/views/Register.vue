<script setup>
import Navbar from "../components/layout/Navbar.vue";
import BaseButton from "../components/ui/BaseButton.vue";
import BaseInput from "../components/ui/BaseInput.vue";
import BaseCard from "../components/ui/BaseCard.vue";
import Footer from "../components/layout/Footer.vue";
import { ref } from "vue";
import api from "../api/axios";
const email = ref("");
const password = ref("");
const name = ref("");
const confirmPassword = ref("");
const message = ref("");
const register = async () => {
  if (
    email.value === "" ||
    password.value === "" ||
    name.value === "" ||
    confirmPassword.value === ""
  ) {
    message.value = " This fields cannot be empty ";
    return;
  }
  if (password.value !== confirmPassword.value) {
    message.value = "Passwords do not match";
    return;
  }
  try {
    const response = await api.post("/register", {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: confirmPassword.value,
    });

    message.value = " Registered successfully 👏";
  } catch (error) {
    console.log(error.response.data);
    message.value = "Registration failed";
  }
};
</script>

<template>
  <Navbar />
  <div class="auth-page">
    <div class="card">
      <h1>Create Account</h1>
      <BaseInput v-model="name" type="text" placeholder="Name" />
      <BaseInput v-model="email" type="email" placeholder="Email" />
      <BaseInput v-model="password" type="password" placeholder="Password" />
      <BaseInput
        v-model="confirmPassword"
        type="password"
        placeholder="Confirm Password"
      />
      <BaseButton @click="register">Register</BaseButton>
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

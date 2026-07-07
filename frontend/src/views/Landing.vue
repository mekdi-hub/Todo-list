<script setup>
import { ref, onMounted } from "vue";
import BaseButton from "../components/ui/BaseButton.vue";
import Navbar from "../components/layout/Navbar.vue";
import heroImage from "../assets/landing.png";
import Footer from "../components/layout/Footer.vue";
const isLoggedIn = ref(false);
onMounted(() => {
  const token = localStorage.getItem("token");
  if (token) {
    isLoggedIn.value = true;
  }
});
</script>

<template>
  <div class="landing-page">
    <Navbar />

    <section class="hero-section">
      <div class="hero-container">
        <div class="hero-image">
          <img :src="heroImage" alt="Todo illustration" />
        </div>

        <h1 class="hero-title">
          Organize Your Tasks
          <span class="gradient-text">Easily</span>
        </h1>

        <p class="hero-description">
          Manage your tasks, deadlines, priorities and categories in one
          beautiful workspace designed to improve your productivity.
        </p>

        <div v-if="!isLoggedIn" class="button-group">
          <router-link to="/register" class="btn btn-primary">
            <BaseButton> Get Started </BaseButton>
          </router-link>
          <router-link to="/login" class="btn btn-secondary">
            Login
          </router-link>
        </div>
        <div v-else class="nav-links">
          <BaseButton
            ><router-link to="/tasks"> Create Tasks</router-link></BaseButton
          >
        </div>
      </div>
    </section>
  </div>
  <div>
    <Footer />
  </div>
</template>

<style scoped>
.landing-page {
  min-height: 100vh;
  background-color: white;
}

/* Hero Section */
.hero-section {
  padding: 1.5rem 1.5rem 2rem;
  min-height: calc(100vh - 70px);
  display: flex;
  align-items: center;
}

.hero-container {
  max-width: 56rem;
  margin: 0 auto;
  text-align: center;
}

.hero-image {
  display: flex;
  justify-content: center;
  margin-bottom: 1.5rem;
}

.hero-image img {
  width: 100%;
  max-width: 26rem;
  height: auto;
}

.hero-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #111827;
  margin-bottom: 1rem;
  line-height: 1.2;
}

.gradient-text {
  background: linear-gradient(to right, #20a34a, #15803d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-description {
  font-size: 1rem;
  color: #6b7280;
  margin-bottom: 1.5rem;
  max-width: 42rem;
  margin-left: auto;
  margin-right: auto;
}
.btn-secondary {
  border: solid;
  padding: 10px 20px;
  border-color: darkgreen;
  border-radius: 5px;
  color: darkgreen;
  font-weight: bold;
}
.btn-secondary:hover {
  background-color: darkgreen;
  color: white;
  transition: 0.3s;
}
/* Responsive */
@media (max-width: 768px) {
  .hero-section {
    padding: 1rem 1.5rem 1.5rem;
  }

  .hero-image img {
    max-width: 16rem;
  }

  .hero-title {
    font-size: 1.875rem;
    margin-bottom: 0.75rem;
  }

  .hero-description {
    font-size: 0.9375rem;
    margin-bottom: 1.25rem;
  }

  .button-group {
    margin-bottom: 1.5rem;
  }
}
</style>

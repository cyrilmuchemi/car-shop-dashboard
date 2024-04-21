<script setup>
import { useRouter } from "vue-router";
const router = useRouter();
const goBack = () => {
  router.push({ name: "home" });
};
</script>

<template>
  <h1>Add a new car!</h1>
  <button @click="goBack()" class="btn-primary">Go Back</button>
</template>

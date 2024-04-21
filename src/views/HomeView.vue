<script setup>
import { useRouter } from "vue-router";
const router = useRouter();
const viewAddCar = () => {
  router.push({ name: "addnewcar" });
};
</script>

<template>
  <div class="container">
    <h1 class="text-center">Car Shop</h1>
    <div>
      <button @click="viewAddCar" class="btn btn-success float-end">
        Add New Car
      </button>
      <div class="clearfix"></div>
    </div>
  </div>
</template>

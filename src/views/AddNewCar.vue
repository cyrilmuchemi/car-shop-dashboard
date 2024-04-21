<script setup>
import { useRouter } from "vue-router";
import { ref } from "vue";
const router = useRouter();
const carName = ref("");
const carNameErr = ref(false);
const carNameMsg = ref("");
const carPrice = ref(0);
const carPriceErr = ref(false);
const carPriceMsg = ref("");
const carModelYear = ref("");
const carModelYearErr = ref(false);
const carModelYearMsg = ref("");
const goBack = () => {
  router.push({ name: "home" });
};
const validateCarName = () => {
  if (!carName.value) {
    carNameErr.value = true;
    carNameMsg.value = "Enter Car Name";
  } else {
    carNameErr.value = false;
    carNameMsg.value = "";
  }
};
const validateCarPrice = () => {
  if (!carName.value) {
    carPriceErr.value = true;
    carPriceMsg.value = "Enter Car Price";
  } else {
    carPriceErr.value = false;
    carPriceMsg.value = "";
  }
};
const validateCarYear = () => {
  if (!carModelYear.value) {
    carModelYearErr.value = true;
    carModelYearMsg.value = "Enter Car Model Year";
  } else {
    carModelYearErr.value = false;
    carModelYearMsg.value = "";
  }
};
</script>

<template>
  <div class="container">
    <br />
    <button @click="goBack()" class="btn btn-warning">Go Back</button>
    <h1>Add a new car!</h1>
    <div>
      <form method="post" action="#" enctype="multipart/form-data">
        <div class="row g-3 align-items-center mb-3">
          <div class="col-auto d-block mx-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carNameErr }"
            >
              <input
                type="text"
                id="carShopName"
                placeholder="Car Name"
                class="form-control w300"
                v-model.trim="carName"
                @input="validateCarName"
              />
              <label for="carShopName"></label>
              <span class="error-feedback" v-if="carNameErr">
                {{ carNameMsg }}
              </span>
            </div>
          </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
          <div class="col-auto d-block mx-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carPriceErr }"
            >
              <input
                type="number"
                id="carShopPrice"
                placeholder="Car Price"
                class="form-control w300"
                v-model.trim="carPrice"
                @input="validateCarPrice"
              />
              <label for="carPrice"></label>
              <span class="error-feedback" v-if="carPriceErr">
                {{ carPriceMsg }}
              </span>
            </div>
          </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
          <div class="col-auto d-block mx-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carModelYearErr }"
            >
              <input
                type="text"
                id="carShopPrice"
                placeholder="Car Price"
                class="form-control w300"
                v-model.trim="carModelYear"
                @input="validateCarYear"
              />
              <label for="carPrice"></label>
              <span class="error-feedback" v-if="carModelYearErr">
                {{ carModelYearMsg }}
              </span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
.w300 {
  width: 300px !important;
}
.form-data-error input,
.form-data-error textarea {
  color: rgb(218, 28, 28) !important;
}
.error-feedback {
  padding-left: 3px;
}
</style>

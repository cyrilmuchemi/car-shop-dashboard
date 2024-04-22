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
const carImage = ref(null);
const carImageErr = ref(false);
const carImageMSg = ref("");
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
const validateCarImage = () => {
  if (!carImage.value) {
    carImageErr.value = true;
    carImageMSg.value = "Enter Car Imager";
  } else {
    carImageErr.value = false;
    carImageMSg.value = "";
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
              :class="{ 'form-data-error': carImageErr }"
            >
              <input
                type="file"
                id="carShopImage"
                placeholder="Car Image"
                class="form-control w300 customFileField"
                ref="carImage"
                @input="validateCarImage"
              />
              <label for="carShopImage">Car Image</label>
              <span class="error-feedback" v-if="carImageErr">
                {{ carImageMSg }}
              </span>
            </div>
          </div>
        </div>
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
              <label for="carShopName">Car Name</label>
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
              <label for="carPrice">Car Price</label>
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
              <label for="carPrice">Car Model Year</label>
              <span class="error-feedback" v-if="carModelYearErr">
                {{ carModelYearMsg }}
              </span>
            </div>
          </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
          <div class="col-auto d-block mx-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carDescriptionErr }"
            >
              <textarea
                id="carShopDescription"
                placeholder="Car Description"
                class="form-control w300 h125"
                v-model.trim="carDescription"
              >
              </textarea>
              <label for="carShopDescription">Car Description</label>
              <span class="error-feedback" v-if="carDescriptionErr">
                {{ carDescriptionMsg }}
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
.h125 {
  height: 125px;
}
.form-data-error input,
.form-data-error textarea {
  color: rgb(218, 28, 28) !important;
}
.error-feedback {
  padding-left: 3px;
}

.customFileField {
  padding-left: 24px !important;
  padding-top: 38px !important;
  padding-bottom: 10px !important;
  height: 75px !important;
}
</style>

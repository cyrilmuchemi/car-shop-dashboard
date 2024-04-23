<!-- eslint-disable no-constant-condition -->
<script setup>
import { useRouter } from "vue-router";
import { ref } from "vue";
import { onMounted } from "vue";
const router = useRouter();
const carName = ref("");
const carNameErr = ref(false);
const carNameMsg = ref("");
const isCarNameValidated = ref(false);
const carPrice = ref(0);
const carPriceErr = ref(false);
const carPriceMsg = ref("");
const isCarPriceValidated = ref(false);
const carModelYear = ref("");
const carModelYearErr = ref(false);
const carModelYearMsg = ref("");
const isCarModelYearValidated = ref(false);
const carImage = ref(null);
const carImageErr = ref(false);
const carImageMSg = ref("");
const isCarImageValidated = ref(false);
const carDescription = ref("");
const carDescriptionErr = ref(false);
const carDescriptionMsg = ref("");
const isCarDescriptionValidated = ref(false);
const resultSuccess = ref(false);
const resultErr = ref(false);
const resultSuccessMsg = ref("");
const resultErrMsg = ref("");
const Image = ref(null);

const goBack = () => {
  router.push({ name: "home" });
};

const validateCarName = (e) => {
  let target = e.target.value;
  validateCarNameInput(target);
};

const validateCarNameInput = (val) => {
  if (val === "") {
    carNameErr.value = true;
    isCarNameValidated.value = false;
    carNameMsg.value = "Must Enter Car Name";
  } else {
    carNameErr.value = false;
    isCarNameValidated.value = true;
    carNameMsg.value = "";
  }
};

const validateCarPrice = (e) => {
  let val = e.target.value;
  validateCarPriceInput(val);
};

const validateCarPriceInput = (val) => {
  if (val === "") {
    carPriceErr.value = true;
    isCarPriceValidated.value = false;
    carPriceMsg.value = "Please Enter Car Price";
  } else if (val !== "" && isNaN(val)) {
    carPriceErr.value = true;
    isCarPriceValidated.value = false;
  } else if (val < 0) {
    carPriceErr.value = true;
    isCarPriceValidated.value = false;
    carPriceMsg.value = "Car Price Cannot be negative";
  } else if (val === 0 || val === 0.0) {
    carPriceErr.value = true;
    isCarPriceValidated.value = false;
    carPriceMsg.value = "Car Price Cannot be Zero!";
  } else {
    carPriceErr.value = false;
    isCarPriceValidated.value = true;
    carPriceMsg.value = "";
  }
};

const validateCarYear = (e) => {
  let val = e.target.value;
  validateCarYearInput(val);
};

const validateCarYearInput = (val) => {
  if (val === "") {
    carModelYearErr.value = true;
    isCarModelYearValidated.value = false;
    carModelYearMsg.value = "Please Enter Car Model Year! Eg: 2016";
  } else if (/^[0-9]+$/.test(val) === false) {
    carModelYearErr.value = true;
    isCarModelYearValidated.value = false;
    carModelYearMsg.value = "Enter only Years";
  } else if (val.length < 4 || val.length > 4) {
    carModelYearErr.value = true;
    isCarModelYearValidated.value = false;
    carModelYearMsg.value = "Enter a valid year!";
  } else {
    carModelYearErr.value = false;
    isCarModelYearValidated.value = true;
    carModelYearMsg.value = "";
  }
};

const validateFileExtension = (id) => {
  let fileInput = document.getElementById(id);
  let filePath = fileInput.value;
  //Filtering through file types
  let allowedExtensions = /(\.jpg|\.png|\.jpeg|\.gif)$/i;
  if (!allowedExtensions.exec(filePath)) {
    return false;
  } else {
    return true;
  }
};

const validateCarImage = () => {
  if (carImage.value && carImage.value.files[0]) {
    if (validateFileExtension("carShopImage")) {
      carImageErr.value = false;
      isCarImageValidated.value = true;
      carImageMSg.value = "";
      createImage(carImage.value.files[0]);
    } else {
      carImageErr.value = true;
      isCarImageValidated.value = false;
      carImageMSg.value = "Car Image must be: PNG, JPEG, JPG, or GIF";
    }
  } else {
    carImageErr.value = true;
    isCarImageValidated.value = false;
    carImageMSg.value = "Please select an Image!";
  }
};

const validateCarDescription = (e) => {
  const target = e.target.value;
  validateCarDescriptionInput(target);
};

const validateCarDescriptionInput = (val) => {
  if (val === "") {
    carDescriptionErr.value = true;
    isCarDescriptionValidated.value = false;
    carDescriptionMsg.value = "Please Enter Car Description";
  } else if (val.length > 100) {
    carDescriptionErr.value = true;
    isCarDescriptionValidated.value = false;
    carModelYearMsg.value = "Description must be short and precise!";
  } else {
    carDescriptionErr.value = false;
    isCarDescriptionValidated.value = true;
    carModelYearMsg.value = "";
  }
};

const addNewCar = () => {
  if (
    isCarImageValidated.value &&
    isCarNameValidated.value &&
    isCarPriceValidated.value &&
    isCarModelYearValidated.value &&
    isCarDescriptionValidated.value
  ) {
    resultSuccess.value = true;
    resultSuccessMsg.value = "Validated Successfully";
    resultErr.value = false;
    resultErrMsg.value = "";

    let form_data = new FormData();
    form_data.append("name", carName.value);
    form_data.append("price", carPrice.value);
    form_data.append("description", carDescription.value);
    form_data.append("yearModel", carModelYear.value);

    // Check if carImage.value is not null before accessing files
    if (carImage.value && carImage.value.files[0]) {
      form_data.append("image", carImage.value.files[0]);
    }

    // Print form data in console
    for (let pair of form_data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }

    // Send form data via XHR
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost:8080/add/new-car", true);
    xhr.send(form_data);
  } else {
    resultErr.value = true;
    resultErrMsg.value = "Validation Failed";
    validateCarNameInput(carName.value);
    validateCarPriceInput(carPrice.value);
    validateCarYearInput(carModelYear.value);
    validateCarDescriptionInput(carDescription.value);
    validateCarImage();
  }
};

const resetFormError = () => {
  carNameErr.value = false;
  carNameMsg.value = "";
  carPriceErr.value = false;
  carPriceMsg.value = "";
  carModelYearErr.value = false;
  carModelYearMsg.value = "";
  carImageErr.value = false;
  carImageMSg.value = "";
  carDescriptionErr.value = false;
  carDescriptionMsg.value = "";
  resultSuccess.value = false;
  resultSuccessMsg.value = "";
  resultErr.value = false;
  resultErrMsg.value = "";
};

onMounted(() => {
  if (carImage.value && carImage.value.files[0]) {
    console.log(carImage.value.files[0]);
  }
});

const createImage = (file) => {
  const reader = new FileReader();
  reader.onload = () => {
    // Update the reactive variable holding the image source
    Image.value = reader.result;
  };
  reader.readAsDataURL(file);
};

const removeImage = () => {
  Image.value = "";
  setTimeout(() => {
    validateCarImage();
  }, 500);
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
              v-if="!Image"
            >
              <input
                type="file"
                id="carShopImage"
                placeholder="Car Image"
                class="form-control w300 customFileField"
                ref="carImage"
                @input="validateCarImage"
                @change="validateCarImage"
              />
              <label for="carShopImage">Car Image</label>
              <span class="error-feedback" v-if="carImageErr">
                {{ carImageMSg }}
              </span>
            </div>
            <div v-else>
              <span>Upload Car Image: </span><br />
              <img :src="Image" class="w150 rounded" /><br />
              <button
                class="btn btn-outline-danger my-2"
                @click="removeImage()"
              >
                Remove Car Image
              </button>
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
                @input="validateCarName($event)"
                @change="validateCarName($event)"
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
                @input="validateCarPrice($event)"
                @change="validateCarPrice($event)"
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
                @input="validateCarYear($event)"
                @change="validateCarYear($event)"
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
                @input="validateCarDescription($event)"
                @change="validateCarDescription($event)"
              >
              </textarea>
              <label for="carShopDescription">Car Description</label>
              <span class="error-feedback" v-if="carDescriptionErr">
                {{ carDescriptionMsg }}
              </span>
            </div>
          </div>
        </div>
        <div class="row d-grid gap-2 w300 col-auto d-block mx-auto">
          <button class="btn btn-outline-success" @click.prevent="addNewCar()">
            Add New Car
          </button>
          <button
            type="reset"
            @click="resetFormError()"
            class="btn btn-outline-primary mb-3"
          >
            Reset
          </button>
        </div>
        <div class="row d-grid gap-2 w300 col-auto d-block mx-auto mb-3">
          <div
            class="alert alert-success mb-3"
            role="alert"
            v-if="resultSuccess"
          >
            {{ resultSuccessMsg }}
          </div>
          <div class="alert alert-danger mb-3" role="alert" v-if="resultErr">
            {{ resultErrMsg }}
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

.w150 {
  width: 150px !important;
}
.h125 {
  height: 125px !important;
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

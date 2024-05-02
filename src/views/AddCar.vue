<script setup>
    import {ref} from "vue";
    import { useToast } from "vue-toastification";
    import axios from 'axios';

    const submitted = ref(false);
    const Image = ref(null);
    const toast = useToast();

    const resultSuccessMsg = () => {
        toast.success(`New Car Added!`, {
            position: "top-right",
            timeout: 4000,
        });
    }

    const createImage = (file) => {
        const reader = new FileReader();
        reader.onload = () => {
        Image.value = reader.result;
    };
        reader.readAsDataURL(file);
    };

    const onChange = (event) => {
        const file = event.target.files[0];
        if(file){
            createImage(file);
        }else{
            console.error("No file selected");
        }
    }

    const submitHandler = async (value) => {
        // Let's pretend this is an ajax request:
        //console.log(value.carImage[0].file)
        try {
            const formDetails = {
                carName: value.carName,
                carImage: value.carImage[0].file,
                carPrice: value.carPrice,
                carModelYear: value.carModelYear,
                carDescription: value.carDescription
            }

            const form_data = new FormData();
            form_data.append('carImage', Image.value)
            form_data.append('carPrice', formDetails.carPrice)
            form_data.append('carName', formDetails.carName)
            form_data.append('carModelYear', formDetails.carModelYear)
            form_data.append('carDescription', formDetails.carDescription)

            let response = await axios.post(`http://localhost/car-shop-dashboard/src/api/api.php?action=post`, form_data)

            console.log(response);
            
        } catch (error) {
            console.error(error);
        }
    }
</script>

<template>
    <div class="container mx-auto">
        <h1 class="text-center text-2xl mt-10 font-bold">Add a Car</h1>
        <div class="flex flex-col items-center mt-10">
            <FormKit
                type="form"
                id="add-car"
                :form-class="submitted ? 'hide' : 'show'"
                submit-label="Register"
                @submit="submitHandler"
                :actions="false"
                #default="{ value }"
            >
            <div v-if="Image">
                <img :src="Image" alt="car image" width="100"/>
            </div>
            <FormKit
                type="file"
                label="Car Image"
                name="carImage"
                help="Please add an image of the car"
                accept=".jpg,.png,.jpeg,.webp,.gif"
                validation="required"
                @change="onChange" 
            />
            <FormKit
                type="text"
                name="carName"
                label="Car Name"
                placeholder="Nissan"
                help="What is the car's brand name?"
                validation="required"
            />
            <FormKit
                type="date"
                name="carModelYear"
                value="2021-01-01"
                label="Car Model Year"
                help="Enter the car model's year"
                validation="required|date_after:2015-01-01"
                validation-visibility="live"
            />
            <FormKit
                type="number"
                help="What is the car price?"
                label="Car Price"
                number="integer"
                name="carPrice"
                validation="required"  
            />
            <FormKit
                type="textarea"
                name="carDescription"
                label="Car Description"
                placeholder="Remember to write in complete sentences."
                help="`Make a brief description of the car"
                validation="length:0,120"
                validation-visibility="live"
                :validation-messages="{
                    length: 'Instructions cannot be more than 120 characters.',
                }"
            />
    <FormKit type="submit" label="Register" />
    </FormKit>
    </div>
    </div>
</template>
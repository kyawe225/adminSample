<template>
    <form @submit.prevent="submit()">
        <div>
            <label>Full Name</label>
            <input type="text" v-model="employee['Full name']" />
            <div>{{ errorMessage.full_nameMessage }}</div>
        </div>
        <div>
            <label>Email</label>
            <input type="email" v-model="employee.email" />
            <div>{{ errorMessage.emailMessage }}</div>
        </div>
        <div>
            <label>Phone</label>
            <input type="text" v-model="employee.phone" />
            <div>{{ errorMessage.phoneMessage }}</div>
        </div>
        <div>
            <label>Company Id</label>
            <input type="text" v-model="employee.CompanyID" />
            <div>{{ errorMessage.company_idMessage }}</div>
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Employee } from '../../../model/employee';
import {CustomResponseType} from '../../../model/customResponseType';
import { instance } from '../../../services/axiosInstance';
import { onBeforeMount } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const employee = ref<Employee>({
    email: "",
    id: -1,
    "Full name": "",
    phone: "",
    CompanyID: -1,
    created_at: "",
    updated_at: ''
});

const errorMessage = ref({
    full_nameMessage: "",
    emailMessage: "",
    phoneMessage: "",
    company_idMessage: ""
})

const submit = async () => {
    clearMessage();
    if (!Validation()) {
        let request = {
            full_name: employee.value['Full name'],
            email: employee.value.email,
            phone: employee.value.phone,
            company_id: employee.value.CompanyID
        };
        let message: CustomResponseType<string> = (await instance.put('employee/'+ route.params.id, request)).data;
        if (message.status == 200) {
            console.log(message.data);
        }
    }
}

const Validation = () => {
    let errorState = false;
    if (employee.value['Full name'] == "") {
        errorMessage.value.full_nameMessage = "Please fill Employee Full Name";
        errorState = true;
    }
    if (employee.value['email'] == "") {
        errorMessage.value.emailMessage = "Please fill Employee Email";
        errorState = true;
    }
    if (employee.value['phone'] == "") {
        errorMessage.value.phoneMessage = "Please fill Employee Phone";
        errorState = true;
    }
    if (employee.value['CompanyID'] == -1) {
        errorMessage.value.company_idMessage = "Please fill Employee company id";
        errorState = true;
    }
    return errorState;
}

const clearMessage = () => {
    errorMessage.value = {
        full_nameMessage: "",
        emailMessage: "",
        phoneMessage: "",
        company_idMessage: ""
    }
}

onBeforeMount(async () => {
    const employeeU: CustomResponseType<Employee> = (await instance.get("employee/" + route.params.id)).data;
    if (employeeU.status == 200) {
        employee.value = employeeU.data;
    }
})

</script>
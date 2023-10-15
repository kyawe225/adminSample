<template>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="i in employees" @click="employeeClick(i.id)">
                <td>{{ i.id }}</td>
                <td>{{ i["Full name"] }}</td>
                <td>{{ i.email }}</td>
            </tr>
        </tbody>
    </table>

</template>

<script setup lang="ts">
import { ref } from "vue";
import { Employee } from "../../../model/employee";
import { CustomResponseType } from "../../../model/customResponseType";
import { onBeforeMount } from "vue";
import { instance } from "./../../../services/axiosInstance";
import { useRouter } from "vue-router";

const router=useRouter();
const employees = ref<Employee[]>([]);
const message = ref<string>("");

onBeforeMount(async () => {
    const temp:CustomResponseType<Employee[]>=(await instance.get("/employee")).data ;
    if(temp.status==200){
        employees.value=temp.data;
        message.value="";
    }else{
        employees.value=[];
        message.value=temp.error;
    }
})

const employeeClick=(id:number)=>{
    router.push({name:"employeeUpdate",params:{
        id:id
    }});
}
</script>
<script setup>
    import Base from '../layouts/base.vue';
    import { onMounted, ref } from 'vue';
    import Swal from 'sweetalert2';

    let employees = ref([]);

    const showModal = ref(false);
    const hideModal = ref(true);
    let form = ref({
        name: '',
        email: ''
    })

    onMounted(async()=>{
        getEmployees();
    })

    const getEmployees = async () => {
        let response = await axios.get('/api/get_all_employees');
        employees.value = response.data.employees;
    }

    const openModal = () =>{
        showModal.value = !showModal.value;
    }

    const closeModal = () =>{
        showModal.value = !hideModal.value;
        form.value = ({})
        editMode.value = false;
    }

    const sendInvitation = async () => {
        let response = await axios.post('/invite');
        console.log(response);
    } 

    const deleteEmployee = (id) => {
        Swal.fire({
            title: 'Are you sure ?',
            text: "You can't go back",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it' 
        }).then((result)=>{
            if(result.value){
                axios.delete('/api/delete_employee/'+id).then((response)=>{
                    console.log(response)
                    Swal.fire(
                        'Delete',
                        'Company deleted successfully',
                        'success'
                    )
                    getEmployees()
                })
            }
        })
    }

</script>
<template>
    <Base/>
    <main class="main">
            <div class="main__sideNav"></div>
            <div class="main__content">
             <!--==================== USERS ====================-->
            <section class="users section" id="users">
                <div class="users_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Employees</h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal" @click="openModal()">
                                New Employee
                            </div>
                        </div> 
                    </div>

                    <div class="table">

                        <div class="table_filter">
                            <span class="table_filter-Btn ">
                                <i class="fas fa-ellipsis-h"></i>
                            </span>
                            <div>
                                <ul class="table_filter-list">
                                    <li>
                                        <p class="table_filter-link table_filter-link--active">
                                            All
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
            
                        <div class="table_search">
                            <div class="table_search-wrapper">
                                <select class="table_search-select" name="" id="">
                                    <option value="">Filter</option>
                                </select>
                            </div>
                            <div class="relative">
                                <i class="table_search-input--icon fas fa-search "></i>
                                <input class="table_search--input" type="text" placeholder="Search User">
                            </div>
                        </div>
            
                        <div class="user_table-heading">
                            <p>Photo</p> 
                            <p>Name</p>
                            <p>Email</p>
                            <p>Actions</p>
                        </div>
                        <!-- item 1 -->
                        <div class="user_table-items" v-for="item in employees" :key="item.id" v-if="employees.length > 0">
                            <p>
                                <img src="../../../../img/avatar.png" alt="" class="user_img-list">
                            </p>
                            <p>{{ item.name }}</p>
                            <p>{{ item.email }}</p>
                            <div>
                                <button class="btn-icon danger" @click="deleteEmployee(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </section>
            <!-------------- USER MODAL --------------->
            <div class="modal main__modal " :class="{ show: showModal}">
                <div class="modal__content">
                    <span class="modal__close btn__close--modal" @click="closeModal()" >×</span>
                    <h3 class="modal__title">Add Employee</h3>
                    <hr class="modal_line"><br>
                    <form @submit.prevent="sendInvitation()">
                        <div>
                            <p>Name</p>
                            <input type="text" class="input" v-model="form.name"/>

                            <p>Email</p>
                            <input type="text" class="input" v-model="form.email"/>

                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                Cancel
                            </button>
                            <button class="btn btn-secondary">Invite</button>
                        </div>
                    </form>
                </div>
            </div>


            </div>
    </main>
</template>
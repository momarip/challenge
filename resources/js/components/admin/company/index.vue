<script setup>
    import Base from '../layouts/base.vue';
    import { onMounted, ref } from 'vue';
    import Swal from 'sweetalert2';

    let companies = ref([]);

    const showModal = ref(false);
    const hideModal = ref(true);
    const editMode = ref();
    let form = ref({
        name: '',
        type: '',
        description: ''
    })

    onMounted(async()=>{
        getCompanies();
    })

    const getCompanies = async () => {
        let response = await axios.get('/api/get_all_companies');
        companies.value = response.data.companies;
    }

    const openModal = () =>{
        showModal.value = !showModal.value;
    }

    const closeModal = () =>{
        showModal.value = !hideModal.value;
        form.value = ({})
        editMode.value = false;
    }

    const createCompany = async () => {
        await axios.post('/api/create_company', form.value).then(response =>{
            getCompanies()
            closeModal()
            // toast.fire({
            //     'icon': "success",
            //     'title': "Company added successfully"
            // })
        })
    } 
    
    const editModal = (company) => {
        editMode.value = true
        showModal.value = !showModal.value
        form.value = company
    }

    const updateCompany = async () => {
        await axios.post('/api/update_company/'+form.value.id, form.value).then(()=>{
            getCompanies()
            closeModal()
            // toast.fire({
            //     icon: "success",
            //     title: "Company updated successfully"
            // })
        })
    } 

    const deleteCompany = (id) => {
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
                axios.delete('/api/delete_company/'+id).then((response)=>{
                    console.log(response)
                    Swal.fire(
                        'Delete',
                        'Company deleted successfully',
                        'success'
                    )
                    getCompanies()
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
                <!--==================== SERVICES ====================-->
            <section class="services section" id="services">
                <div class="services_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Companies</h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal" @click="openModal()">
                                New Company
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
                                <input class="table_search--input" type="text" placeholder="Search Company">
                            </div>
                        </div>
            
                        <div class="service_table-heading">
                            <p>Name</p> 
                            <p>Type</p>
                            <p style="margin-left: 50px;">Description</p>
                            <p>Actions</p>
                        </div>
                        <!-- item 1 -->
                        <div class="service_table-items" v-for="item in companies" :key="item.id" v-if="companies.length > 0">
                            <p>{{ item.name }}</p>
                            <div class="" >
                                <p>{{ item.type }}</p>
                            </div>
                            <p style="margin-left: 50px;">{{ item.description }}</p>
                            <div>
                                <button class="btn-icon success" @click="editModal(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteCompany(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-------------- COMPANY MODAL --------------->
                <div class="modal main__modal" :class="{ show: showModal}" >
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeModal()" >×</span>
                        <h3 class="modal__title" v-show="editMode == false">Add new company</h3>
                        <h3 class="modal__title" v-show="editMode == true">Update company</h3>
                        <hr class="modal_line"><br>
                        <form @submit.prevent="editMode.value ? createCompany() : updateCompany()">
                            <div>
                                <p>Company Name</p>
                                <input type="text" class="input" v-model="form.name"/>

                                <p>Company type</p>
                                <input type="text" class="input" v-model="form.type" />
                                <p>Company Description</p>
                                <textarea type="text" class="input" v-model="form.description"></textarea>
                            </div>
                            <br><hr class="modal_line">
                            <div class="model__footer">
                                <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                    Cancel
                                </button>
                                <button class="btn btn-secondary" v-show="editMode == false">Save</button>
                                <button class="btn btn-secondary" v-show="editMode == true">Update</button>
                            </div>
                    </form>
                    </div>
                </div>
            </section>

            </div>
    </main>
</template>
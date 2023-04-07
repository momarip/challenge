<template>
    <!-- Nav Main -->
    <nav class="nav">
            <div class="nav_wrapper">
                <span class="nav_close">
                    <i class="fas fa-window-close"></i>
                </span>
                <ul class="nav_list">
                    <li class="nav_item">
                        <router-link class="nav_link nav__active" href="#" to="/" >
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Home
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link class="nav_link " href="#" to="/admin/company">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Companies
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link class="nav_link " href="#" to="/admin/employee">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Employees
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Nav Main -->
</template>
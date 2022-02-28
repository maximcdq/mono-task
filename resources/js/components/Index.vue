<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 shadow"
             id="mainNav">
            <div class="container">
                <b>
                    <router-link class="nav-link me-lg-4 navbar-brand"
                                 :to="{name: 'home'}">Accounting system parking
                    </router-link>
                </b>
                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarResponsive"
                        aria-controls="navbarResponsive"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse"
                     id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <router-link class="nav-link me-lg-4"
                                     :to="{name: 'home'}"
                                     exact active-class="active">Home
                        </router-link>
                        <router-link class="nav-link me-lg-4"
                                     :to="{name: 'view'}"
                                     active-class="active">View
                        </router-link>
                        <router-link class="nav-link me-lg-4"
                                     :to="{name: 'create'}"
                                     active-class="active">Create
                        </router-link>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

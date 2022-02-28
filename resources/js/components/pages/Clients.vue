<template>
    <div>
        <div class="d-flex flex-column align-items-center" >
            <div class="d-flex"
                 style="width: 100%">
                <table class="table orders table-bordered mt-4">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Автомобиль</th>
                        <th scope="col" colspan="3">Номер</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(c, index) in clients">
                        <td>{{ index + 1 }}</td>
                        <td>{{ c.name }}</td>
                        <td>{{ c.brand + ' ' + c.model }}</td>
                        <td >{{ c.number }}</td>
                        <td style="max-width: 10rem"><router-link
                            class="nav-link me-lg-4"
                            :to="'/edit/client-' + c.id">
                            <i class="bi bi-pencil-fill"></i>
                            <button type="button"
                                    class="btn btn-outline-dark"> Изменить
                            </button>
                        </router-link>
                        </td>
                        <td style="max-width: 10rem">
                            <a class="nav-link me-lg-4"
                               @click="deleteClient(c.id)">
                            <button type="button"
                                    class="btn btn-outline-danger">Удалить
                            </button></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <nav aria-label="Page navigation example"
             class="mb-5">
            <ul class="pagination"
                style="cursor: pointer;">
                <li class="page-item"
                    v-bind:class="{disabled:isCurrentPage(1)}">
                    <a class="page-link"
                       @click.prevent="getActiveClientsData(dataPage.prev_page_url)">Назад
                    </a>
                </li>
                <li class="page-item"
                    v-for="pageNumber in dataPage.links.length - 2"
                    v-bind:class="{disabled:isCurrentPage(pageNumber)}">
                    <a class="page-link"
                       @click="getActiveClientsData(pageNumber)"> {{ pageNumber }}
                    </a>
                </li>
                <li class="page-item"
                    v-bind:class="{disabled:isCurrentPage(dataPage.last_page)}">
                    <a class="page-link"
                       @click.prevent="getActiveClientsData(dataPage.next_page_url)">Следующая</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dataPage: [],
            clients: []
        }
    },
    mounted() {
        this.getActiveClientsData('/service/clients')
    },
    methods: {
        getActiveClientsData(page) {
            page = typeof page === 'number' ? '/service/clients?page=' + page : page
            axios.get(page).then(res => {
                this.dataPage = res.data
                this.clients = this.dataPage.data
            })
        },
        deleteClient(id) {
            axios.delete('/service/clients/' + id).then(() => {
                this.getActiveClientsData(this.dataPage.current_page)
            })
            this.clients = this.clients.filter(c => c.number !== number)
        },
        isCurrentPage(page) {
            return page === this.dataPage.current_page
        }
    }
}
</script>


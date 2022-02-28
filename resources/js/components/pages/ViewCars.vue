<template>
    <div class="d-flex justify-content-center">
        <div class="mt-4 d-flex flex-column"
             style="width: 75%">
            <div class="d-flex justify-content-between">
                <select class="form-select form-select-lg mb-3"
                        style="width: 30rem"
                        aria-label=".form-select-lg example"
                        @change="getCarClient($event.target.value)">
                    <option v-for="client in clients"
                            :value="client.id">
                        {{ client.name }}
                    </option>
                </select>
                <select class="form-select form-select-lg mb-3"
                        aria-label=".form-select-lg example"
                        style="width: 30rem"
                        v-model="car">
                    <option v-for="car in carClient"
                        :value="car">
                        {{ car.model + ' ' + car.brand }}
                    </option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-dark w-25"
                        @click.prevent="addActiveStatus()"
                        v-if="carClient.length">
                    Добавить на автостоянку
                </button>
            </div>
            <table class="table orders table-bordered mt-4">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Автомобиль</th>
                    <th scope="col" colspan="2">Номер</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="car in activeCars">
                    <td>{{ car.brand + ' ' + car.model }}</td>
                    <td>{{ car.number }}</td>
                    <td style="max-width: 5rem">
                        <button class="btn btn-outline-danger"
                                @click="addDeactivateStatus(car)">Убрать с автостоянки
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clients: [],
            carClient: [],
            activeCars: [],
            car: {}
        }
    },
    mounted() {
        this.getAllClients()
        this.getCarsInParking()
    },
    methods: {
        getAllClients() {
            axios.get('/service/view/deactivate-clients').then(res => {
                this.clients = res.data
                this.getCarClient(this.clients[0].id)
            })
        },
        getCarClient(id) {
            axios.get('/service/view/cars/' + id).then(res => {
                this.carClient = res.data
                this.car = {}
            })
        },
        getCarsInParking() {
            axios.get('/service/view/active-cars').then(res => {
                this.activeCars = res.data
            })
        },
        addActiveStatus() {
            axios.get('/service/view/active/' + this.car.number).then(() => {
                this.carClient = this.carClient.filter(c => c.number !== this.car.number)
                this.activeCars.push(this.car)
            })
        },
        addDeactivateStatus(car) {
            axios.get('/service/view/deactivate/' + car.number).then(() => {
                this.activeCars = this.activeCars.filter(c => c.number !== car.number)
                this.car = car
                this.carClient.push(this.car)
            })
        }
    }
}
</script>

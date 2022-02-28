<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="d-flex flex-column"
             style="width: 80%;">
            <form @submit.prevent>
                <div class="form-group">
                    <label for="name">ФИО</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           v-model="clients.name">
                </div>
                <div class="form-group">
                    <label for="sex">Пол:</label>
                    <select class="form-control form-control"
                            id="sex"
                            v-model="clients.sex">
                        <option value="male">мужской</option>
                        <option value="female">женский</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text"
                           class="form-control"
                           id="address"
                           v-model="clients.address">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text"
                           class="form-control"
                           id="phone"
                           v-model="clients.phone">
                </div>
                <button class="btn-lg btn-dark mt-4"
                        @click="saveClient()"
                        type="button">Сохранить клиента</button>
            </form>
            <hr>
            <form>
                <div v-for="(car, index) in cars"><b>Автомобиль: {{ index + 1 }}</b> <br>
                    <span>Статус: {{ car.status === 1 ? 'Находится на стоянке' : 'Не находится на стоянке' }}</span>
                    <div class="form-group">
                        <label :for="'brand_' + index">Марка автомобиля</label>
                        <input class="d-none"
                               v-model="car.id">
                        <input type="text"
                               class="form-control"
                               :id="'brand_' + index"
                               v-model="car.brand">
                    </div>
                    <div class="form-group">
                        <label :for="'model_' + index">Модель автомобиля</label>
                        <input type="text"
                               class="form-control"
                               :id="'model_' + index"
                               v-model="car.model">
                    </div>
                    <div class="form-group">
                        <label :for="'color_' + index">Цвет кузова</label>
                        <input type="text"
                               class="form-control"
                               :id="'color_' + index"
                               v-model="car.color">
                    </div>

                    <div class="form-group">
                        <label :for="'number_' + index">Государственный номер</label>
                        <input type="text"
                               class="form-control mb-3"
                               :id="'number_' + index"
                               v-model="car.number">
                    </div>
                    <button type="button"
                            class="btn btn-danger mb-4"
                            @click="removeItem(car)"
                            v-if="cars.length >= 2"> Удалить
                    </button>
                </div>
                <button class="btn-lg btn-dark mt-4 mr"
                        @click="saveAutomobile()"
                        type="button">Сохранить авто</button>
                <button type="button"
                        class="btn-lg btn-outline-dark mt-4 mb-5"
                        @click="addInput">Добавить авто</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clients: [],
            cars: [],
            newCars: []
        }
    },
    mounted() {
        this.getClient()
    },
    methods: {
        getClient() {
            const id = this.$route.params.id
            axios.get('/service/clients/' + id).then(res => {
                this.clients = res.data[0]
                this.cars = res.data
            })
        },
        saveClient() {
            const client = {
                name: this.clients.name,
                sex: this.clients.sex,
                address: this.clients.address,
                phone: this.clients.phone,
            }
            axios.put('/service/clients/' + this.$route.params.id, {client}).then(() => {
                this.$router.push({name: 'home'})
            })

        },
        saveAutomobile() {
            const newCars = this.newCars
            const cars = this.cars
            this.newCars.length ? axios.post('/service/auto', {newCars}) : true
            axios.put('/service/auto/' + this.$route.params.id, {cars}).then(() =>
                this.$router.push({name: 'home'})
            )
        },
        addInput() {
            this.cars.push({
                id: this.clients.automobiles+= 1,
                brand: '',
                model: '',
                color: '',
                number: '',
                client_id: this.$route.params.id
            })
            this.newCars.push(this.cars[this.cars.length- 1])
        },
        removeItem(car) {
            this.clients.automobiles-= 1
            this.cars = this.cars.filter(c => c.id !== car.id)
            axios.delete('/service/auto/' + car.id)
        }
    }
}
</script>



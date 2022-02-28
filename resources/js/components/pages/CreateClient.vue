<template>
    <div class=" mt-5 d-flex justify-content-center">
        <div  style="width: 75%"
              class="d-flex flex-column">
            <form @submit.prevent>
                <div class="clients">
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               v-model="client.name">
                    </div>
                    <div class="form-group">
                        <label for="sex">Пол:</label>
                        <select class="form-control form-control"
                                id="sex"
                                v-model="client.sex">
                            <option selected value="male">мужской</option>
                            <option value="female">женский</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input
                            type="text"
                            class="form-control"
                            id="address"
                            v-model="client.address">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text"
                               class="form-control"
                               id="phone"
                               v-model="client.phone">
                    </div>
                </div>
                <hr>
                <button type="button"
                        class="btn-lg btn-dark mt-4"
                        @click="createClient">Отправить</button>
                <hr class="mb-5">
            </form>
            <form>
                <div v-for="(label, index) in labels">
                    <b>Автомобиль: {{ index + 1 }}</b>
                    <div class="form-group">
                        <label :for="'brand_' + index">Марка автомобиля</label>
                        <input type="text"
                               class="form-control"
                               :id="'brand_' + index"
                               v-model="label.brand">
                    </div>
                    <div class="form-group">
                        <label :for="'model_' + index">Модель автомобиля</label>
                        <input type="text"
                               class="form-control"
                               :id="'model_' + index"
                               v-model="label.model">
                    </div>
                    <div class="form-group">
                        <label :for="'color_' + index">Цвет кузова</label>
                        <input type="text"
                               class="form-control"
                               :id="'color_' + index"
                               v-model="label.color">
                    </div>
                    <div class="form-group">
                        <label :for="'number_' + index">Государственный номер</label>
                        <input type="text"
                               class="form-control mb-3"
                               :id="'number_' + index"
                               v-model="label.number">
                    </div>
                    <button type="button"
                            class="btn btn-danger mb-4"
                            @click="removeItem(label.id)"
                            v-if="label.id > 1">
                        Удалить</button>
                </div>
                <button type="button"
                        class="btn-lg btn-dark mb-5"
                        @click="addInput">Добавить авто</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            client: {
                name: '',
                sex: '',
                address: '',
                phone: '',
                carCount: 1,
                cars: [],
            },
            labels: [{id: 1}],
            errors: []
        }
    },
    methods: {
        createClient() {
            const client = {
                name: this.client.name,
                sex: this.client.sex,
                address: this.client.address,
                phone: this.client.phone,
                carCount: this.client.carCount,
                cars: []
            }
            client.cars.push(...this.labels)
            axios.post('/service/clients', { client }).then(() => {
                this.$router.push({ name: 'home' })
            }).catch(error => this.errors = error.response.data.errors)
        },
        addInput() {
            this.labels.push({
                id: this.client.carCount+= 1,
                brand: '',
                model: '',
                color: '',
                number: ''
            })
        },
        removeItem(id) {
            this.labels = this.labels.filter(c => c.id !== id)
            this.client.carCount-= 1
        }
    }
}
</script>

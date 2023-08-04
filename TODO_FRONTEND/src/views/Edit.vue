<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Add TODO</h2>
                <form @submit.prevent="updateItems">
                    <textarea name="addTodo" v-model="item.description" cols="50" rows="5"></textarea><br>
                    <!-- <button class="btn btn-info">add +</button> -->
                    <button type="submit" class="btn btn-primary">Add TODO</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name: 'itemEdit',
    itemsId: '',
    data(){
        return{
            item: {
                description: '',
            }
        }
    },

    mounted() {
        this.itemsId = this.$route.params.id;
        this.getItemData(this.$route.params.id);
    },
    methods: {
    getItemData(itemsId) {
        axios.get(`http://localhost:8000/api/item/${this.itemsId}/edit`)
        .then(res => {
            console.log(res.data);

            this.item = res.data
        })
    },

    updateItems() {
        axios.put(`http://localhost:8000/api/item/${this.itemsId}`, this.item)
        .then(res => {
            // console.log(res)
            alert('Data updated successfully')
        })
        .catch(error => {
            console.log('An error occurred while updating items:', error);
        });
    }
    }

}
</script>
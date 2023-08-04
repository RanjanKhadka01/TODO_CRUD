<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Add TODO</h2>
                <form @submit.prevent="addTodo">
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
name: 'todocreate',
    data() {
        return{
            item: {
                description: '',
            }
        }
    },

    methods: {
        addTodo() {
            axios.post(`http://127.0.0.1:8000/api/item/store`, this.item)
            .then(res => {
                if(res.status == 201) {
                    this.item.description = "";
                    this.$emit("reloadlist");
                }
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
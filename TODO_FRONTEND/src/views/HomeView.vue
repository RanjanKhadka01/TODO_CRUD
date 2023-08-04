
<template>
  <main>
    <h1>This is Home Page</h1>
  </main>
  <div class="container">
    <div class="card">
    <div class="card-header text-center">
      <RouterLink to="/items/create">Add TODO</RouterLink>
      <h2>TODO List</h2>
    </div>
    <table class="table">
      <thead>
        <th>Completed</th>
        <th>Todo List</th>
        <!-- <th>Status</th> -->
        <th>Actions</th>
      </thead>
      <tbody>
        <tr v-for="(items, index) in this.items" :key="index.id">
          <!-- <td>{{index}}</td> -->
          <td><input class="btn" type="checkbox"></td>
          <td>{{items.description}}</td>
          <!-- <td>{{items.completed}}</td> -->
          <td>
            <RouterLink :to="{path: '/item/'+items.id+'/edit'}" class="btn btn-primary">Edit</RouterLink>
            <button @click="deleteItem(items.id)" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</template>

<script>
import axios from 'axios';
import { RouterLink } from 'vue-router';

export default {
    data() {
        return {
            items: []
        };
    },
    methods: {
        getItems() {
            axios.get('http://127.0.0.1:8000/api/items')
                .then(res => {
                // console.log(res);
                this.items = res.data;
            })
                .catch(error => {
                console.log(error);
            });
        },

        deleteItem(itemsId) {
      // console.log(itemsId)
      if(confirm('Are you sure you want to delete ?')) {
        axios.delete(`http://localhost:8000/api/item/${itemsId}`)
        .then(res => {
          alert('Item Deleted Successfully');
          this.getItems();
        });
      }
    }
    },
    mounted() {
        this.getItems();
    },

    components: { RouterLink }
}
</script>

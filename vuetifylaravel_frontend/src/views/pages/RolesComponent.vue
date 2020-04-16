<template>
  <v-app>
      <v-data-table
    :headers="headers"
    :items="roles"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Role Management System</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="error" v-on="on">Add New Role</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12">
                    <v-text-field v-model="editedItem.name" label="Role Name"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <button class="btn btn-primary" @click="initialize">Reset</button>
    </template>


  </v-data-table>
  </v-app>
</template>



<script>

import '../../../node_modules/admin-lte/dist/js/adminlte.min.js'

import axios from '../../axios';

  export default {
    data: () => ({
      dialog: false,
      headers: [
        {
          text: '#',
          align: 'start',
          sortable: false,
          value: 'id',
        },
        { text: 'Name', value: 'name' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      roles: [],
      editedIndex: -1,
      editedItem: {
        id: '',
        name: '',
        created_at: '',
        updated_at: '',
      },
      defaultItem: {
        id: '',
        name: '',
        created_at: '',
        updated_at: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {

        axios.get('roles',{})
        .then(res => this.roles = res.data.roles)
        .catch(err => {
          if(err.response.status == 401){
            localStorage.removeItem('token');
            this.$router.push('/login');
          }
        })
      },



      editItem (item) {
        this.editedIndex = this.roles.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.roles.indexOf(item)
        let decide = confirm('Are you sure you want to delete this item?')

        if(decide){
          axios.delete('roles/'+item.id)
          .then(() => {
            this.roles.splice(index, 1)
          })
          .catch(err => console.log(err.response))
        }
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1)
        {
          axios.put('roles/'+this.editedItem.id, {'name': this.editedItem.name})
          .then(res => Object.assign(this.roles[this.editedIndex], res.data.role))
          .catch(err => console.log(err.response))
          //Object.assign(this.roles[this.editedIndex], this.editedItem)
        }
        else
        {
          axios.post('roles',{'name': this.editedItem.name})
          .then(res => this.roles.push(res.data.role))
          .catch(err => console.dir(err.response))
        }
        
        this.close()
      },
    },
  }
</script>



<style scoped>

</style>
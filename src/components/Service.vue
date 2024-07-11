<template>
    <div>
    <div class="d-flex justify-space-around align-center py-4">
      <v-btn
        icon="mdi-minus"
        variant="text"
        @click="model = Math.max(model - 1, 0)"
      ></v-btn>
      {{ model }}
      <v-btn
        icon="mdi-plus"
        variant="text"
        @click="model = Math.min(model + 1, 4)"
      ></v-btn>
    </div>
    <v-carousel v-model="model">
        <template
            v-for="(item, i) in idservice"
        :key="i"
        :value="i">
      <v-carousel-item
       v-if="props.type==item.type"
      >
        
          <div class="d-flex fill-height justify-center align-center">
            <div>
            <v-img :src="item.image_slide" width="600" height="400">
            <div class="text-h2">
               {{ item.titre }}
            </div>
            <div class="text-h2">
               {{ item.description }}
            </div>
        </v-img>
            </div>
          </div>
      
      </v-carousel-item>
    </template>
    </v-carousel>
  </div>
  
</template>
<script setup>
import axios from "axios";
import { defineProps } from 'vue';
const props = defineProps(['type']);
console.log(props.type);
</script>

<script>
 export default {
    data () {
      return {
        colors: [
          'primary',
          'secondary',
          'yellow darken-2',
          'red',
          'orange',
        ],
        model: 0,
      idservice: [],
        service:[],
      detailsModal: false,
      selectedItem: null,
      }
    },
    mounted() {
    this.fetchidservice();
  },
    methods: {
    fetchidservice() {
      axios.get('http://zoo-project.local/service.php?action=afficher_service',{withcredentials: true})
        .then(response => {
          this.idservice = response.data;
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  },
  }
</script>

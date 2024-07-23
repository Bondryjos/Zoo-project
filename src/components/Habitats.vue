<template>
    <v-parallax
    height="300"
    src="../assets/Default_jungle_habitat_for_animals_0.jpg">
    <div class="d-flex flex-column fill-height justify-center align-center text-white">
      <h1 class="text-h4 font-weight-thin mb-4">
        Zoo Arcadia
      </h1>
      <h4 class="subheading">
        Habitats
      </h4>
    </div>
  </v-parallax>
  <v-row class="mt-6">
    <v-col cols="12" md="6">
        <v-carousel
    height="400"
    progress="primary"
    hide-delimiters
  >
    <v-carousel-item
      v-for="(slide, i) in idanimalphoto"
      :key="i"
    >
      <v-sheet
        height="100%"
      >
        <div class="d-flex fill-height justify-center align-center">
          <img :src="slide.image_top" alt="Carousel Image" class="carousel-image" />
        </div>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
    </v-col>
    <v-col cols="12" md="6">
<h2>{{ animal.prenom }}</h2>
<p>{{ animal.etat }}</p>
<p>{{ animal.description }}</p>
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12" md="8">
<h2>Mode de vie</h2>
<p>{{ animal.mode_de_vie }}</p>
<h2></h2>
<p></p>

    </v-col>
    <v-col cols="12" md="4">
<v-card style="background-color:#debc6f;height: 500;">
<h2>information</h2>
<p>{{ animal.information}}</p>
</v-card>
    </v-col>
  </v-row>
  <v-sheet
    class="mt-6 mx-auto"
    elevation="8"
    max-width="1200"
  >
  <v-slide-group>
    <template
    v-for="item in idanimal"
      :key="item.idanimal">
    <v-slide-group-item
      
      v-slot="{ isSelected,selectedClass }"
      v-if="props.type==item.habitat_idhabitat"
    >
      <v-card
        :class="['ma-4', selectedClass, 'd-flex', 'flex-column']"
        height="100"
        width="100"
        @click="chargeranimal(item)"
      >
          <v-img
            :src="item.image"
            class="fill-height"
            style="object-fit: cover; height: 100%; width: 100%;"
          ></v-img>
          <h2>{{ item.prenom }}</h2>

        <div class="d-flex fill-height align-center justify-center">
          <v-scale-transition>
            <v-icon
              v-if="isSelected"
              color="white"
              icon="mdi-close-circle-outline"
              size="48"
            ></v-icon>
          </v-scale-transition>
        </div>
      </v-card>
    </v-slide-group-item>
  </template>
  </v-slide-group>
  </v-sheet>
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
        idanimal:[],
        idanimalphoto:[],
        animal:{}
      }
    },
    mounted() {
    this.fetchidanimal();
    this.fetchidanimalphoto();
  },
    methods: {
      chargeranimal(item){this.animal=item;this.fetchidanimalphoto(item.idanimal)},
    fetchidanimal() {
      axios.get('http://zoo-project.en.gp/php/animaux.php?action=afficher_animaux',{withcredentials: true})
        .then(response => {
          this.idanimal= response.data;
         var url= new URL(window.location.href)
          var animalid = url.searchParams.get('animal')
          this.idanimal.forEach(animal => {
            if (animalid==animal.idanimal){
          this.animal=animal;
          this.fetchidanimalphoto(animalid);
            }
        });
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    fetchidanimalphoto(animalid) {
      axios.get('http://zoo-project.en.gp/php/animaux.php?action=recuperer_photo&animalid='+animalid,{withcredentials: true})
        .then(response => {
          this.idanimalphoto= response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    
  },

  }
</script>
  
 
  
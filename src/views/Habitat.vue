<template>
    <NavBar/> 
    <v-carousel>
  <v-carousel-item
    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
    cover
  ></v-carousel-item>

  <v-carousel-item
    src="https://cdn.vuetifyjs.com/images/cards/hotel.jpg"
    cover
  ></v-carousel-item>

  <v-carousel-item
    src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
    cover
  ></v-carousel-item>
</v-carousel>
<v-container>
    <v-row>
        <v-col cols="12" md="6">
  <v-card
    class="mt-12 pr-12"
    elevation="24"
    max-width="444"
  >
    <v-carousel
      :continuous="false"
      :show-arrows="false"
      delimiter-icon="mdi-square"
      height="300"
      hide-delimiter-background
    >
      <v-carousel-item
        v-for="(slide, i) in slides"
        :key="i"
      >
        <v-sheet
          :color="colors[i]"
          height="100%"
          tile
        >
          <div class="d-flex fill-height justify-center align-center">
            <div class="text-h2">
              {{ slide }} Slide
            </div>
          </div>
        </v-sheet>
      </v-carousel-item>
    </v-carousel>
  </v-card>


        </v-col>
        <v-col cols="12" md="6">
         <h2 style="color:orange">Une savane </h2>
         <p class="mt-6">Le Lorem Ipsum est simplement du faux texte employé dans la composition 
            et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard 
            de l'imprimerie depuis les années 1500</p>
         <h2 class="mt-12" style="color:orange">Une jungle</h2>
         <p class="mt-6">Le Lorem Ipsum est simplement du faux texte employé dans la composition 
            et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 
            l'imprimerie depuis les années 1500</p>
         <h2 class="mt-12" style="color:orange">Un marais</h2>
         <p class="mt-6">Le Lorem Ipsum est simplement du faux texte employé dans la composition 
            et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de
             l'imprimerie depuis les années 1500</p>
        </v-col>

    </v-row>
    <h2 class="mt-6 text-center">Les animaux de notre Zoo</h2>
      <v-row justify="center" class="mt-12">
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/savane' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000" >
    <v-card-title class="mt-12 pl-12">Animaux savane</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;font-size: 36px">
      16
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/jungle' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000">
    <v-card-title class="mt-12 pl-12">Animaux jungle</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;font-size: 36px">
      25
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/marais' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000">
    <v-card-title class="mt-12 pl-12">Animaux marais</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;font-size: 36px">
     10
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
</v-row>
<v-row class="justify-center">
  <v-col cols="12" md="2">
<v-menu>
      <template v-slot:activator="{ props }">
        <v-btn
          color="#8aa35a"
          v-bind="props"
        >
          Habitat
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          :value="index"
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-col>
  <v-col cols="12" md="2">
    <v-menu>
      <template v-slot:activator="{ props }">
        <v-btn
          color="#8aa35a"
          v-bind="props"
        >
          Race
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          :value="index"
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    </v-col>
    <v-col cols="12" md="2">
    <v-btn color="#8aa35a"><v-icon style="font-size: 36px;">mdi-magnify</v-icon>rechercher</v-btn>
  </v-col>
  </v-row>
<v-sheet
    class="mt-6 mx-auto"
    elevation="8"
    max-width="1200"
  >
    <v-slide-group
      v-model="model"
      class="pa-4"
      selected-class="bg-success"
      show-arrows
    >
      <v-slide-group-item
        v-for="n in 15"
        :key="n"
        v-slot="{ isSelected, toggle, selectedClass }"
      >
      <v-card
        :class="['ma-4', selectedClass, 'd-flex', 'flex-column']"
        height="100"
        width="100"
        @click="toggle"
        v-for="(item, index) in idanimal" :key="index"
      ><router-link :to="{ path: '/'+(habitats[item.habitat_idhabitat]?habitats[item.habitat_idhabitat].nom:'')}" class="nav-link"><v-img
         :src="item.image"
         class="fill-height"
            style="object-fit: cover; height: 100%; width: 100%;"
            
        ></v-img> <h2>{{ item.prenom }}</h2></router-link>
       
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
    </v-slide-group>
  </v-sheet>
  <v-row class="mt-6">
    <v-col cols="12" md="8">
<h2 class="mt-2">Le mot du vétérinaire</h2>
<h4 class="mt-4" style="color:orange">Information sur les animaux du zoo</h4>
<p class="mt-6">Le Lorem Ipsum est simplement du faux texte employé dans la composition
     et la mise en page avant impression. Le Lorem Ipsum est le faux texte
      standard de l'imprimerie depuis les années 1500</p>
    </v-col>
    <v-col cols="12" md="4">
        <v-img
    src="../assets/Default_image_where_a_man_asks_for_information_at_a_zoo_2.jpg"
  ></v-img>
    </v-col>
  </v-row>
</v-container>
    <Footer/>
</template>
<script setup>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import axios from "axios";
  
</script>
<script>
  export default {
    data () {
      return {
        colors: [
          'green',
          'secondary',
          'yellow darken-4',
          'red lighten-2',
          'orange darken-1',
        ],
        items: [
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
      ],
        slides: [
          'First',
          'Second',
          'Third',
          'Fourth',
          'Fifth',
        ],
        idanimal: [],
        habitats:[],
      detailsModal: false,
      selectedItem: null,
      
      }
    },
    mounted() {
    this.fetchidanimal();
  },
    methods: {
      countanimal() {

      },
    fetchidanimal() {
      axios.get('http://zoo-project.en.gp/php/animaux.php?action=afficher_animaux',{withcredentials: true})
        .then(response => {
          this.idanimal = response.data;
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
        axios.get('http://zoo-project.local/habitat.php?action=afficher_habitat',{withcredentials: true})
        .then(response => {
          this.habitats = response.data;
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  },
  }
</script>
<style scoped>

.nav-link{
  text-decoration: none;
}
.text-black{
  color:green;
}

  
</style>
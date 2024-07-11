<template>
 <NavBar/> 
  <v-main>
    <v-container fluid>
      <v-row>
<v-col cols="12" md="6">
  <v-img src="@/assets/Default_Give_me_an_image_of_a_zoo_that_brings_together_animals_1-removebg-preview.png"
height="600"
        contain>
</v-img>
</v-col>
<v-col cols="12" md="6">
<h2 class="text-center">Visiter notre Zoo</h2>
<p class="mt-12" style="font-size: 20px ;"  data-aos="flip-right">Arcadia est un zoo situé en France près de la forêt de Brocéliande, en bretagne depuis 1960. 
Ils possèdent tout un panel d’animaux, réparti par habitat (savane, jungle, marais) et font 
extrêmement attention à leurs santés. Chaque jour, plusieurs vétérinaires viennent afin 
d’effectuer les contrôles sur chaque animal avant l’ouverture du zoo afin de s’assurer que tout 
se passe bien, de même, toute la nourriture donnée est calculée afin d’avoir le bon grammage 
(le bon grammage est précisé dans le rapport du vétérinaire). 
Le zoo, se porte très bien financièrement, les animaux sont heureux. Cela fait la fierté de son 
directeur, José, qui a de grandes ambitions.</p>
</v-col>
      </v-row>
      <v-row justify="center">
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/restauration' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000" >
    <v-card-title class="mt-12 pl-12">Restauration</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;">
      <v-icon style="font-size: 36px;">mdi-food</v-icon>
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/visitetrain' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000">
    <v-card-title class="mt-12 pl-12">Visite en train</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;">
      <v-icon style="font-size: 36px;">mdi-train</v-icon>
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
  <v-col cols="12" sm="3">
    <router-link :to="{ path: '/visitehabitat' }" class="nav-link">
    <div class="red darken-1" style="height: 200px; width: 250px;">
  <v-card style="height: 100%; background-color: #8aa35a;" data-aos="fade-up"
  data-aos-duration="3000">
    <v-card-title class="mt-12 pl-12">Visite des habitats</v-card-title>
    <v-card-text class="d-flex justify-center align-center" style="flex-grow: 1;">
      <v-icon style="font-size: 36px;">mdi-paw</v-icon>
    </v-card-text>
  </v-card>
</div>
</router-link>
  </v-col>
</v-row>
      <v-col cols="12" sm="12">
        <h1 class="text-center">Les différents habitat de nos animaux</h1>
        <v-row justify="center">
          <v-col cols="12" sm="10">
            <v-row justify="center">
              <v-col cols="12" sm="3" v-for="(hotel, i) in hotels" :key="i">
              <v-hover v-slot="{isHovering,props}">
                <router-link :to="{ path: '/visitehabitat' }" class="nav-link">
                <v-card class="mx-auto" color="grey-lighten-4" max-width="600" v-bind="props" :data-aos="animations[i]" data-aos-duration="3000">
                <v-img :aspect-ratio="16 /9" cover :src="hotel.image">
                  <v-expand-transition>
                    <div v-if="isHovering" class="d-flex transition-fast-in-fast-out bg-yellow darken-4 v-card--reveal" style="height: 100%;">
                      <h1>savane</h1>
                    </div>
                  </v-expand-transition>
                </v-img>
                </v-card>
              </router-link>
              </v-hover>
            </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>

      <v-col cols=12 sm="12">
          <h1 class="text-center">Les avis du zoo</h1>
          <v-sheet class="mx-auto" elevation="8" max-width="1250" color="#72913a">
            <v-slide-group v-model="model" class="pa-4" center-active show-arrows>
              <v-slide-group-item v-for="travel in travels" :key="travel" v-slot="{isSelected, toggle}">
                <v-card :color="'#8aa35a '" class="ma-4" height="300" width="250" @click="toggle" flat data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
                  <div class="d-flex fill-height align-center justify-center">
                    <v-card-title>
                      {{ travel.title }}
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                      
                    </v-card-text>
                  </div>
                </v-card>
              </v-slide-group-item>
            </v-slide-group>
          </v-sheet>
      </v-col>
      <v-row class="d-flex justify-center">
        <div class="text-center">
                        <v-btn class="mt-4" color="#72913a" @click="sheet = !sheet">Laissez un commentaire</v-btn>
                        <v-bottom-sheet v-model="sheet" inset>
      <v-card
        class="text-center"
        height="200"
      >
        <v-card-text>
          <v-btn
            variant="text"
            @click="sheet = !sheet"
          >
            close
          </v-btn>

          <br>
          <br>

          <v-form   @submit.prevent="submitForm" id="Avis_users" class="mt-6">
  <v-text-field
    name="nom"
    label="Name"
    required
  ></v-text-field>
  
  <v-textarea
                            v-model="description"
                            name="description"
                            :rules="rules"
                            label="description"
                            rows="5"
                            outlined
                        ></v-textarea>



 

  <div class="d-flex flex-column">
    <input type="hidden" name="AvisUsers" value="1">
    <v-btn
      color="orange"
      class="mt-4"
      block
      type="submit"
    >
      envoyer
    </v-btn>  
    <span :style="{ backgroundColor: retouravistype=== true ? 'green' : (retouravistype=== false ? 'red' : 'blue') }">{{ retouravis }}</span> 
  </div>
</v-form>
        </v-card-text>
      </v-card>
    </v-bottom-sheet>
  </div>
                    </v-row>
                    <v-row>
                    <v-col cols="12" md="6">
                    <v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent style="background-color:#72913a;">
      <v-text-field
        v-model="firstName"
        :rules="rules"
        label="titre"
      ></v-text-field>
      <v-textarea
                            v-model="description"
                            :rules="rules"
                            label="Description"
                            rows="5"
                            outlined
                        ></v-textarea>
      <v-text-field
        v-model="firstName"
        :rules="rules"
        label="email"
      ></v-text-field>
      <v-btn class="mt-2" type="submit" color="#72913a"block>Submit</v-btn>
    </v-form>
  </v-sheet>
</v-col>
<v-col cols="12" md="6">
<v-img src="../assets/Default_image_where_a_man_asks_for_information_at_a_zoo_2.jpg" height="400"  data-aos="fade-up"
data-aos-anchor-placement="top-center"></v-img>
</v-col>
</v-row>
    </v-container>
  </v-main>
<Footer/>
</template>

<script setup>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import axios from "axios" 
</script>
<script>
//import { WOW } from 'wow.js';


export default {
  data() {
    return {
      sheet: false,
      name: '',
        description: '',
        retouravis: '',
        retouravistype: null,
        rules: [
            v => !!v || 'Message is required',
            v => (v && v.length <= 500) || 'Message must be less than 500 characters'
        ],
      detailsModal: false,
      selectedItem: null,  // Assurez-vous que c'est initialement null
      sampleData: [
        {
          image: 'path/to/image1.jpg',
          titre: 'Titre 1',
          prix: '1000€',
          description: 'Description 1',
          annee_mise_en_circulation: '2020',
          kilometrage: '10000',
          vehicules_id: '1'
        },
        {
          image: 'path/to/image2.jpg',
          titre: 'Titre 2',
          prix: '2000€',
          description: 'Description 2',
          annee_mise_en_circulation: '2021',
          kilometrage: '20000',
          vehicules_id: '2'
        }
        // Ajouter plus de données d'exemple si nécessaire
      ]
    };
  },
  mounted() {
   // new WOW().init();
  },
  data: () => ({
    tab: null,
    model: null,
    icons: ["mdi-rewind", "mdi-play", "mdi-fast-forward"],
    transparent: "rgba(255, 255, 255, 0)",
    rating: 4.5,
    populars: [
      {
        image: "9.jpg",
        title: " Enjoy The Beauty Place in Greece City",
        subtitle1: "Greece",
        subtitle2: "4 Day's 3 Night",
        money: "$1200",
      },
      {
        image: "10.jpg",
        title: " Enjoy The Beauty Place in Maldivs Beach",
        subtitle1: "Maldivs",
        subtitle2: "5 Day's 4 Night",
        money: "$1300",
      },
      {
        image: "11.jpg",
        title: " Enjoy The Beauty Place in Bhutan City",
        subtitle1: "Bhutan",
        subtitle2: "3 Day's 2 Night",
        money: "$900",
      },
      {
        image: "12.jpg",
        title: " Enjoy The Beauty Place in Paris City",
        subtitle1: "Paris",
        subtitle2: "4 Day's 3 Night",
        money: "$1700",
      },
    ],
    offers: [
      {
        image: "i1.png",
        title: " Different Coutries",
      },
      {
        image: "i2.png",
        title: " Bus Tours",
      },
      {
        image: "i3.png",
        title: " Food Tours",
      },
      {
        image: "i4.png",
        title: " Summer Rest",
      },
      {
        image: "i5.png",
        title: "Ship Cruises",
      },
      {
        image: "i6.png",
        title: "Mountains Tours",
      },
    ],
    hotels: [
      {
        image: "src/assets/Default_savannah_animal_habitat_0.jpg",
        title: " Enjoy The Beauty Place in Greece City",
        subtitle1: "Greece",
        subtitle2: "4 Day's 3 Night",
        money: "$1200",
      },
      {
        image: "src/assets/Default_marsh_habitat_for_animals_0.jpg",
        title: " Enjoy The Beauty Place in Maldivs Beach",
        subtitle1: "Maldivs",
        subtitle2: "5 Day's 4 Night",
        money: "$1300",
      },
      {
        image: "src/assets/Default_jungle_habitat_for_animals_0.jpg",
        title: " Enjoy The Beauty Place in Bhutan City",
        subtitle1: "Bhutan",
        subtitle2: "3 Day's 2 Night",
        money: "$900",
      },
    ],
    animations: ['fade-right', 'fade-up', 'fade-left', 'fade-down'],
    travels: [
      {
        title: " Jhon",
      },
      {
        title: " Sylvie",
      },
      {
        title: "Théo",
      },
      {
        title: " Greg",
      },
      {
        title: " Alphonse",
      },
      {
        title: "Jean",
      },
      {
        title: "émilie",
      },
      {
        title: "Mathilde",
      },
    ],
}),
methods: {
    openDetailsModal(index) {
      this.selectedItem = this.sampleData[index];
      this.detailsModal = true;
    },
    closeDetailsModal() {
      this.detailsModal = false;
    },
    submitForm() {
      

      axios.post('http://Zoo-project.local/avis.php?action=envoyer', document.querySelector('#Avis_users'),{withcredentials: true})
        .then(response => {
        this.retouravis=response.data.message;
        this.retouravistype=response.data.status==='success'?true:false;
          console.log(response)
          if (response.data.status) {
            
          } else {
            console.log('Échec de l\'envoie');
          }
        })
        .catch(error => {
          console.error('Erreur lors de la soumission du formulaire:', error);
        });
    },
  }
};
</script>
<style scoped>

.nav-link{
  text-decoration: none;
}
.text-black{
  color:green;
}

  
</style>
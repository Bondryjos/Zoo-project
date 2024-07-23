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
<h2 class="text-center"   style="font-family: 'Montserrat', sans-serif;">Visiter notre Zoo</h2>
<p class="mt-12" style="font-size: 20px ;font-family: 'Fredoka',sans-serif;"  data-aos="flip-right">Arcadia est un zoo situé en France près de la forêt de Brocéliande, en bretagne depuis 1960. 
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
              <v-col cols="12" sm="3" v-for="(habitat, i) in habitats" :key="i">
              <v-hover v-slot="{isHovering,props}">
                <router-link :to="{ path: '/'+habitat.route }" class="nav-link">
                <v-card class="mx-auto" color="grey-lighten-4" max-width="600" v-bind="props" :data-aos="animations[i]" data-aos-duration="3000">
                <v-img :aspect-ratio="16 /9" cover :src="habitat.image">
                  <v-expand-transition>
                    <div v-if="isHovering" class="d-flex transition-fast-in-fast-out bg-yellow darken-4 v-card--reveal" style="height: 100%;">
                      <h>{{ habitat.title }}</h>
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
              <v-slide-group-item v-for="(item,i) in avisId" :key="i" v-slot="{isSelected, toggle}">
                <v-card :color="'#8aa35a '" class="ma-4" height="300" width="250" @click="toggle" flat data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
                  <div>
                    <v-card-title>
                      {{ item.nom}}
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                      {{ item.description }}
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
<v-alert v-if="message" type="success">{{ message }}</v-alert>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
        </v-card-text>
      </v-card>
    </v-bottom-sheet>
  </div>
                    </v-row>
                    <v-row>
                    <v-col cols="12" md="6" id="contact">
                    <v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent="submitFormFormulaire" id="Formulaire" style="background-color:#72913a;">
      <v-text-field
        v-model="firstName"
        :rules="rules"
        label="titre"
      ></v-text-field>
      <v-textarea
                            v-model="message"
                            :rules="rules"
                            label="message"
                            rows="5"
                            outlined
                        ></v-textarea>
      <v-text-field
        v-model="email"
        :rules="rules"
        label="email"
      ></v-text-field>
      <v-btn class="mt-2" type="submit" color="#72913a"block>Submit</v-btn>
    </v-form>
    <v-alert v-if="message" type="success">{{ message }}</v-alert>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
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
      avisId: [],
      name: '',
        description: '',
        retouravis: '',
        titre: '',
      message: '',
      email: '',
        retouravistype: null,
        retourformulaires:'',
      retourformulairestype:false,
        rules: [
            v => !!v || 'Message is required',
            v => (v && v.length <= 500) || 'Message must be less than 500 characters'
        ],
      detailsModal: false,
      selectedItem: null,  
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
      ],
      habitats: [
      {
        image: "src/assets/Default_savannah_animal_habitat_0.jpg",
        title: " Savane",
        route: "savane",
        
      },
      {
        image: "src/assets/Default_marsh_habitat_for_animals_0.jpg",
        title: " Marais",
        route: "marais",
      },
      {
        image: "src/assets/Default_jungle_habitat_for_animals_0.jpg",
        title: " Jungle",
        route: "jungle",
      },
    ],
    animations: ['fade-right', 'fade-up', 'fade-left', 'fade-down'],
    };
  },
  mounted() {
    this.fetchAvis();
   // new WOW().init();
  },
methods: {
    openDetailsModal(index) {
      this.selectedItem = this.sampleData[index];
      this.detailsModal = true;
    },
    closeDetailsModal() {
      this.detailsModal = false;
    },
    fetchAvis() {
      axios.get('http://Zoo-project.en.gp/php/avis.php?action=afficher_accueil',{withcredentials: true})
        .then(response => {
          this.avisId = response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    submitForm() {
      

      axios.post('http://Zoo-project.en.gp/php/avis.php?action=envoyer', document.querySelector('#Avis_users'),{withcredentials: true})
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
    submitFormFormulaire() {
      

      axios.post('http://Zoo-project.en.gp/php/formulaire.php', formData, {
        withCredentials: true,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
      .then(response => {
        this.retourformulaires=response.data.message;
        this.retourformulairestype=response.data.status==='success'?true:false;
        console.log(response);
        if (response.data.status) {
         
        } else {
          console.log('Échec de l\'envoi');
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
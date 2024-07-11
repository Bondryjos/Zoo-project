<template>
    <v-parallax
    height="300"
    src="../assets/Default_jungle_habitat_for_animals_0.jpg">
    <div class="d-flex flex-column fill-height justify-center align-center text-white">
      <h1 class="text-h4 font-weight-thin mb-4">
        Vuetify
      </h1>
      <h4 class="subheading">
        Build your application today!
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
      v-for="(slide, i) in slides"
      :key="i"
    >
      <v-sheet
        height="100%"
      >
        <div class="d-flex fill-height justify-center align-center">
          <div class="text-h2">
            {{ slide }} Slide
          </div>
        </div>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
    </v-col>
    <v-col cols="12" md="6">
<h2>Lion</h2>
<p>la rage du lion</p>
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12" md="8">
<h2>Mode de vie</h2>
<p></p>
<h2></h2>
<p></p>

    </v-col>
    <v-col cols="12" md="4">
<v-card style="background-color:#debc6f;height: 500;">
<h2>hello world</h2>
</v-card>
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
          :class="['ma-4', selectedClass]"
          color="grey-lighten-1"
          height="200"
          width="100"
          @click="toggle"
        ><v-img
          src="../assets/Default_jungle_habitat_for_animals_0.jpg"
         class="fill-height"
            style="object-fit: cover; height: 100%; width: 100%;"
        ></v-img>
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
  </template>
  <script>
  export default {
    data () {
      return {
        slides: [
          'First',
          'Second',
          'Third',
          'Fourth',
          'Fifth',
        ],
      }
    },
  }
</script>
  
 
  
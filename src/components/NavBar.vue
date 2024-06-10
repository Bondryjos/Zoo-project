<template>
<v-app-bar height="80" color="#debc6f" scroll-behavior="elevate" id="inspire">
    <v-img src="@/assets/Default_make_me_a_logo_for_an_online_zoo_website_3-removebg-preview.png"></v-img>
    <v-app-bar-title>Zoo Arcadia </v-app-bar-title>
    <v-spacer></v-spacer>
    <v-menu transition="slide-x-transion">
        <template v-slot:activator="{props}">
            <v-btn color="green" v-bind="props">Accueil <v-icon style="font-size: 36px;">mdi-chevron-down</v-icon></v-btn>
        </template>
        <v-list style="background-color:#debc6f;">
        <v-list-item>
          <v-list-item-title>présentation du Zoo</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu transition="slide-x-transion">
        <template v-slot:activator="{props}">
            <v-btn color="green" v-bind="props">Service<v-icon style="font-size: 36px;">mdi-chevron-down</v-icon></v-btn>
        </template>
        <v-list style="background-color:#debc6f;">
        <v-list-item >
          <v-list-item-title>Restauration</v-list-item-title>
          <v-list-item-title>visite des habitats</v-list-item-title>
          <v-list-item-title>Visite en train</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu transition="slide-x-transion">
        <template v-slot:activator="{props}">
            <v-btn color="green" v-bind="props">Habitat<v-icon style="font-size: 36px;">mdi-chevron-down</v-icon></v-btn>
        </template>
        <v-list style="background-color:#debc6f;">
        <v-list-item>
          <v-list-item-title>Savane</v-list-item-title>
          <v-list-item-title>Jungle</v-list-item-title>
          <v-list-item-title>Marais</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu transition="slide-x-transition">
      <template v-slot:activator="{props}">
      <v-btn color="green" v-bind="props">Contact</v-btn>
      </template>
    </v-menu>
    <v-btn class="text-none expl mr-8" color="green" size="x-large" variant="flat" rounded="0">
      Se connecter 
    </v-btn>
</v-app-bar>

</template>
<script>

</script>
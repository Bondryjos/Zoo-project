<template>
<v-app-bar height="80" color="#debc6f" scroll-behavior="elevate" id="inspire">
    <v-app-bar-nav-icon class="d-md-none" variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-img src="@/assets/Default_make_me_a_logo_for_an_online_zoo_website_3-removebg-preview.png"></v-img>
    <v-app-bar-title>Zoo Arcadia</v-app-bar-title>
    <v-spacer></v-spacer>
    <v-menu transition="slide-x-transition" open-on-hover>
      <template v-slot:activator="{props}">
        <router-link :to="{ path: '/' }" class="nav-link">
          <v-btn class="d-none d-sm-flex" style="color:green" v-bind="props">Accueil
            <v-icon style="font-size: 36px;">mdi-chevron-down</v-icon>
          </v-btn>
        </router-link>
      </template>
      <v-list style="background-color:#debc6f;">
        <v-list-item>
          <router-link :to="{ path: '/présentation' }" class="nav-link">
            <v-list-item-title style="color:green">Présentation du Zoo</v-list-item-title>
          </router-link>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu transition="slide-x-transition" open-on-hover>
      <template v-slot:activator="{props}">
        <router-link :to="{ path: '/' }" class="nav-link">
          <v-btn class="d-none d-sm-flex" style="color:green" v-bind="props">Service
            <v-icon style="font-size: 36px;">mdi-chevron-down</v-icon>
          </v-btn>
        </router-link>
      </template>
      <v-list style="background-color:#debc6f;">
        <v-list-item>
          <router-link :to="{ path: '/restauration' }" class="nav-link">
            <v-list-item-title style="color:green">Restauration</v-list-item-title>
          </router-link>
          <router-link :to="{ path: '/visitehabitat' }" class="nav-link">
            <v-list-item-title style="color:green">Visite des habitats</v-list-item-title>
          </router-link>
          <router-link :to="{ path: '/visitetrain' }" class="nav-link">
            <v-list-item-title style="color:green">Visite en train</v-list-item-title>
          </router-link>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu transition="slide-x-transition" open-on-hover>
      <template v-slot:activator="{props}">
        <router-link :to="{ path: 'habitat' }" class="nav-link">
          <v-btn class="d-none d-sm-flex" style="color:green" v-bind="props">Habitat
            <v-icon style="font-size: 36px;">mdi-chevron-down</v-icon>
          </v-btn>
        </router-link>
      </template>
      <v-list style="background-color:#debc6f;">
        <v-list-item>
          <router-link :to="{ path: '/savane' }" class="nav-link">
            <v-list-item-title style="color:green">Savane</v-list-item-title>
          </router-link>
          <router-link :to="{ path: '/jungle' }" class="nav-link">
            <v-list-item-title style="color:green">Jungle</v-list-item-title>
          </router-link>
          <router-link :to="{ path: '/marais' }" class="nav-link">
            <v-list-item-title style="color:green">Marais</v-list-item-title>
          </router-link>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-btn @click="scrollToContact" class="d-none d-sm-flex" style="color:green">Contact</v-btn>

    <router-link :to="{ path: '/connexion' }" class="nav-link">
      <v-btn class="text-none expl mr-8" color="green" size="x-large" variant="flat" rounded="0">Se connecter</v-btn>
    </router-link>
  </v-app-bar>

  <v-navigation-drawer v-model="drawer" location="bottom" temporary>
    <template v-for="item in items" :key="item">
      <router-link :to="getLink(item)" class="nav-link">
        <v-list @click="scroll(item)" class="text-black">{{ item }}</v-list>
      </router-link>
    </template>
  </v-navigation-drawer>

</template>
<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
    items: [
      'accueil', 'service', 'Habitat', 'contact', 'savane', 'jungle', 'marais'
    ],
  }),
  watch: {
    group () {
      this.drawer = false;
    },
  },
  methods: {
    getLink(item) {
      switch(item) {
        case 'accueil': return '/';
        case 'service': return '/restauration';
        case 'Habitat': return '/habitat';
        case 'contact': return '#contact';
        case 'savane': return '/savane';
        case 'jungle': return '/jungle';
        case 'marais': return '/marais';
        default: return '/';
      }
    },
    scroll(refName) {
      const element = document.getElementById(refName);
      if (element) {
        element.scrollIntoView({ behavior: "smooth" });
      }
    },
    scrollToContact() {
      const element = document.getElementById('contact');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
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
<template>
    <div>
      <NavBar/>
      <v-card max-width="350" class="mx-auto mt-16 mb-16" color="#72913a">
        <v-form @submit.prevent="submitForm" id="formulaire_de_connection">
          <v-card-title class="mb-12 text-center">Espace personnel</v-card-title>
          <v-text-field v-model="nom" name="nom" label="Nom"></v-text-field>
          <v-text-field v-model="mot_de_passe" name="mot_de_passe" label="Mot de passe" type="password"></v-text-field>
          <input type="hidden" name="loginUser" value="1">
          <v-btn type="submit" :color="'#8aa35a '">Se connecter</v-btn>
        </v-form>
      </v-card>
      <Footer/>
    </div>
  </template>
 <script setup>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
  
</script>
<script>
export default {
  data() {
    return {
      nom:'',
      mot_de_passe:'',
    };
  },
  methods: {
    submitForm() {
      

      const formData = new FormData(document.querySelector('#formulaire_de_connection'));

      console.log(new URLSearchParams(formData).toString()) 

fetch('http://Zoo-project.en.gp/php/users.php?action=login', {
  method: 'POST',
  credentials: 'include',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: new URLSearchParams(formData).toString(),
})
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.admin) {
      this.$router.push('/admin');
    }
    else if (data.employe) {
      this.$router.push('/employe');
    } else if (data.veterinaire) {
      this.$router.push('/vétérinaire');
    }
       else {
      console.log('Échec de la connexion');
    }
  })
  .catch(error => console.error('Erreur lors de la soumission du formulaire:', error));


    },
  },
};
</script>
<template>
<v-container>
    <v-footer class="text-center d-flex flex-column " style="bottom: 0;background-color: #debc6f;" >
      <div class="d-flex w-100 pt-2">
        <v-row justify="center" no-gutters>
          <v-col cols="12" md="6">
            <h2>Information légale</h2>
            <ul>
             <li style="list-style:none;"><a href="/politique.html" style="text-decoration: none;color:black">Politique de confidentialité</a></li>
              <li style="list-style:none;"><a href="/Mentions Légales - Garage automobile - 2024-02-18T01_54_43Z.pdf" style="text-decoration: none;color:black">Mentions légal</a></li>
              <li style="list-style:none;"><a href="/condition_d_utilisation.html" style="text-decoration: none;color:black">Conditions d'utilisation</a></li>
            </ul>
          </v-col>
          <v-col cols="12" md="5" >
            <h2> Horaires d'ouverture</h2>
            <span class="text-caption" v-for="(item,i) in horaire" :key="i">{{ i }}: {{ item }}<br/></span>
           
          </v-col>
          
        </v-row>
      </div>
      
    </v-footer>
</v-container>
</template>
<script setup>
import axios from "axios";
</script>
<script>
 export default {
    data () {
      return {
      horaire: [],
      }
    },
    mounted() {
    this.fetchhoraire();
  },
    methods: {
    fetchhoraire() {
      axios.get('http://zoo-project.en.gp/php/horaire.php?action=get_horaire',{withcredentials: true})
        .then(response => {
          this.horaire = response.data;
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  },
  }
</script>
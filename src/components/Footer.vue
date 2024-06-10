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
            <span class="text-caption" v-for="(item,i) in horairesId" :key="i">{{ item.jours }}: {{ item. horaires_du_matin }} // {{ item.horaires_du_soir }}<br/></span>
           
          </v-col>
          
        </v-row>
      </div>
      
    </v-footer>
</v-container>
</template>
<script>

</script>
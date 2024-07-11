<template>
    <NavBarAdmin>
    <template v-slot:default>
              <div>
                <v-row>
                    <v-col cols="12" md="4" sm="2" xs="2">
                        <v-table>
                            <thead>
                                <tr>
            <th class="text-left">
              Avis
            </th>
            <th class="text-left">
              Nom
            </th>
            <th class="text-left">
              description
            </th>
            <th class="text-left">
              modération
            </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr v-for="(item, index) in paginatedAvisData" :key="index">
                                    <td>{{ item.idavis }}</td>
                                    <td>{{ item.nom }}</td>
                                    <td>{{ item.description }}</td>
                                    
                                    <td> <v-btn @click="editItem(item)">Voir</v-btn>
          <v-btn @click="postavis(item)">poster</v-btn>
          <v-btn @click="deleteavis(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-card-text>
          <div>
          <strong>nom :</strong> {{ editedItem.nom }}
         </div>
         <div>
         <strong>message :</strong> {{ editedItem.description }}
         </div>       
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Enregistrer</v-btn>
          <v-btn @click="cancelEdit">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
                        </v-table>
                        <v-pagination v-model="pageNumber" :length="7" @input="nextPage"></v-pagination>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-table>
                            <thead>
                                <tr>
            <th class="text-left">
              animal
            </th>
            <th class="text-left">
             mode de vie
            </th>
            <th class="text-left">
             race
            </th><th class="text-left">
             
              gerer
            </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr v-for="(item, index) in paginatedAnimalData" :key="index">
                                    <td>{{ item.prenom }}</td>
                                    <td>{{ item.mode_de_vie }}</td>
                                    <td>{{ item.race }}</td>
                                    
                                    <td> 
          <v-btn @click=" handleEditedAnimal(item)">voir</v-btn>
          <v-btn @click="deleteanimal(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-card-text>
          <div>
          <strong>nom :</strong> {{ editedItem.prenom }}
         </div>
         <div>
         <strong>message :</strong> {{ editedItem.etat }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.description }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.mode_de_vie }}
         </div> 
         <div>
         <strong>message :</strong> {{ editedItem.information }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.Rapport_idRapport }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.habitat_id_habitat }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.race }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.image }}
         </div>        
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Enregistrer</v-btn>
          <v-btn @click="cancelEditAnimal">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
                        </v-table>
                        <v-pagination v-model="animalPageNumber" :length="7" @input="nextPage"></v-pagination>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" >
                        <v-card>
                            <v-table>
                                <thead>
                                  <tr>
                                        <th>Habitat</th>
                                        <th>nom</th>
                                        <th>description</th>
                                        <th>commentaire</th>
                                        <th>image</th>
                                        <th>gérer</th>
                                    </tr>
                                </thead>
                                <v-divider></v-divider>
                                <tbody>
                                <tr v-for="(item, index) in paginatedHabitatData" :key="index">
                                    <td>{{ item.nom }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.commentaire}}</td>
                                    
                                    <td>
          <v-btn @click=" handleEditedHabitat(item)">voir</v-btn>
          <v-btn @click="deletehabitat(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-card-text>
          <div>
          <strong>nom :</strong> {{ editedItem.nom }}
         </div>
         <div>
         <strong>message :</strong> {{ editedItem.description }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedItem.commentaire }}
         </div>       
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Enregistrer</v-btn>
          <v-btn @click="cancelEditHabitat">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
                            </v-table>
                            <v-pagination v-model="habitatPageNumber" :length="7" @input="nextPage"></v-pagination>
                        </v-card>
                    </v-col>
                </v-row>
                
              </div>
            </template>
        </NavBarAdmin>
    </template>
    <script setup>
    import NavBarAdmin from '@/components/admin/NavBarAdmin.vue'
    </script>
    <script>
    export default {
        data () {
        return {
          AvisData:[],
          AnimalData:[],
          HabitatData:[],
          pageNumber: 1,
          animalPageNumber: 1,
          habitatPageNumber: 1,
          size: 10,
          editDialog: false,
          editHabitatDialog: false,
          editContactDialog: false,
          editAnimalDialog:false,
          editAddDialog:false,
          editedItem: {},
          editedHabitat:{},
          editedContact:{},
          editedAnimal:{},
        };
      },
      created(){
        this. VerifyAvis()
        this. VerifyAnimal()
        this. VerifyHabitat()
    },computed: {
      pageCount() {
          let l = this.AvisData.length,
            s = this.size;
          return Math.ceil(l / s) - 1;
        },
        animalPageCount() {
        let l = this.AnimalData.length,
          s = this.size;
        return Math.ceil(l / s) - 1;
      },
      habitatPageCount() {
        let l = this.HabitatData.length,
          s = this.size;
        return Math.ceil(l / s) - 1;
      },
        paginatedAvisData() {
          const start = this.pageNumber * this.size - this.size,
            end = start + this.size;
          return this.AvisData.slice(start, end);
        },
        paginatedAnimalData() {
          const start = this.animalPageNumber * this.size - this.size,
            end = start + this.size;
          return this.AnimalData.slice(start, end);
        },
        paginatedHabitatData() {
          const start = this.habitatPageNumber * this.size - this.size,
            end = start + this.size;
          return this.HabitatData.slice(start, end);
        }
      },
      methods: {
        nextPage(page) {
          this.pageNumber = page;
        },
        vehiculesNextPage(page) {
        this.animalPageNumber = page;
      },
      habitatNextPage(page) {
        this.habitatPageNumber = page;
      },
        async VerifyAvis(){
        try {
            const response = await fetch('http://Zoo-project.local/avis.php?action=avis_admin',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.AvisData=data.avis;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
      async VerifyAnimal(){
        try {
            const response = await fetch('http://Zoo-project.local/animaux.php?action=administration_animaux',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.AnimalData=data.animal;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
      async VerifyHabitat(){
        try {
            const response = await fetch('http://Zoo-project.local/habitat.php?action=administration_habitat',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.HabitatData=data.habitat;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
        editItem(item) {
          this.editDialog = true;
          this.editedItem = { ...item };
        },
        saveEdit() {
          console.log('Enregistrer les modifications :', this.editedItem);
          this.editDialog = false;
        },
        cancelEdit() {
          this.editDialog = false;
        },
        handleEditedHabitat(item) {
          this.editHabitatDialog = true;
          this.editedHabitat = { ...item };
          console.log(this.EditedHabitat)
        },
        cancelEditHabitat() {
          this.editHabitatDialog = false;
        },
        handleEditedContact(item) {
          this.editContactDialog = true;
          this.editedContact = { ...item };
          console.log(this.editContact)
        },
        cancelEditContact() {
          this.editContactDialog = false;
        },
        handleEditedAdd(item) {
          this.editAddDialog = true;
        
        },
        cancelEditAdd() {
          this.editAddDialog = false;
        },
        handleEditedAnimal(item) {
          this.editAnimalDialog = true;
          this.editedAnimal = { ...item };
          console.log(this.editAnimal)
        },
        cancelEditAnimal() {
          this.editAnimalDialog = false;
        },
       async postavis(item){
          try {
            const formData = new URLSearchParams();
    for (const key in item) {
      formData.append(key, item[key]);
    }
            const response = await fetch('http://Zoo-project.local/avis.php?action=verifier',{credentials: 'include' ,method:"post",headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: formData.toString(),});
           
            const data = await response.json();
            
              this.VerifyAvis();
    
           
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
        },
        async deleteavis(item){
          try {
            const formData = new URLSearchParams();
    for (const key in item) {
      formData.append(key, item[key]);
    }
            const response = await fetch('http://Zoo-project.local/avis.php?action=delete_avis',{credentials: 'include' ,method:"post",headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: formData.toString(),});
           
            const data = await response.json();
            
              this.VerifyAvis();
    
           
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
        },
      },
    };
    </script>
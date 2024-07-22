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
              id rapport
            </th>
            <th class="text-left">
              date
            </th>
            <th class="text-left">
             details
            </th>
            <th class="text-left">
             gerer
            </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr v-for="(item, index) in paginatedRapportData" :key="index">
                                    <td>{{ item.idRapport }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.details }}</td>
                                    <td> <v-btn @click="handleEditedRapport(item)">Voir</v-btn>
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
          <strong>nom :</strong> {{ editedRapport.idRapport }}
         </div>
         <div>
         <strong>message :</strong> {{ editedRapport.date }}
         </div> 
         <div>
         <strong>message :</strong> {{ editedRapport.details }}
         </div>       
         <div>
         <strong>message :</strong> {{ editedRapport.animal_idanimal }}
         </div>       
         <div>
         <strong>message :</strong> {{ editedRapport.etat }}
         </div> 
         <div>
         <strong>message :</strong> {{ editedRapport.nourriture }}
         </div>  
         <div>
         <strong>message :</strong> {{ editedRapport.grammage }}
         </div>              
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Modifier</v-btn>
          <v-btn @click="cancelEdit">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
                        </v-table>
                        <v-pagination v-model="pageNumber" :length="7" @input="nextPage"></v-pagination>
                        <v-btn @click="handleEditedRapport">ajouter</v-btn>
  <v-dialog v-model="editRapportDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter le rapport
        </v-card-title>
        <v-form   @submit.prevent="submitForm" id="Nourriture" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field  label="idRapport" name="idRapport"></v-text-field>
          <v-text-field  label="date" name="date"></v-text-field>
          <v-text-field  label="details" name="details"></v-text-field>
          <v-text-field  label="animal_idanimal" name="animal_idanimal"></v-text-field>
          <v-text-field  label="etat " name="etat "></v-text-field>
          <v-text-field  label="nourriture" name="nourriture"></v-text-field>
          <v-text-field  label="grammage" name="grammage"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitForm">ajouter</v-btn>
          <v-btn @click="cancelEditNourriture">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-card>
                            <v-table>
                                <thead>
                                  <tr>
                                    <th>date</th>
                                        <th>Nourriture</th>
                                        <th>quantité</th>
                                        <th>animal</th>
                                        <th>gérer</th>
                                    </tr>
                                </thead>
                                <v-divider></v-divider>
                                <tbody>
                                <tr v-for="(item, index) in paginatedNourritureData" :key="index">
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.nourriture }}</td>
                                    <td>{{ item.quantité}}</td>
                                    <td>{{ item.animal_idanimal}}</td>
                                    
        <td>  <v-btn @click=" handleEditedNourriture(item)">voir</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editNourritureDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        
        <v-card-text>
          <div>
          <strong>nom :</strong> {{  editedNourriture.date }}
         </div>
         <div>
         <strong>message :</strong> {{  editedNourriture.nourriture }}
         </div>
         <div>
         <strong>note :</strong> {{  editedNourriture.quantité }}
         </div>
         <div>
         <strong>note :</strong> {{ editedNourriture.animal_idanimal}}
         </div>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="cancelEditNourriture">Annuler</v-btn>
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
           RapportData:[],
           NourritureData:[],
           pageNumber: 1,
           rapportPageNumber: 1,
           nourriturePageNumber: 1,
           size: 10,
           editDialog: false,
           editNourritureDialog: false,
           editRapportDialog: false,
           editServiceDialog:false,
           editAddDialog:false,
           editedItem: {},
           editedNourriture:{},
           editedContact:{},
           editedRapport:{},
           
         };
       },
       created(){
         this. VerifyAvis()
         this. VerifyRapport()
         this. VerifyNourriture()
     },computed: {
       pageCount() {
           let l = this.AvisData.length,
             s = this.size;
           return Math.ceil(l / s) - 1;
         },
         servicePageCount() {
         let l = this.RapportData.length,
           s = this.size;
         return Math.ceil(l / s) - 1;
       },
       nourriturePageCount() {
         let l = this.NourritureData.length,
           s = this.size;
         return Math.ceil(l / s) - 1;
       },
         paginatedAvisData() {
           const start = this.pageNumber * this.size - this.size,
             end = start + this.size;
           return this.AvisData.slice(start, end);
         },
         paginatedRapportData() {
           const start = this.rapportPageNumber * this.size - this.size,
             end = start + this.size;
           return this.RapportData.slice(start, end);
         },
         paginatedNourritureData() {
           const start = this.nourriturePageNumber * this.size - this.size,
             end = start + this.size;
           return this.NourritureData.slice(start, end);
         }
       },
       methods: {
         nextPage(page) {
           this.pageNumber = page;
         },
         serviceNextPage(page) {
         this.rapportPageNumber = page;
       },
       habitatNextPage(page) {
         this.nourriturePageNumber = page;
       },
         async VerifyAvis(){
         try {
             const response = await fetch('http://Zoo-project.en.gp/php/avis.php?action=avis_admin',{credentials: 'include'});
         
             const data = await response.json();
             if (data.status==true){
               this.AvisData=data.avis;
     
             }
           
           } catch (error) {
             console.error('Une erreur est survenu:', error);
           }
       },
       async VerifyRapport(){
         try {
             const response = await fetch('http://Zoo-project.en.gp/php/rapport.php?action=administration_rapport',{credentials: 'include'});
         
             const data = await response.json();
             if (data.status==true){
               this.RapportData=data.rapport;
     
             }
           
           } catch (error) {
             console.error('Une erreur est survenu:', error);
           }
       },
       async VerifyNourriture(){
         try {
             const response = await fetch('http://Zoo-project.en.gp/php/nourriture.php?action=administration_nourriture',{credentials: 'include'});
         
             const data = await response.json();
             if (data.status==true){
               this.NourritureData=data.nourriture;
     
             }
           
           } catch (error) {
             console.error('Une erreur est survenu:', error);
           }
       }, 
       async  modifyservice() {
   try {
     const formData = new FormData(document.querySelector('#Horaires'));
     const response = await fetch('http://Zoo-project.en.gp/php/Service.php?action=modifier_service', {
       method: 'POST',
       credentials: 'include',
       body: formData
     });
 
     const responseData = await response.json();
 
     console.log(responseData);
 
     if (responseData.status) {
       this.editServiceDialog=false;
     } else {
       console.log('Échec de l\'envoie');
     }
   } catch (error) {
     console.error('Erreur lors de la soumission du formulaire:', error);
   }
 },   
 async  submitForm() {
   try {
     const formData = new FormData(document.querySelector('#Nourriture'));
     const response = await fetch('/ecommerce-test/php/VehiculesAdmin.php', {
       method: 'POST',
       credentials: 'include',
       body: formData
     });
 
     const responseData = await response.json();
 
     console.log(responseData);
 
     if (responseData.status) {
       this.editVehiculesDialog=false;
     } else {
       console.log('Échec de l\'envoie');
     }
   } catch (error) {
     console.error('Erreur lors de la soumission du formulaire:', error);
   }
 }, 
 async  submitFormService() {
   try {
     const formData = new FormData(document.querySelector('#Nourriture'));
     const response = await fetch('/ecommerce-test/php/VehiculesAdmin.php', {
       method: 'POST',
       credentials: 'include',
       body: formData
     });
 
     const responseData = await response.json();
 
     console.log(responseData);
 
     if (responseData.status) {
       this.editVehiculesDialog=false;
     } else {
       console.log('Échec de l\'envoie');
     }
   } catch (error) {
     console.error('Erreur lors de la soumission du formulaire:', error);
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
         handleEditedNourriture(item) {
           this.editNourritureDialog = true;
           this.editedNourriture = { ...item };
           console.log(this.EditedNourriture)
         },
         cancelEditNourriture() {
           this.editNourritureDialog = false;
         },
         handleEditedRapport(item) {
           this.editRapportDialog = true;
           this.editedRapport = { ...item };
           console.log(this.editRapport)
         },
         cancelEditRapport() {
           this.editRapportDialog = false;
         },
         handleEditedAdd(item) {
           this.editAddDialog = true;
         
         },
         cancelEditAdd() {
           this.editAddDialog = false;
         },
         handleEditedService(item) {
           this.editServiceDialog = true;
           this.editedService = { ...item };
           console.log(this.editService)
         },
         cancelEditService() {
           this.editServiceDialog = false;
         },
        async postavis(item){
           try {
             const formData = new URLSearchParams();
     for (const key in item) {
       formData.append(key, item[key]);
     }
             const response = await fetch('http://Zoo-project.en.gp/php/avis.php?action=verifier',{credentials: 'include' ,method:"post",headers: {
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
             const response = await fetch('http://Zoo-project.en.gp/php/avis.php?action=delete_avis',{credentials: 'include' ,method:"post",headers: {
         'Content-Type': 'application/x-www-form-urlencoded',
       },
       body: formData.toString(),});
            
             const data = await response.json();
             
               this.VerifyAvis();
     
            
           
           } catch (error) {
             console.error('Une erreur est survenu:', error);
           }
         },
         async deleteservice(item){
       try {
         const formData = new URLSearchParams();
 for (const key in item) {
   formData.append(key, item[key]);
 }
         const response = await fetch('http://Zoo-project.en.gp/php/service.php?action=supprimer_service',{credentials: 'include' ,method:"post",headers: {
     'Content-Type': 'application/x-www-form-urlencoded',
   },
   body: formData.toString(),});
        
         const data = await response.json();
         
           this.VerifyService();
 
        
       
       } catch (error) {
         console.error('Une erreur est survenu:', error);
       }
     },
     async deletenourriture(item){
       try {
         const formData = new URLSearchParams();
 for (const key in item) {
   formData.append(key, item[key]);
 }
         const response = await fetch('http://Zoo-project.en.gp/php/nourriture.php?action=supprimer_nourriture',{credentials: 'include' ,method:"post",headers: {
     'Content-Type': 'application/x-www-form-urlencoded',
   },
   body: formData.toString(),});
        
         const data = await response.json();
         
           this.VerifyNourriture();
 
        
       
       } catch (error) {
         console.error('Une erreur est survenu:', error);
       }
     },
     async VerifyConnection(){
     try {
         const response = await fetch
         ('http://Zoo-project.en.gp/php/verifier.php',
         {credentials: 'include'});
     
         const data = await response.json();
         if (data.status==false){
           this.$router.push('/connexion');
         }
         console.log('Retour: ', data);
       } catch (error) {
         console.error('Une erreur est survenu:', error);
       }
   },
       },
     };
     </script>
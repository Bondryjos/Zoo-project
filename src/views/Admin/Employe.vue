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
              titre_service
            </th>
            <th class="text-left">
             Description
            </th>
            <th class="text-left">
             image
            </th><th class="text-left">
             
              type
            </th>
            <th class="text-left">
             
             Action
           </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr v-for="(item, index) in paginatedServiceData" :key="index">
                                    <td>{{ item.titre}}</td>
                                    <td>{{ item.description}}</td>
                                    <td>{{ item.idimage }}</td>
                                    <td>{{ item.type}}</td>
                                    
                                    <td> 
          <v-btn @click=" handleEditedService(item)">voir</v-btn>
          <v-btn @click="deleteservice(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editServiceDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifyservice" id="Service" >
        <v-card-text>
          <v-text-field v-model="editedService.titre" name="titre" label="titre"></v-text-field>
          <v-text-field v-model="editedService.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedService.idimage" name="idimage" label="image"></v-text-field>
          <v-text-field v-model="editedService.type" name="type" label="type"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifyservice">modifier</v-btn>
          <v-btn @click="cancelEditService">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="idservice" :value="editedService.idservice"/>
        </v-form>
      </v-card>
    </v-dialog>
                        </v-table>
                        <v-pagination v-model="servicePageNumber" :length="7" @input="nextPage"></v-pagination>
                        <v-btn @click="handleEditedService">ajouter</v-btn>
  <v-dialog v-model="editServiceDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter des services
        </v-card-title>
        <v-form   @submit.prevent="submitFormService" id="Service" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field  label="titre" name="titre"></v-text-field>
          <v-text-field  label="description" name="description"></v-text-field>
          <v-text-field  label="idimage" name="idimage"></v-text-field>
          <v-text-field  label="type" name="type"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitFormService">ajouter</v-btn>
          <v-btn @click="cancelEditService">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" >
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
                                    <td>
          <v-btn @click=" handleEditedNourriture(item)">voir</v-btn>
          <v-btn @click="deletenourriture(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editNourritureDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifynourriture" id="Nourriture" >
        <v-card-text>
          <v-text-field v-model="editedNourriture.date" name="date" label="date"></v-text-field>
          <v-text-field v-model="editedNourriture.nourriture" name="nourriture" label="nourriture"></v-text-field>
          <v-text-field v-model="editedNourriture.quantité" name="quantité" label="quantité"></v-text-field>
          <v-text-field v-model="editedNourriture.animal_idanimal" name="animal_idanimal" label="animal"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifynourriture">modifier</v-btn>
          <v-btn @click="cancelEditNourriture">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="idnourriture" :value="editedNourriture.idnourriture"/>
        </v-form>
      </v-card>
    </v-dialog>
                            </v-table>
                            <v-pagination v-model="habitatPageNumber" :length="7" @input="nextPage"></v-pagination>
                        </v-card>
                        <v-btn @click="handleEditedNourriture">ajouter</v-btn>
  <v-dialog v-model="editVehiculesDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter de la nourriture
        </v-card-title>
        <v-form   @submit.prevent="submitForm" id="Nourriture" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field  label="date" name="date"></v-text-field>
          <v-text-field  label="nourriture" name="nourriture"></v-text-field>
          <v-text-field  label="quantité" name="quantité"></v-text-field>
          <v-text-field  label="animal_idanimal" name="animal_idanimal"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitForm">ajouter</v-btn>
          <v-btn @click="cancelEditNourriture">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
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
          ServiceData:[],
          NourritureData:[],
          pageNumber: 1,
          servicePageNumber: 1,
          nourriturePageNumber: 1,
          size: 10,
          editDialog: false,
          editNourritureDialog: false,
          editContactDialog: false,
          editServiceDialog:false,
          editAddDialog:false,
          editedItem: {},
          editedNourriture:{},
          editedContact:{},
          editedService:{},
          
        };
      },
      created(){
        this. VerifyAvis()
        this. VerifyService()
        this. VerifyNourriture()
    },computed: {
      pageCount() {
          let l = this.AvisData.length,
            s = this.size;
          return Math.ceil(l / s) - 1;
        },
        servicePageCount() {
        let l = this.ServiceData.length,
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
        paginatedServiceData() {
          const start = this.servicePageNumber * this.size - this.size,
            end = start + this.size;
          return this.ServiceData.slice(start, end);
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
        this.servicePageNumber = page;
      },
      habitatNextPage(page) {
        this.nourriturePageNumber = page;
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
      async VerifyService(){
        try {
            const response = await fetch('http://Zoo-project.local/service.php?action=administration_service',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.ServiceData=data.service;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
      async VerifyNourriture(){
        try {
            const response = await fetch('http://Zoo-project.local/nourriture.php?action=administration_nourriture',{credentials: 'include'});
        
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
    const response = await fetch('http://Zoo-project.local/Service.php?action=modifier_service', {
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
async  modifynourriture() {
  try {
    const formData = new FormData(document.querySelector('#Horaires'));
    const response = await fetch('http://Zoo-project.local/nourriture.php?action=modifier_nourriture', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editNourritureDialog=false;
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
        async deleteservice(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('http://Zoo-project.local/service.php?action=supprimer_service',{credentials: 'include' ,method:"post",headers: {
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
        const response = await fetch('http://Zoo-project.local/nourriture.php?action=supprimer_nourriture',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyNourriture();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    },
      },
    };
    </script>
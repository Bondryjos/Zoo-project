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
              Titre service
            </th>
            <th class="text-left">
              description
            </th>
            <th class="text-left">
              image
            </th>
            <th class="text-left">
              type
            </th>
            <th class="text-left">
             action
            </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr v-for="(item, index) in paginatedServiceData" :key="index">
                                    <td>{{ item.titre }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.idimage }}</td>
                                    <td>{{ item.type }}</td>
                                    
                                    <td> <v-btn @click="handleEditedService(item)">Voir</v-btn>
          <v-btn @click="postservice(item)">poster</v-btn>
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
                        <v-pagination v-model="pageNumber" :length="7" @input="nextPage"></v-pagination>
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
          <v-btn @click="deleteanimal(item)">supprimer</v-btn>
          <v-btn @click=" handleEditedAnimalPhoto(item)">ajouter</v-btn>
          <v-btn @click=" handleEditedAnimalPhoto(item)">voir image</v-btn>
        </td>

                                </tr>
                            </tbody>
                            <v-dialog v-model="editAnimalDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifyanimal" id="Animal" >
        <v-card-text>
          <v-text-field v-model="editedAnimal.prenom" name="prenom" label="titre"></v-text-field>
          <v-text-field v-model="editedAnimal.etat" name="etat" label="etat"></v-text-field>
          <v-text-field v-model="editedAnimal.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedAnimal.mode_de_vie" name="mode_de_vie" label="mode_de_vie"></v-text-field>
          <v-text-field v-model="editedAnimal.information" name="information" label="information"></v-text-field>
          <v-text-field v-model="editedAnimal.habitat_idhabitat" name="habitat_idhabitat" label="habitat"></v-text-field>
          <v-text-field v-model="editedAnimal.race" name="race" label="image"></v-text-field>
          <v-text-field v-model="editedAnimal.image" name="image" label="image"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifyanimal">modifier</v-btn>
          <v-btn @click="cancelEditAnimal">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="idanimal" :value="editedAnimal.idanimal"/>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="editAnimalPhotoDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" addAnimalPhoto" id="Animal_Photo" >
        <v-card-text>
        
          <v-file-input
        
        label="Télécharger une photo"
        accept="image/*"
        name="image"
      ></v-file-input>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addAnimalPhoto">ajouter</v-btn>
          <v-btn @click="cancelEditAnimalPhoto">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="idanimal" :value="editedAnimalPhoto.idanimal"/>
        </v-form>
      </v-card>
    </v-dialog>
                        </v-table>
                        <v-pagination v-model="animalPageNumber" :length="7" @input="nextPage"></v-pagination>
                        <v-btn @click="handleEditedAnimal">ajouter</v-btn>
                        <v-dialog v-model="editAnimalDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter des services
        </v-card-title>
        <v-form   @submit.prevent="submitFormAnimal" id="Animal" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field v-model="editedAnimal.prenom" name="prenom" label="titre"></v-text-field>
          <v-text-field v-model="editedAnimal.etat" name="etat" label="etat"></v-text-field>
          <v-text-field v-model="editedAnimal.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedAnimal.mode_de_vie" name="mode_de_vie" label="mode_de_vie"></v-text-field>
          <v-text-field v-model="editedAnimal.information" name="information" label="information"></v-text-field>
          <v-text-field v-model="editedAnimal.habitat_idhabitat" name="habitat_idhabitat" label="habitat"></v-text-field>
          <v-text-field v-model="editedAnimal.race" name="race" label="image"></v-text-field>
          <v-text-field v-model="editedAnimal.image" name="image" label="image"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitFormAnimal">ajouter</v-btn>
          <v-btn @click="cancelEditAnimal">Annuler</v-btn>
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
                                        <th>Habitat</th> 
                                        <th>description</th>
                                        <th>commentaire</th>
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
          </td>
                                </tr>
                            </tbody>
                            <v-dialog v-model="editHabitatDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifyhabitat" id="Habitat" >
        <v-card-text>
          <v-text-field v-model="editedHabitat.nom" name="nom" label="nom"></v-text-field>
          <v-text-field v-model="editedHabitat.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedHabitat.commentaire" name="commentaire" label="commentaire"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifyhabitat">modifier</v-btn>
          <v-btn @click="cancelEditHabitat">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="idhabitat" :value="editedHabitat.idhabitat"/>
        </v-form>
      </v-card>
    </v-dialog>
                            </v-table>
                            <v-pagination v-model="habitatPageNumber" :length="7" @input="nextPage"></v-pagination>
                        </v-card>
                        <v-btn @click="handleEditedHabitat">ajouter</v-btn>
                        <v-dialog v-model="editHabitatDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter des services
        </v-card-title>
        <v-form   @submit.prevent="submitFormHabitat" id="Habitat" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field v-model="editedHabitat.nom" name="nom" label="nom"></v-text-field>
          <v-text-field v-model="editedHabitat.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedHabitat.commentaire" name="commentaire" label="commentaire"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitFormHabitat">ajouter</v-btn>
          <v-btn @click="cancelEditHabitat">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
                    </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-form @submit.prevent="updateHoraire">
      <v-row>
        <v-col cols="12">
          <v-text-field v-model="horaires.lundi" label="Lundi" required></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="horaires.mardi" label="Mardi" required></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="horaires.mercredi" label="Mercredi" required></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="horaires.jeudi" label="Jeudi" required></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="horaires.vendredi" label="Vendredi" required></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="horaires.samedi" label="Samedi" required></v-text-field>
        </v-col>
      </v-row>
      <v-btn type="submit" color="primary">Mettre à jour les horaires</v-btn>
    </v-form>
    <v-alert v-if="message" type="success">{{ message }}</v-alert>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
                  </v-col>
                  <v-col cols="12" md="6" >
                        <v-card>
                            <v-table>
                                <thead>
                                  <tr>
                                        <th>nom</th> 
                                        <th>email</th>
                                        <th>gérer</th>
                                    </tr>
                                </thead>
                                <v-divider></v-divider>
                                <tbody>
                                <tr v-for="(item, index) in paginatedPersonelData" :key="index">
                                    <td>{{ item.nom }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>
          <v-btn @click="deletepersonel(item)">supprimer</v-btn></td>
                                </tr>
                            </tbody>
                            </v-table>
                            <v-pagination v-model="personelPageNumber" :length="7" @input="nextPage"></v-pagination>
                        </v-card>
                        <v-btn @click="handleEditedPersonel">ajouter</v-btn>
                        <v-dialog v-model="editPersonelDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter des services
        </v-card-title>
        <v-form   @submit.prevent="submitFormPersonel" id="Personel" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field  name="nom" label="nom"></v-text-field>
          <v-text-field  name="email" label="email"></v-text-field>
          <v-text-field  name="mot_de_passe" label="mode de passe"></v-text-field>
          <v-text-field  name="role" label="role"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitFormPersonel">ajouter</v-btn>
          <v-btn @click="cancelEditPersonel">Annuler</v-btn>
        </v-card-actions>
        </v-form>
        <v-alert v-if="message" type="success">{{ message }}</v-alert>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
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
          horaires: {
        lundi: '',
        mardi: '',
        mercredi: '',
        jeudi: '',
        vendredi: '',
        samedi: ''
      },
      message: '',
      error: '',
          ServiceData:[],
          PersonelData:[],
          AnimalData:[],
          HabitatData:[],
          pageNumber: 1,
          animalPageNumber: 1,
          habitatPageNumber: 1,
          personelPageNumber: 1,
          size: 10,
          editServiceDialog: false,
          editPersonelDialog: false,
          editHabitatDialog: false,
          editContactDialog: false,
          editAnimalDialog:false,
          editAnimalPhotoDialog:false,
          editAddDialog:false,
          editedItem: {},
          editedHabitat:{},
          editedContact:{},
          editedAnimal:{},
          editedAnimalPhoto:{},
          editedService:{},
          editedPersonel:{},
        };
      },
      created(){
        this. VerifyService()
        this. VerifyAnimal()
        this. VerifyHabitat()
        this.fetchHoraires()
        this. VerifyPersonel()
        this.VerifyConnection()
    },computed: {
      pageCount() {
          let l = this.ServiceData.length,
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
      personelPageCount() {
        let l = this.PersonelData.length,
          s = this.size;
        return Math.ceil(l / s) - 1;
      },
        paginatedServiceData() {
          const start = this.pageNumber * this.size - this.size,
            end = start + this.size;
          return this.ServiceData.slice(start, end);
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
        },
        paginatedPersonelData() {
          const start = this.personelPageNumber * this.size - this.size,
            end = start + this.size;
          return this.PersonelData.slice(start, end);
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
      personelNextPage(page) {
        this.personelPageNumber = page;
      },
        async VerifyService(){
        try {
            const response = await fetch('http://Zoo-project.en.gp/php/Service.php?action=administration_service',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.ServiceData=data.service;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
      async VerifyAnimal(){
        try {
            const response = await fetch('http://Zoo-project.en.gp/php/animaux.php?action=administration_animaux',{credentials: 'include'});
        
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
            const response = await fetch('http://Zoo-project.en.gp/php/habitat.php?action=administration_habitat',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.HabitatData=data.habitat;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      }, async VerifyPersonel(){
        try {
            const response = await fetch('http://Zoo-project.en.gp/php/users.php?action=lire_utilisateur',{credentials: 'include'});
        
            const data = await response.json();
            if (data.status==true){
              this.PersonelData=data.personel;
    
            }
          
          } catch (error) {
            console.error('Une erreur est survenu:', error);
          }
      },
       fetchHoraires() {
      fetch('http://zoo-project.en.gp/php/horaire.php?action=get_horaire')
        .then(response => response.json())
        .then(data => {
          this.horaires = data;
        })
        .catch(error => {
          console.error('Error fetching horaires:', error);
        });
    },
    updateHoraire() {
      fetch('http://zoo-project.en.gp/php/horaire.php?action=update_horaire', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.horaires)
      })
        .then(response => response.json())
        .then(data => {
          if (data.message) {
            this.message = data.message;
            this.error = '';
          } else if (data.error) {
            this.error = data.error;
            this.message = '';
         }
         console.log(data);
        })
        .catch(error => {
          this.error = 'An error occurred while updating horaires.';
          this.message = '';
          console.error('Error updating horaires:', error);
        });
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
async  modifyanimal() {
  try {
    const formData = new FormData(document.querySelector('#Horaires'));
    const response = await fetch('http://zoo-project.en.gp/php/animal.php?action=modifier_animal', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editAnimalDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
}, 
async  modifyhabitat() {
  try {
    const formData = new FormData(document.querySelector('#Horaires'));
    const response = await fetch('http://Zoo-project.en.gp/php/habitat.php?action=modifier_habitat', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editHabitatDialog=false;
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
    const response = await fetch('http://Zoo-project.en.gp/php/Service.php?action=ajouter_service', {
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
async  submitFormAnimal() {
  try {
    const formData = new FormData(document.querySelector('#Nourriture'));
    const response = await fetch('http://Zoo-project.en.gp/php/imal.php?action=ajouter_animal', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editAnimalDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
}, 
async addAnimalPhoto () {
  try {
    const formData = new FormData(document.querySelector('#Animal_Photo'));
    const response = await fetch('http://Zoo-project.en.gp/php/animaux.php?action=ajouter_photo', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editAnimalPhotoDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
}, 
async  submitFormHabitat() {
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
      this.editHabitatDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
}, 
async  submitFormPersonel() {
  try {
    const formData = new FormData(document.querySelector('#Personel'));
    const response = await fetch('http://Zoo-project.en.gp/php/users.php?action=ajouter_utilisateur', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
    this.editPersonelDialog=false;
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
        handleEditedHabitat(item) {
          this.editHabitatDialog = true;
          this.editedHabitat = { ...item };
          console.log(this.EditedHabitat)
        },
        cancelEditHabitat() {
          this.editHabitatDialog = false;
        },
        handleEditedService(item) {
          this.editServiceDialog = true;
          this.editedService = { ...item };
          console.log(this.editService)
        },
        cancelEditService() {
          this.editServiceDialog = false;
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
        handleEditedAnimalPhoto(item) {
          this.editAnimalPhotoDialog = true;
          this.editedAnimalPhoto = { ...item };
          console.log(this.editAnimalPhoto)
        },
        cancelEditAnimalPhoto() {
          this.editAnimalPhotoDialog = false;
        },
        handleEditedPersonel(item) {
          this.editPersonelDialog = true;
          this.editedPersonel = { ...item };
          console.log(this.editPersonel)
        },
        cancelEditPersonel() {
          this.editPersonelDialog = false;
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
        async deletepersonel(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('http://Zoo-project.en.gp/php/users.php?action=supprimer_utilisateur',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyPersonel();

       
      
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
        const response = await fetch('http://Zoo-project.en.gp/php/Service.php?action=supprimer_service',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyService();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    },
    async deletenanimal(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('http://Zoo-project.en.gp/php/animal.php?action=supprimer_animal',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyAnimal();

       
      
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
        if (data.connecter==false){
          this.$router.push('/connexion');
        }
        if (data.admin==false){
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
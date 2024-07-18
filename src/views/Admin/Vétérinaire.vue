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
              Jours
            </th>
            <th class="text-left">
              Horaires
            </th>
            <th class="text-left">
              Modifier
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
                    <v-col cols="12" md="6">
                        <v-card>
                        <v-table>
                            <thead>
                                <tr>
            <th class="text-left">
              animal
            </th>
            <th class="text-left">
              Nombre de visite
            </th>
          </tr>
                            </thead>
                            <v-divider></v-divider>
                            <tbody>
                                <tr>
                                    <td>diego</td>
                                    <td> 4000 visite</td>
                                </tr>
                            </tbody>
                        </v-table>
                    </v-card>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" >
                        <v-card>
                            <v-table>
                                <thead>
                                    <tr>
                                        <th>service</th>
                                        <th>titre</th>
                                        <th>description</th>
                                        <th>image</th>
                                        <th>gérer</th>
                                    </tr>
                                </thead>
                                <v-divider></v-divider>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Zoo</td>
                                    <td>bienvenur dans notre zoo nous sommes heureux de vous présenter </td>
                                    <td>image1</td>
                                    <td><v-btn>voir</v-btn> <v-btn>supprimer</v-btn>  <v-btn>Ajouter</v-btn></td>
                                </tr>
                            </tbody>
                            </v-table>
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
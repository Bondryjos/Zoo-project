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
                                <tr>
                                    <td>Lundi</td>
                                    <td>8h-12h/14h-18h</td>
                                    <td><v-btn>Modifier</v-btn></td>
                                </tr>
                            </tbody>
                        </v-table>
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
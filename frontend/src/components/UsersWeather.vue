<template>
  <v-card>
    <v-card-title>Users</v-card-title>
    <v-card-text>
      <v-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-start">Name</th>
              <th class="text-start">Email</th>
              <th class="text-start">Weather</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.user.id" @click="showDialog(user)">
              <td>{{ user.user.name }}</td>
              <td>{{ user.user.email }}</td>
              <td>{{ user.weather ? user.weather.weather[0].description : '-' }}</td>
            </tr>
          </tbody>
        </template>
      </v-table>
    </v-card-text>
    <v-dialog v-model="dialog" width="600">
      <v-card>
        <v-card-title class="headline">
          {{ selectedUser.user.name }}'s Weather
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-thermometer</v-icon>
              <span>Temperature: {{ selectedUser.weather ? selectedUser.weather.main.temp + '°C' : '-' }}</span>
            </v-col>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-arrow-up</v-icon>
              <span>Max Temperature: {{ selectedUser.weather ? selectedUser.weather.main.temp_max + '°C' : '-' }}</span>
            </v-col>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-arrow-down</v-icon>
              <span>Min Temperature: {{ selectedUser.weather ? selectedUser.weather.main.temp_min + '°C' : '-' }}</span>
            </v-col>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-weather-windy</v-icon>
              <span>Wind Speed: {{ selectedUser.weather ? selectedUser.weather.wind.speed + ' km/h' : '-' }}</span>
            </v-col>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-water-percent</v-icon>
              <span>Humidity: {{ selectedUser.weather ? selectedUser.weather.main.humidity + '%' : '-' }}</span>
            </v-col>
            <v-col>
              <v-icon size="24" class="mr-2">mdi-gauge</v-icon>
              <span>Pressure: {{ selectedUser.weather ? selectedUser.weather.main.pressure + ' hPa' : '-' }}</span>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" text @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-card>
</template>

<script>
import ApiService from "../services/ApiService";

export default {
  name: "UsersWeather",
  data() {
    return {
      users: [],
      selectedUser: null,
      dialog: false,
    };
  },
  async created() {
    try {
      const response = await ApiService.getUsersWeather();
      this.users = response.data.users;
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    showDialog(user) {
      this.selectedUser = user;
      this.dialog = true;
    },
  },
};
</script>

<style scoped>
  .users-weather {
    margin: 20px;
  }
</style>

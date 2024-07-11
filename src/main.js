/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Components
import App from './App.vue'

// Composables
import { createApp } from 'vue'

// Plugins
import { registerPlugins } from '@/plugins'

// Import WOW.js and animate.css
import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles
// ..


// Create the Vue app
const app = createApp(App)
app.use (AOS.init())
// Register plugins
registerPlugins(app)

// Initialize WOW.js after mounting the app
app.mount('#app', () => {

})

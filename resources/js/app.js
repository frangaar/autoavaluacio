import './bootstrap';
import * as bootstrap from 'bootstrap'
import { createApp } from 'vue';
import Autoavaluacio from './components/Autoavaluacio.vue';
import AutoavalProfesor from './components/AutoavalProfesor.vue';

createApp(Autoavaluacio).mount('#autoavaluacio');
createApp(AutoavalProfesor).mount('#autoavaluacioProvessors');

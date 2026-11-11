import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';
import { createIcons, icons } from 'lucide';
import SpaNavigator from './spa-navigation';

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.lucide = {
    createIcons,
    icons,
    refresh: () => createIcons({ icons })
};

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
    window.spaNavigator = new SpaNavigator();
});

Alpine.start();

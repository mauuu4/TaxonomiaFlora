import './bootstrap';

import Alpine from 'alpinejs';

import imageUploader from './components/image-uploader';

import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
window.L = L;

window.Alpine = Alpine;

Alpine.data('imageUploader', imageUploader);

Alpine.start();

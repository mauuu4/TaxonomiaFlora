import './bootstrap';

import Alpine from 'alpinejs';

import imageUploader from './components/image-uploader';

import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

// Solucionar el problema de los íconos en producción
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
  iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
});

window.L = L;

window.Alpine = Alpine;

Alpine.data('imageUploader', imageUploader);

Alpine.start();

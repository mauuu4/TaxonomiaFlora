import './bootstrap';

import Alpine from 'alpinejs';

import imageUploader from './components/image-uploader';

window.Alpine = Alpine;

Alpine.data('imageUploader', imageUploader);

Alpine.start();

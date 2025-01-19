@props([
    'lat' => 0.35836,  // Coordenada predeterminada
    'lng' => -78.11147, // Coordenada predeterminada
    'interactive' => true // Define si el marcador es interactivo
])
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

<div class="mt-2 h-64 bg-gray-100 rounded-lg border border-gray-200">
    <div id="map" class="h-full rounded-lg"></div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = {{ $lat }};
        const lng = {{ $lng }};
        const interactive = {{ $interactive ? 'true' : 'false' }};
        const zoom = 16;

        // Inicializar el mapa
        const map = L.map('map', {
            scrollWheelZoom: false // Deshabilitar zoom con scroll
        }).setView([lat, lng], zoom);

        // Agregar capas al mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
        }).addTo(map);

        // Añadir un marcador
        const marker = L.marker([lat, lng], {
            draggable: interactive
        }).addTo(map);

        // Si el marcador es interactivo, actualizar inputs de latitud y longitud
        if (interactive) {
            marker.on('dragend', function (event) {
                const position = marker.getLatLng();
                document.getElementById('ubi_latitud').value = position.lat.toFixed(6);
                document.getElementById('ubi_longitud').value = position.lng.toFixed(6);
            });

            map.on('click', function (event) {
                const { lat, lng } = event.latlng;
                marker.setLatLng([lat, lng]);
                document.getElementById('ubi_latitud').value = lat.toFixed(6);
                document.getElementById('ubi_longitud').value = lng.toFixed(6);
            });
        }
         // Habilitar zoom con Ctrl + scroll
         map.getContainer().addEventListener('wheel', function (event) {
            if (event.ctrlKey) {
                map.scrollWheelZoom.enable(); // Activar el zoom con scroll
            } else {
                map.scrollWheelZoom.disable(); // Desactivar el zoom sin la tecla Ctrl
            }
        });
    });
</script>
@endpush

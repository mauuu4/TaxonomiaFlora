@props([
    'lat' => 0.35836,  // Coordenada predeterminada
    'lng' => -78.11147, // Coordenada predeterminada
    'interactive' => true // Define si el marcador es interactivo
])

<div class="mt-2 h-72 bg-gray-100 rounded-lg border border-gray-200 relative z-0">
    <div id="map" class="h-full rounded-lg" x-init="
        $watch('show', value => {
            if (value) {
                setTimeout(() => {
                    if (window.map) {
                        window.map.invalidateSize();
                    }
                }, 100);
            }
        })
    "></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = {{ $lat }};
        const lng = {{ $lng }};
        const interactive = {{ $interactive ? 'true' : 'false' }};
        const zoom = 16;

        // Hacer el mapa accesible globalmente
        window.map = L.map('map').setView([lat, lng], zoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
        }).addTo(window.map);

        const marker = L.marker([lat, lng], {
            draggable: interactive
        }).addTo(window.map);

        // Si el marcador es interactivo, actualizar inputs de latitud y longitud
        if (interactive) {
            marker.on('dragend', function (event) {
                const position = marker.getLatLng();
                document.getElementById('ubi_latitud').value = position.lat.toFixed(5);
                document.getElementById('ubi_longitud').value = position.lng.toFixed(5);
            });

            map.on('click', function (event) {
                const { lat, lng } = event.latlng;
                marker.setLatLng([lat, lng]);
                document.getElementById('ubi_latitud').value = lat.toFixed(5);
                document.getElementById('ubi_longitud').value = lng.toFixed(5);
            });
        }

        // Escuchar cambios en los inputs de latitud y longitud
        document.getElementById('ubi_latitud').addEventListener('input', function () {
            const latValue = parseFloat(this.value);
            const lngValue = parseFloat(document.getElementById('ubi_longitud').value);
            if (!isNaN(latValue) && !isNaN(lngValue)) {
                marker.setLatLng([latValue, lngValue]);
                map.setView([latValue, lngValue], map.getZoom());
            }
        });

        document.getElementById('ubi_longitud').addEventListener('input', function () {
            const lngValue = parseFloat(this.value);
            const latValue = parseFloat(document.getElementById('ubi_latitud').value);
            if (!isNaN(latValue) && !isNaN(lngValue)) {
                marker.setLatLng([latValue, lngValue]);
                map.setView([latValue, lngValue], map.getZoom());
            }
        });
    });
</script>
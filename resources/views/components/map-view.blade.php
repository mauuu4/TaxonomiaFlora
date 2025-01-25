<!-- Map View -->
<div x-show="viewMode === 'map'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
    <div id="species-map" class="w-full h-[600px] bg-gray-200 rounded-lg shadow-md"></div>
</div>

<script>
    // Leaflet Map Initialization
    document.addEventListener('alpine:init', () => {
        const speciesData = [
            @foreach ($registros as $registro)
            {
                lat: {{ $registro->ubi_latitud }},
                lng: {{ $registro->ubi_longitud }},
                name: "{{ $registro->esp_nombre_cientifico }}",
                commonName: "{{ $registro->esp_nombre_comun }}",
                image: "{{ asset('storage/'.$registro->img_ruta) }}",
                id: {{ $registro->esp_id }}
            },
            @endforeach
        ];

        const map = L.map('species-map').setView([0.35836, -78.11147], 16); // Default to Argentina

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        speciesData.forEach(species => {
            if (species.lat !== 0 && species.lng !== 0) {
                const marker = L.marker([species.lat, species.lng]).addTo(map);
                marker.bindPopup(`
                    <div class="p-2">
                        <img src="${species.image}" class="w-32 h-32 object-cover mb-2 rounded">
                        <h3 class="font-bold italic text-emerald-600">${species.name}</h3>
                        <p class="text-gray-600">${species.commonName}</p>
                        <a href="/especies/${species.id}" class="text-indigo-600 hover:underline">Ver detalles</a>
                    </div>
                `);
            }
        });
    });
</script>
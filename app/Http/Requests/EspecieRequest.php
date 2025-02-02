<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecieRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'esp_gene_id' => ['required', 'exists:tax_generos,gene_id'],
            'esp_nombre_cientifico' => [
                'required',
                'min:3',
                'max:50',
                'regex:/^[A-Z][a-z]+\s[a-z]+$/', // Validación para formato de nombre científico
            ],
            'epiteto' => ['required', 'string', 'max:28', 'regex:/^[a-z]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['required', 'string', 'max:500', 'regex:/\S/'],
            'ubi_longitud' => ['required', 'numeric', 'between:-180,180'],
            'ubi_latitud' => ['required', 'numeric', 'between:-90,90'],
            'ubi_region' => ['required', 'string', 'max:30'],
            'ubi_descripcion' => ['nullable', 'string', 'max:500'],
        ];

        if ($this->isMethod('post')) {
            $rules['esp_imagenes'] = ['required', 'array', 'max:5']; // Máximo 5 imágenes
            $rules['esp_imagenes.*'] = ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']; // Validación por cada archivo
            $rules['img_descripcion.*'] = ['nullable', 'string', 'max:255'];
        }

        if ($this->isMethod('put')) {
            $rules['nuevas_imagenes'] = ['nullable', 'array', 'max:5']; // Máximo 5 imágenes nuevas
            $rules['nuevas_imagenes.*'] = ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
            $rules['img_descripcion.*'] = ['nullable', 'string', 'max:255'];
            $rules['img_descripcion_nueva.*'] = ['nullable', 'string', 'max:255'];
            $rules['imagenes_eliminar'] = ['nullable', 'array', 'max:5']; // Máximo 5 imágenes a eliminar
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'esp_gene_id.required' => 'Debe seleccionar un género',
            'esp_gene_id.exists' => 'El género seleccionado no existe en nuestra base de datos.',

            'epiteto.required' => 'El epíteto específico es obligatorio.',
            'epiteto.string' => 'El epíteto específico debe ser una cadena de texto.',
            'epiteto.max' => 'El epíteto específico no puede exceder los 28 caracteres.',
            'epiteto.regex' => 'El epíteto específico debe contener solo letras minúsculas (ejemplo: "glabra").',
            
            'esp_nombre_cientifico.required' => 'El nombre científico es obligatorio.',
            'esp_nombre_cientifico.min' => 'El nombre científico debe tener al menos 3 caracteres.',
            'esp_nombre_cientifico.max' => 'El nombre científico no puede exceder los 50 caracteres.',
            'esp_nombre_cientifico.regex' => 'El nombre científico debe comenzar con el género con la primera letra en mayúscula seguido del epíteto específico en minúsculas.',
    
            'esp_nombre_comun.required' => 'El nombre común es obligatorio.',
            'esp_nombre_comun.min' => 'El nombre común debe tener al menos 3 caracteres.',
            'esp_nombre_comun.max' => 'El nombre común no puede exceder los 50 caracteres.',
            'esp_nombre_comun.regex' => 'El nombre común debe contener solo letras, números, espacios y algunos caracteres especiales como acentos y guiones.',
    
            'esp_descripcion.max' => 'La descripción no puede exceder los 500 caracteres.',
            'ubi_longitud.required' => 'La longitud es obligatoria.',
            'ubi_longitud.numeric' => 'La longitud debe ser un número.',
            'ubi_longitud.between' => 'La longitud debe estar entre -180 y 180 grados.',
            'ubi_latitud.required' => 'La latitud es obligatoria.',
            'ubi_latitud.numeric' => 'La latitud debe ser un número.',
            'ubi_latitud.between' => 'La latitud debe estar entre -90 y 90 grados.',
            'ubi_region.required' => 'La región es obligatoria.',
            'ubi_region.string' => 'La región debe ser una cadena de texto.',
            'ubi_region.max' => 'La región no puede exceder los 30 caracteres.',
            'ubi_descripcion.max' => 'La descripción de la ubicación no puede exceder los 500 caracteres.',
            
            'esp_imagenes.required' => 'Las imágenes son obligatorias.',
            'esp_imagenes.array' => 'Las imágenes deben ser un arreglo.',
            'esp_imagenes.max' => 'No puede subir más de 5 imágenes.',
            'esp_imagenes.*.image' => 'Cada archivo debe ser una imagen válida.',
            'esp_imagenes.*.mimes' => 'Las imágenes deben ser de tipo: jpeg, png, jpg, gif.',
            'esp_imagenes.*.max' => 'Cada imagen no puede exceder los 2MB.',
        ];
    }    
}

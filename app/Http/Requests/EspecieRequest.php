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
            'esp_nombre_cientifico' => ['required','min:3','max:50', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['nullable', 'string', 'max:500', 'regex:/\S/'],
            'ubi_longitud' => ['required', 'numeric', 'between:-180,180'],
            'ubi_latitud' => ['required', 'numeric', 'between:-90,90'],
            'ubi_region' => ['required', 'string', 'max:30'],
            'ubi_descripcion' => ['nullable', 'string', 'max:500'],
        ];

         if ($this->isMethod('post')) {
            $rules['imagenes.*'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
            $rules['img_descripcion.*'] = ['nullable', 'string', 'max:255'];
        }

        if ($this->isMethod('put')) {
            $rules['nuevas_imagenes.*'] = ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
            $rules['nuevas_img_descripcion.*'] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }
}

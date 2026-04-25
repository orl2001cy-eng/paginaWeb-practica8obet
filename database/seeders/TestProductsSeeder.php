<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class TestProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Aceite de Rosa Mosqueta', 'price' => 15.50, 'description' => 'Aceite puro prensado en frío para regenerar y nutrir la piel.'],
            ['name' => 'Crema Hidratante de Aloe', 'price' => 22.00, 'description' => 'Crema ligera y refrescante con extracto puro de aloe vera.'],
            ['name' => 'Sérum de Vitamina C Botánico', 'price' => 35.00, 'description' => 'Sérum antioxidante con extractos de frutas para iluminar el rostro.'],
            ['name' => 'Exfoliante de Café y Coco', 'price' => 18.00, 'description' => 'Exfoliante natural corporal que remueve células muertas y activa la circulación.'],
            ['name' => 'Mascarilla de Arcilla Verde', 'price' => 12.50, 'description' => 'Purifica y equilibra las pieles grasas o mixtas.'],
            ['name' => 'Bálsamo Labial de Manteca', 'price' => 6.00, 'description' => 'Hidratación profunda para labios resecos con karité.'],
            ['name' => 'Jabón Artesanal de Lavanda', 'price' => 8.50, 'description' => 'Relajante jabón corporal hecho con aceites esenciales.'],
            ['name' => 'Tónico Facial de Rosas', 'price' => 14.00, 'description' => 'Tónico refrescante sin alcohol para equilibrar el pH.'],
            ['name' => 'Aceite de Árbol de Té', 'price' => 11.00, 'description' => 'Propiedades antibacterianas naturales para imperfecciones.'],
            ['name' => 'Champú Sólido de Romero', 'price' => 16.50, 'description' => 'Fortalece el cuero cabelludo y estimula el crecimiento.'],
            ['name' => 'Acondicionador de Aguacate', 'price' => 19.00, 'description' => 'Nutre intensamente el cabello seco o dañado.'],
            ['name' => 'Loción Corporal de Almendras', 'price' => 24.00, 'description' => 'Suaviza y protege la piel con aceite de almendras dulces.'],
            ['name' => 'Desodorante Piedra Alumbre', 'price' => 9.00, 'description' => 'Protección duradera sin aluminio sintético.'],
            ['name' => 'Contorno de Ojos Hialurónico', 'price' => 28.00, 'description' => 'Reduce bolsas y líneas de expresión con ácido hialurónico vegetal.'],
            ['name' => 'Manteca Corporal de Cacao', 'price' => 21.50, 'description' => 'Hidratación extrema para zonas secas del cuerpo.'],
            ['name' => 'Agua Micelar de Manzanilla', 'price' => 13.00, 'description' => 'Desmaquillante suave que respeta las pieles más sensibles.']
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

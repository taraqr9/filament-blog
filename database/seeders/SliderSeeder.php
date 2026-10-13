<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'sliders/amjad-rana-MrKPi-yajC0-unsplash.jpg',
            'sliders/md-emam-hossain-ripon-BPfh-zXSLho-unsplash.jpg',
            'sliders/md-parvez-hossen-yq4Fx0VNxHU-unsplash.jpg',
            'sliders/osama-adnan-eMRWbPRJwUE-unsplash.jpg',
            'sliders/ashraful-alam-IMX8wIrCjhE-unsplash.jpg',
        ];

        foreach ($images as $index => $image) {
            Slider::firstOrCreate(
                ['image_path' => $image],
                [
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }
}

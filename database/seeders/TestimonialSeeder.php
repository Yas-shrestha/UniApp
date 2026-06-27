<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Kate Winslet',
                'role' => 'HR Manager',
                'company' => 'Google',
                'image' => 'assets/img/testimonials/testimonials-1.jpg',
                'rating' => 5,
                'testimonial' => 'The preference system has significantly improved our recruitment workflow.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Tom Anderson',
                'role' => 'Operations Manager',
                'company' => 'Microsoft',
                'image' => 'assets/img/testimonials/testimonials-2.jpg',
                'rating' => 5,
                'testimonial' => 'Excellent service with a professional team.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Elena Brooks',
                'role' => 'HR Manager',
                'company' => 'Amazon',
                'image' => 'assets/img/testimonials/testimonials-3.jpg',
                'rating' => 5,
                'testimonial' => 'The platform is easy to use and the support team is always responsive.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sophia Martinez',
                'role' => 'Marketing Lead',
                'company' => 'Meta',
                'image' => 'assets/img/avatar-2.webp',
                'rating' => 5,
                'testimonial' => 'Professional, reliable, and highly recommended.',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Marcus Sterling',
                'role' => 'Project Manager',
                'company' => 'Netflix',
                'image' => 'assets/img/avatar-1.webp',
                'rating' => 5,
                'testimonial' => 'Fast, efficient, and dependable.',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Aiden Patel',
                'role' => 'Business Consultant',
                'company' => 'Adobe',
                'image' => 'assets/img/avatar-3.webp',
                'rating' => 5,
                'testimonial' => 'A fantastic experience from beginning to end.',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
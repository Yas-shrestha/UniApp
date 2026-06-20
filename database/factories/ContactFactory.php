<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'subject' => $this->faker->randomElement([
                'Admissions Enquiry',
                'Financial Aid',
                'Academic Programs',
                'Campus Services',
                'General Information'
            ]),
            'message' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['unread', 'read', 'replied']),
            'read_at' => null,
            'replied_at' => null,
            'admin_reply' => null,
        ];
    }
}

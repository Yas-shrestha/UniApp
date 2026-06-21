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
            'company_name' => $this->faker->company(),
            'job_title' => $this->faker->jobTitle(),
            'job_details' => $this->faker->sentence(),
            'phone' => $this->faker->phoneNumber(),
            'message' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['unread', 'read', 'replied']),
            'read_at' => null,
            'replied_at' => null,
            'admin_reply' => null,
        ];
    }
}

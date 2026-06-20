<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventRegistrationFactory extends Factory
{
    protected $model = EventRegistration::class;

    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'participant_type' => $this->faker->randomElement([
                'undergraduate',
                'postgraduate',
                'faculty',
                'alumni',
                'external'
            ]),
            'message' => $this->faker->optional()->paragraph(),
            'status' => 'pending',
            'registration_code' => 'REG-' . strtoupper($this->faker->bothify('????####')),
            'registered_at' => now(),
            'confirmed_at' => null,
        ];
    }

    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ];
        });
    }

    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'cancelled',
            ];
        });
    }
}

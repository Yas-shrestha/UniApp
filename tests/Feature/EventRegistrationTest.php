<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_event_detail_page()
    {
        $event = Event::factory()->create();

        $response = $this->get(route('events.show', $event->slug));
        $response->assertStatus(200);
        $response->assertViewIs('frontend.event-detail');
        $response->assertSee($event->title);
    }

    /** @test */
    public function it_can_register_for_event()
    {
        $event = Event::factory()->create(['seats' => 10]);

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'participant_type' => 'undergraduate',
            'message' => 'Excited to attend!',
        ];

        $response = $this->post(route('events.register', $event), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('event_registrations', [
            'event_id' => $event->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_prevents_duplicate_registration()
    {
        $event = Event::factory()->create(['seats' => 10]);

        EventRegistration::factory()->create([
            'event_id' => $event->id,
            'email' => 'john@example.com',
        ]);

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'participant_type' => 'undergraduate',
        ];

        $response = $this->post(route('events.register', $event), $data);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_prevents_registration_when_event_is_fully_booked()
    {
        $event = Event::factory()->create(['seats' => 1]);

        EventRegistration::factory()->create([
            'event_id' => $event->id,
            'status' => 'confirmed',
        ]);

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'participant_type' => 'undergraduate',
        ];

        $response = $this->post(route('events.register', $event), $data);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_validates_registration_fields()
    {
        $event = Event::factory()->create();

        $response = $this->post(route('events.register', $event), []);

        $response->assertSessionHasErrors(['name', 'email', 'participant_type']);
    }
}

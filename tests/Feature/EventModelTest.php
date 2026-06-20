<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_calculates_available_seats()
    {
        $event = Event::factory()->create(['seats' => 10]);

        EventRegistration::factory()->count(3)->create([
            'event_id' => $event->id,
            'status' => 'confirmed',
        ]);

        $this->assertEquals(7, $event->available_seats);
    }

    /** @test */
    public function it_checks_if_event_is_fully_booked()
    {
        $event = Event::factory()->create(['seats' => 2]);

        EventRegistration::factory()->count(2)->create([
            'event_id' => $event->id,
            'status' => 'confirmed',
        ]);

        $this->assertTrue($event->isFullyBooked());
    }

    /** @test */
    public function it_checks_if_event_has_available_seats()
    {
        $event = Event::factory()->create(['seats' => 5]);

        EventRegistration::factory()->count(2)->create([
            'event_id' => $event->id,
            'status' => 'confirmed',
        ]);

        $this->assertTrue($event->hasAvailableSeats());
    }

    /** @test */
    public function it_scopes_upcoming_events()
    {
        Event::factory()->create(['date' => now()->addDays(5)]);
        Event::factory()->create(['date' => now()->subDays(5)]);

        $upcoming = Event::upcoming()->get();

        $this->assertCount(1, $upcoming);
    }

    /** @test */
    public function it_scopes_past_events()
    {
        Event::factory()->create(['date' => now()->addDays(5)]);
        Event::factory()->create(['date' => now()->subDays(5)]);

        $past = Event::past()->get();

        $this->assertCount(1, $past);
    }
}

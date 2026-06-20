<?php

namespace Tests\Feature\Admin;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRegistrationAdminTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    /** @test */
    public function it_shows_registrations_list()
    {
        EventRegistration::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(route('admin.registrations.index'))
            ->assertStatus(200)
            ->assertViewIs('backend.event-registrations.index');
    }

    /** @test */
    public function it_filters_registrations_by_event()
    {
        $event1 = Event::factory()->create(['title' => 'Event 1']);
        $event2 = Event::factory()->create(['title' => 'Event 2']);

        EventRegistration::factory()->create(['event_id' => $event1->id]);
        EventRegistration::factory()->create(['event_id' => $event2->id]);

        $this->actingAs($this->admin)
            ->get(route('admin.registrations.index', ['event_id' => $event1->id]))
            ->assertStatus(200)
            ->assertSee($event1->title);
    }

    /** @test */
    public function it_filters_registrations_by_status()
    {
        EventRegistration::factory()->create(['status' => 'pending']);
        EventRegistration::factory()->create(['status' => 'confirmed']);

        $this->actingAs($this->admin)
            ->get(route('admin.registrations.index', ['status' => 'pending']))
            ->assertStatus(200)
            ->assertSee('Pending');
    }

    /** @test */
    public function it_shows_single_registration()
    {
        $registration = EventRegistration::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.registrations.show', $registration->id))
            ->assertStatus(200)
            ->assertViewIs('backend.event-registrations.show')
            ->assertSee($registration->name);
    }

    /** @test */
    public function it_updates_registration_status()
    {
        $registration = EventRegistration::factory()->create(['status' => 'pending']);

        $this->actingAs($this->admin)
            ->put(route('admin.registrations.update', $registration->id), [
                'status' => 'confirmed',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('event_registrations', [
            'id' => $registration->id,
            'status' => 'confirmed',
        ]);
    }

    /** @test */
    public function it_deletes_registration()
    {
        $registration = EventRegistration::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.registrations.destroy', $registration->id))
            ->assertRedirect(route('admin.registrations.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('event_registrations', ['id' => $registration->id]);
    }

    /** @test */
    public function it_exports_registrations_to_csv()
    {
        EventRegistration::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(route('admin.registrations.export'))
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'text/csv');
    }
}

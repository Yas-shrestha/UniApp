<?php

namespace Tests\Feature\Admin;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactAdminTest extends TestCase
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
    public function it_shows_contact_messages_list()
    {
        Contact::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(route('admin.contact.index'))
            ->assertStatus(200)
            ->assertViewIs('backend.contact.index');
    }

    /** @test */
    public function it_filters_contact_messages_by_status()
    {
        Contact::factory()->create(['status' => 'unread']);
        Contact::factory()->create(['status' => 'read']);

        $this->actingAs($this->admin)
            ->get(route('admin.contact.index', ['status' => 'unread']))
            ->assertStatus(200)
            ->assertSee('unread');
    }

    /** @test */
    public function it_filters_contact_messages_by_search()
    {
        Contact::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        Contact::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);

        $this->actingAs($this->admin)
            ->get(route('admin.contact.index', ['search' => 'John']))
            ->assertStatus(200)
            ->assertSee('John Doe');
    }

    /** @test */
    public function it_shows_single_contact_message()
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $this->actingAs($this->admin)
            ->get(route('admin.contact.show', $contact->id))
            ->assertStatus(200)
            ->assertViewIs('backend.contact.show')
            ->assertSee($contact->name)
            ->assertSee($contact->message);
    }

    /** @test */
    public function it_marks_contact_as_read_when_viewing()
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $this->actingAs($this->admin)
            ->get(route('admin.contact.show', $contact->id));

        $this->assertDatabaseHas('contact', [
            'id' => $contact->id,
            'status' => 'read',
        ]);
    }

    /** @test */
    public function it_deletes_contact_message()
    {
        $contact = Contact::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.contact.destroy', $contact->id))
            ->assertRedirect(route('admin.contact.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('contact', ['id' => $contact->id]);
    }

    /** @test */
    public function it_marks_contact_as_read()
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $this->actingAs($this->admin)
            ->post(route('admin.contact.read', $contact->id))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact', [
            'id' => $contact->id,
            'status' => 'read',
        ]);
    }

    /** @test */
    public function it_marks_contact_as_replied()
    {
        $contact = Contact::factory()->create(['status' => 'read']);

        $this->actingAs($this->admin)
            ->post(route('admin.contact.replied', $contact->id))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact', [
            'id' => $contact->id,
            'status' => 'replied',
        ]);
    }
}

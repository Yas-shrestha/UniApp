<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_contact_page()
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
        $response->assertViewIs('frontend.contact');
        $response->assertSee('Contact Us');
    }

    /** @test */
    public function it_can_store_contact_message()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'subject' => 'Admissions Enquiry',
            'message' => 'I would like to know more about admissions.',
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Admissions Enquiry',
            'status' => 'unread',
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'subject' => 'Test Subject',
            'message' => 'Test message',
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_minimum_message_length()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'Short',
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['message']);
    }

    /** @test */
    public function it_validates_max_message_length()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => str_repeat('a', 1001),
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['message']);
    }
}

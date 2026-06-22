<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected function validContactData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'company_name' => 'Acme Corporation',
            'job_title' => 'Admissions Coordinator',
            'job_details' => 'Looking for information about undergraduate admissions',
            'phone' => '+1234567890',
            'message' => 'I would like to know more about admissions.',
        ], $overrides);
    }

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
        $response = $this->post(route('contact.store'), $this->validContactData());

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'company_name' => 'Acme Corporation',
            'job_title' => 'Admissions Coordinator',
            'job_details' => 'Looking for information about undergraduate admissions',
            'status' => 'unread',
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'company_name', 'job_title', 'job_details', 'message']);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $data = $this->validContactData([
            'email' => 'invalid-email',
        ]);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_minimum_message_length()
    {
        $data = $this->validContactData([
            'message' => 'Short',
        ]);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['message']);
    }

    /** @test */
    public function it_validates_max_message_length()
    {
        $data = $this->validContactData([
            'message' => str_repeat('a', 1001),
        ]);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['message']);
    }

    /** @test */
    public function it_rejects_name_with_numbers()
    {
        $data = $this->validContactData([
            'name' => 'John Doe 123',
        ]);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_rejects_phone_with_letters()
    {
        $data = $this->validContactData([
            'phone' => '+1234567890abc',
        ]);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['phone']);
    }

    /** @test */
    public function it_accepts_valid_phone_formats()
    {
        $validPhones = [
            '+1-234-567-8900',
            '(123) 456-7890',
            '123.456.7890',
            '+1 (555) 019-9300',
        ];

        foreach ($validPhones as $phone) {
            $data = $this->validContactData([
                'phone' => $phone,
            ]);

            $response = $this->post(route('contact.store'), $data);

            $response->assertRedirect();
            $response->assertSessionHas('success');
            $response->assertSessionMissing('errors');
        }
    }
}

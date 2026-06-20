<?php

namespace Tests\Unit;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_marks_contact_as_read()
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $contact->markAsRead();

        $this->assertEquals('read', $contact->status);
        $this->assertNotNull($contact->read_at);
    }

    /** @test */
    public function it_marks_contact_as_replied()
    {
        $contact = Contact::factory()->create(['status' => 'read']);

        $contact->markAsReplied('Thank you for your message.');

        $this->assertEquals('replied', $contact->status);
        $this->assertNotNull($contact->replied_at);
        $this->assertEquals('Thank you for your message.', $contact->admin_reply);
    }

    /** @test */
    public function it_checks_if_contact_is_unread()
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $this->assertTrue($contact->isUnread());
        $this->assertFalse($contact->isRead());
    }

    /** @test */
    public function it_scopes_unread_contacts()
    {
        Contact::factory()->create(['status' => 'unread']);
        Contact::factory()->create(['status' => 'read']);
        Contact::factory()->create(['status' => 'replied']);

        $unread = Contact::unread()->get();

        $this->assertCount(1, $unread);
    }
}

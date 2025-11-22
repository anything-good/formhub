<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class FormHubTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can be created using the factory.
     */
    public function test_user_can_be_created(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /**
     * Test that a form can be created with valid data.
     */
    public function test_form_can_be_created(): void
    {
        $user = User::factory()->create();

        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Test Form',
            'description' => 'This is a test form.',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('forms', [
            'title' => 'Test Form',
            'status' => 'published',
        ]);
    }

    /**
     * Test that a form is automatically assigned to the authenticated user.
     */
    public function test_form_automatically_assigned_to_user(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $form = Form::create([
            'title' => 'User Form',
        ]);

        $this->assertEquals($user->id, $form->user_id);
        $this->assertDatabaseHas('forms', [
            'title' => 'User Form',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that a form requires a title (Database Constraint).
     */
    public function test_form_requires_title(): void
    {
        $user = User::factory()->create();

        $this->expectException(QueryException::class);

        Form::create([
            'user_id' => $user->id,
            // 'title' is missing
            'description' => 'Form without title',
        ]);
    }

    /**
     * Test that a form can update its status.
     */
    public function test_form_can_update_status(): void
    {
        $user = User::factory()->create();
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Status Test',
            'status' => 'draft',
        ]);

        $form->update(['status' => 'published']);

        $this->assertDatabaseHas('forms', [
            'id' => $form->id,
            'status' => 'published',
        ]);
    }
}

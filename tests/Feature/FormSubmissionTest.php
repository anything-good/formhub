<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_submission_saves_values()
    {
        $user = User::factory()->create();
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Test Form',
            'status' => 'published',
        ]);

        $field = Field::create([
            'form_id' => $form->id,
            'type' => 'text',
            'label' => 'Name',
            'order' => 1,
        ]);

        $response = $this->actingAs($user)
            ->post("/forms/{$form->id}/submit", [
                'field_' . $field->id => 'John Doe',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('form_submissions', [
            'form_id' => $form->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('submission_values', [
            'field_id' => $field->id,
            'value' => 'John Doe',
        ]);
    }

    public function test_form_submission_validates_required_fields()
    {
        $user = User::factory()->create();
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Required Form',
            'status' => 'published',
        ]);

        $field = Field::create([
            'form_id' => $form->id,
            'type' => 'text',
            'label' => 'Required Name',
            'required' => true,
            'order' => 1,
        ]);

        $response = $this->actingAs($user)
            ->post("/forms/{$form->id}/submit", [
                // Missing required field
            ]);

        $response->assertSessionHasErrors(['field_' . $field->id]);
    }
}

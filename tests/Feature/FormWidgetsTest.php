<?php

namespace Tests\Feature;

use App\Filament\Resources\Forms\Widgets\FieldResultsChart;
use App\Filament\Resources\Forms\Widgets\SubmissionCountChart;
use App\Models\Field;
use App\Models\FieldOption;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\SubmissionValue;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FormWidgetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_submission_count_chart_loads()
    {
        $user = User::factory()->create();
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Test Form',
            'status' => 'published',
        ]);

        FormSubmission::create([
            'form_id' => $form->id,
            'user_id' => $user->id,
            'submitted_at' => now(),
        ]);

        Livewire::test(SubmissionCountChart::class, ['record' => $form])
            ->assertSuccessful();
    }

    public function test_field_results_chart_loads_and_filters()
    {
        $user = User::factory()->create();
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Test Form',
            'status' => 'published',
        ]);

        $field = Field::create([
            'form_id' => $form->id,
            'type' => 'dropdown',
            'label' => 'Country',
            'order' => 1,
        ]);

        $option = FieldOption::create([
            'field_id' => $field->id,
            'label' => 'USA',
            'value' => 'usa',
        ]);

        $submission = FormSubmission::create([
            'form_id' => $form->id,
            'user_id' => $user->id,
            'submitted_at' => now(),
        ]);

        SubmissionValue::create([
            'submission_id' => $submission->id,
            'field_id' => $field->id,
            'value' => 'usa',
            'option_id' => $option->id,
        ]);

        Livewire::test(FieldResultsChart::class, ['record' => $form])
            ->assertSuccessful()
            ->set('filter', $field->id)
            ->assertSet('filter', $field->id);
    }
}

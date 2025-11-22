<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\SubmissionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    public function store(Request $request, Form $form)
    {
        // -----------------------------------
        // 1. Build VALIDATION rules dynamically
        // -----------------------------------
        $rules = [];

        foreach ($form->fields as $field) {
            $name = 'field_' . $field->id;

            // basic rule (you can extend depending on your needs)
            $rule = [];

            if ($field->is_required) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            if ($field->type === 'checkbox') {
                $rule[] = 'array'; // checkbox returns array[]
            }

            $rules[$name] = $rule;
        }

        $validated = $request->validate($rules);


        // -----------------------------------
        // 2. Create the form submission
        // -----------------------------------
        $submission = FormSubmission::create([
            'form_id' => $form->id,
            'user_id' => Auth::id(),
            'submitted_at' => now(),
        ]);


        // -----------------------------------
        // 3. Save submitted VALUES
        // -----------------------------------
        foreach ($form->fields as $field) {
            $name = 'field_' . $field->id;
            $submittedValue = $validated[$name] ?? null;

            // CASE: CHECKBOX (multiple values)
            if ($field->type === 'checkbox' && is_array($submittedValue)) {
                foreach ($submittedValue as $val) {
                    SubmissionValue::create([
                        'submission_id' => $submission->id,
                        'field_id' => $field->id,
                        'value' => $val,
                        'option_id' => $field->options()->where('value', $val)->value('id'),
                    ]);
                }
                continue;
            }

            // CASE: DROPDOWN (1 value, but tied to an option)
            if ($field->type === 'dropdown') {
                SubmissionValue::create([
                    'submission_id' => $submission->id,
                    'field_id' => $field->id,
                    'value' => $submittedValue,
                    'option_id' => $field->options()->where('value', $submittedValue)->value('id'),
                ]);
                continue;
            }

            // CASE: NORMAL FIELD (text, textarea, rating, date, time, datetime…)
            SubmissionValue::create([
                'submission_id' => $submission->id,
                'field_id' => $field->id,
                'value' => $submittedValue,
                'option_id' => null,
            ]);
        }


        // -----------------------------------
        // 4. Return response
        // -----------------------------------
        return back()->with('success', 'Form submitted successfully!');
    }
}

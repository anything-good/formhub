<?php

namespace App\Filament\Resources\Forms\Widgets;

use App\Filament\Resources\Forms\FormResource;
use App\Models\Form;
use Filament\Widgets\Widget;

class FormNumber extends Widget
{
    // add form count 
    protected string $view = 'filament.resources.forms.widgets.form-number';

    protected function getViewData(): array
    {
        return [
            'formCount' => Form::count(),
        ];
    }
}

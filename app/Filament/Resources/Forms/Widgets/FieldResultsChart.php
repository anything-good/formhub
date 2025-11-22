<?php

namespace App\Filament\Resources\Forms\Widgets;

use App\Models\Field;
use App\Models\SubmissionValue;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class FieldResultsChart extends ChartWidget
{
    protected ?string $heading = 'Field Results';

    public ?Model $record = null;

    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        if (!$this->record) {
            return [];
        }

        return $this->record->fields()
            ->whereIn('type', ['dropdown', 'checkbox', 'radio', 'rating'])
            ->pluck('label', 'id')
            ->toArray();
    }

    protected function getData(): array
    {
        $fieldId = $this->filter;

        if (!$fieldId) {
            // Default to first available field if any
            $firstField = $this->getFilters() ? array_key_first($this->getFilters()) : null;
            if ($firstField) {
                $fieldId = $firstField;
            } else {
                return [
                    'datasets' => [],
                    'labels' => [],
                ];
            }
        }

        $data = SubmissionValue::where('field_id', $fieldId)
            ->selectRaw('value, count(*) as count')
            ->groupBy('value')
            ->pluck('count', 'value');

        // If field has options, we might want to map values to labels if they differ,
        // but for now we used slugified values. Ideally we should join with options or just use the value.
        // Since we backfilled values, they are slugs. We can try to find the option label for display.

        $labels = $data->keys()->map(function ($value) use ($fieldId) {
            $option = \App\Models\FieldOption::where('field_id', $fieldId)->where('value', $value)->first();
            return $option ? $option->label : $value;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Responses',
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#36A2EB',
                        '#FF6384',
                        '#4BC0C0',
                        '#FF9F40',
                        '#9966FF',
                        '#FFCD56',
                        '#C9CBCF'
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}

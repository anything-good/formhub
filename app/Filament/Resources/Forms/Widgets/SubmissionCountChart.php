<?php

namespace App\Filament\Resources\Forms\Widgets;

use App\Models\FormSubmission;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Model;

class SubmissionCountChart extends ChartWidget
{
    protected ?string $heading = 'Submissions Over Time';

    public ?Model $record = null;

    protected function getData(): array
    {
        $data = Trend::query(FormSubmission::query()->where('form_id', $this->record->id))
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Submissions',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

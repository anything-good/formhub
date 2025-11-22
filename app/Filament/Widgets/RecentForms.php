<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RecentForms extends Widget
{

    protected string $view = 'filament.widgets.recent-forms';

    protected static int|null $sort = 999;

    protected int|string|array $columnSpan = 'full';

}

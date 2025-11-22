<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'field_id',
        'value',
        'option_id',
    ];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'submission_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function option()
    {
        return $this->belongsTo(FieldOption::class, 'option_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_id',
        'label',
        'type',
        'required',
        'order',
        'settings',
    ];

    protected $casts = [
        'required' => 'boolean',
        'settings' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function options()
    {
        return $this->hasMany(FieldOption::class)->orderBy('order');
    }

    public function submissionValues()
    {
        return $this->hasMany(SubmissionValue::class, 'field_id');
    }
}

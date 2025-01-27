<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'position_id',
        'designation_id',
        'employment_classification',
        'status',
        'sex',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
    ];

    protected $appends = [
        'full_name',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}

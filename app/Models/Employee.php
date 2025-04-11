<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_number',
        'position',
        'office_colleges',
        'employment_classification',
        'status',
        'sex',
        'image',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'philhealth_id',
        'pag_ibig_id',
        'tin_id',
        'gsis_id',
        'password',
    ];

    protected $appends = [
        'full_name',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'owner_id');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->last_name}, {$this->first_name} {$this->middle_name}";
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

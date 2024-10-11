<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachersInformation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_name',
        'teacher_email',
        'teacher_password',
        'teacher_role',
        'teacher_photo',
        'user_id', // Foreign key for the user (school)
    ];

    /**
     * The user (school) that this teacher belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

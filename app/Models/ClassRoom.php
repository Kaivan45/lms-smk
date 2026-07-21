<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database tetap "classes", tapi nama model
     * "ClassRoom" karena "Class" adalah reserved word di PHP.
     */
    protected $table = 'classes';

    protected $fillable = ['name', 'academic_year_id', 'homeroom_teacher_id'];

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function homeroomTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    /**
     * Siswa-siswa yang ada di kelas ini.
     */
    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'class_id')->where('role', 'siswa');
    }

    public function teachingAssignments(): HasMany
    {
        return $this->hasMany(TeachingAssignment::class, 'class_id');
    }
}

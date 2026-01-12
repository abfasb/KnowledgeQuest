<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    protected $table = 'classes';
    
    protected $fillable = [
        'name',
        'description',
        'class_code',
        'teacher_id',
        'is_active'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'class_user')
                    ->withPivot('status', 'joined_at')
                    ->withTimestamps();
    }

    public function activeStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'class_user')
                    ->wherePivot('status', 'active')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function publishedQuizzes(): HasMany
    {
        return $this->hasMany(Quiz::class)->where('is_published', true);
    }

    public function pendingStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'class_user')
                    ->wherePivot('status', 'pending')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    public function generateClassCode(): string
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 6));
        } while (self::where('class_code', $code)->exists());
        
        return $code;
    }
}
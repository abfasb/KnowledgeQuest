<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'class_id',
        'difficulty',
        'time_limit',
        'total_points',
        'is_published',
        'start_date',
        'end_date',
        'shuffle_questions',
        'shuffle_options',
        'show_result_immediately',
        'attempts_allowed'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'shuffle_questions' => 'boolean',
        'shuffle_options' => 'boolean',
        'show_result_immediately' => 'boolean',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function userAttempts($userId): HasMany
    {
        return $this->hasMany(QuizAttempt::class)->where('user_id', $userId);
    }

    public function isActive(): bool
    {
        if (!$this->is_published) {
            return false;
        }

        $now = now();
        
        if ($this->start_date && $this->start_date > $now) {
            return false;
        }

        if ($this->end_date && $this->end_date < $now) {
            return false;
        }

        return true;
    }

    public function getRemainingAttempts($userId): int
    {
        $attemptsCount = $this->userAttempts($userId)->count();
        return max(0, $this->attempts_allowed - $attemptsCount);
    }
}
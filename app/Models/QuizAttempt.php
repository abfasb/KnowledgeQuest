<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'attempt_number',
        'total_score',
        'total_points_earned',
        'total_questions',
        'correct_answers',
        'incorrect_answers',
        'started_at',
        'completed_at',
        'time_taken',
        'status'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAttemptAnswer::class);
    }

    public function complete(array $data = []): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
            'time_taken' => now()->diffInSeconds($this->started_at),
            ...$data
        ]);
    }

    public function calculateScore(): array
    {
        $totalPoints = 0;
        $totalPossible = 0;
        $correct = 0;
        $incorrect = 0;

        foreach ($this->answers as $answer) {
            $totalPossible += $answer->question->points;
            $totalPoints += $answer->points_earned;
            
            if ($answer->is_correct) {
                $correct++;
            } else {
                $incorrect++;
            }
        }

        $score = $totalPossible > 0 ? ($totalPoints / $totalPossible) * 100 : 0;

        return [
            'score' => round($score, 2),
            'points_earned' => $totalPoints,
            'total_possible' => $totalPossible,
            'correct' => $correct,
            'incorrect' => $incorrect
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class QuizHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'difficulty',
        'score',
        'total_questions',
        'correct_answers',
        'incorrect_answers',
        'percentage',
        'points_earned',
        'time_taken',
        'details'
    ];

    protected $casts = [
        'details' => 'array',
        'percentage' => 'decimal:2',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function formattedTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                $minutes = floor($this->time_taken / 60);
                $seconds = $this->time_taken % 60;
                return sprintf('%02d:%02d', $minutes, $seconds);
            }
        );
    }

    protected function performanceLevel(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->percentage >= 90) return 'excellent';
                if ($this->percentage >= 75) return 'great';
                if ($this->percentage >= 60) return 'good';
                if ($this->percentage >= 40) return 'average';
                return 'poor';
            }
        );
    }
}
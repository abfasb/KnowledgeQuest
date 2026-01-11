<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_points',
        'total_quizzes',
        'total_questions_attempted',
        'total_correct_answers',
        'total_incorrect_answers',
        'accuracy',
        'current_streak',
        'max_streak',
        'last_quiz_date',
        'category_stats',
        'difficulty_stats'
    ];

    protected $casts = [
        'category_stats' => 'array',
        'difficulty_stats' => 'array',
        'last_quiz_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateStats($quizResult)
    {
        // Calculate new totals
        $this->total_points += $quizResult['points_earned'];
        $this->total_quizzes += 1;
        $this->total_questions_attempted += $quizResult['total_questions'];
        $this->total_correct_answers += $quizResult['correct_answers'];
        $this->total_incorrect_answers += $quizResult['incorrect_answers'];
        
        // Update accuracy
        $this->accuracy = $this->total_questions_attempted > 0 
            ? round(($this->total_correct_answers / $this->total_questions_attempted) * 100, 2)
            : 0;

        // Update streak
        $today = now()->toDateString();
        if ($this->last_quiz_date && $this->last_quiz_date->addDay()->toDateString() === $today) {
            $this->current_streak += 1;
        } else if (!$this->last_quiz_date || $this->last_quiz_date->toDateString() !== $today) {
            $this->current_streak = 1;
        }
        
        $this->max_streak = max($this->max_streak, $this->current_streak);
        $this->last_quiz_date = $today;

        // Update category stats
        $category = $quizResult['category'] ?? 'General';
        $categoryStats = $this->category_stats ?? [];
        if (!isset($categoryStats[$category])) {
            $categoryStats[$category] = ['quizzes' => 0, 'correct' => 0, 'total' => 0];
        }
        $categoryStats[$category]['quizzes']++;
        $categoryStats[$category]['correct'] += $quizResult['correct_answers'];
        $categoryStats[$category]['total'] += $quizResult['total_questions'];
        $this->category_stats = $categoryStats;

        // Update difficulty stats
        $difficulty = $quizResult['difficulty'] ?? 'Mixed';
        $difficultyStats = $this->difficulty_stats ?? [];
        if (!isset($difficultyStats[$difficulty])) {
            $difficultyStats[$difficulty] = ['quizzes' => 0, 'average_score' => 0];
        }
        $difficultyStats[$difficulty]['quizzes']++;
        $difficultyStats[$difficulty]['average_score'] = 
            ($difficultyStats[$difficulty]['average_score'] + $quizResult['percentage']) / 2;
        $this->difficulty_stats = $difficultyStats;

        $this->save();
    }
}
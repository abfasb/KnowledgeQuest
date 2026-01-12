<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'points',
        'correct_answer',
        'explanation',
        'order',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class)->orderBy('order');
    }

    public function correctOptions(): HasMany
    {
        return $this->hasMany(Option::class)->where('is_correct', true);
    }

    public function getCorrectAnswerArray(): array
    {
        if (in_array($this->question_type, ['mcq', 'true_false'])) {
            return [$this->correct_answer];
        } elseif ($this->question_type === 'multiple_response') {
            return explode(',', $this->correct_answer);
        } elseif ($this->question_type === 'identification') {
            return array_map('trim', explode(',', $this->correct_answer));
        }
        
        return [];
    }

    public function isAnswerCorrect($userAnswer): bool
    {
        switch ($this->question_type) {
            case 'mcq':
            case 'true_false':
                return trim($userAnswer) === trim($this->correct_answer);
                
            case 'multiple_response':
                $correctAnswers = $this->getCorrectAnswerArray();
                $userAnswers = is_array($userAnswer) ? $userAnswer : [$userAnswer];
                sort($correctAnswers);
                sort($userAnswers);
                return $correctAnswers == $userAnswers;
                
            case 'identification':
                $correctAnswers = array_map('strtolower', $this->getCorrectAnswerArray());
                return in_array(strtolower(trim($userAnswer)), $correctAnswers);
                
            case 'fill_in_the_blanks':
                // For fill in blanks, we might accept multiple variations
                $correctAnswers = array_map('strtolower', $this->getCorrectAnswerArray());
                return in_array(strtolower(trim($userAnswer)), $correctAnswers);
                
            default:
                return false;
        }
    }
}
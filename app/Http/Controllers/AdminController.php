<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $teacherId = Auth::id();
        
        $stats = [
            'total_classes' => ClassModel::where('teacher_id', $teacherId)->count(),
            'total_quizzes' => Quiz::whereIn('class_id', function($query) use ($teacherId) {
                $query->select('id')
                    ->from('classes')
                    ->where('teacher_id', $teacherId);
            })->count(),
            'active_quizzes' => Quiz::whereIn('class_id', function($query) use ($teacherId) {
                $query->select('id')
                    ->from('classes')
                    ->where('teacher_id', $teacherId);
            })->where('is_published', true)->count(),
            'total_students' => DB::table('class_user')
                ->whereIn('class_id', function($query) use ($teacherId) {
                    $query->select('id')
                        ->from('classes')
                        ->where('teacher_id', $teacherId);
                })->where('status', 'active')
                ->count(),
        ];

        $recentClasses = ClassModel::where('teacher_id', $teacherId)
            ->withCount(['activeStudents', 'quizzes'])
            ->latest()
            ->take(5)
            ->get();

        $recentQuizzes = Quiz::whereIn('class_id', function($query) use ($teacherId) {
                $query->select('id')
                    ->from('classes')
                    ->where('teacher_id', $teacherId);
            })
            ->with(['class', 'attempts'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.admin', compact('stats', 'recentClasses', 'recentQuizzes'));
    }

    public function getClasses()
    {
        $classes = ClassModel::where('teacher_id', Auth::id())
            ->withCount(['activeStudents', 'quizzes', 'pendingStudents'])
            ->get();
        
        return response()->json($classes);
    }

    public function createClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $class = ClassModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'teacher_id' => Auth::id(),
            'class_code' => (new ClassModel)->generateClassCode(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Class created successfully!',
            'class' => $class
        ]);
    }

    public function updateClass(Request $request, $id)
    {
        $class = ClassModel::where('id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $class->update($request->only(['name', 'description', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Class updated successfully!',
            'class' => $class
        ]);
    }

    public function deleteClass($id)
    {
        $class = ClassModel::where('id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $class->delete();

        return response()->json([
            'success' => true,
            'message' => 'Class deleted successfully!'
        ]);
    }

    public function getClassStudents($classId)
    {
        $class = ClassModel::where('id', $classId)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $students = $class->students()
            ->withPivot('status', 'joined_at')
            ->get()
            ->map(function($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'status' => $student->pivot->status,
                    'joined_at' => $student->pivot->joined_at,
                ];
            });

        return response()->json($students);
    }

    public function updateStudentStatus(Request $request, $classId, $studentId)
    {
        $class = ClassModel::where('id', $classId)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,active,rejected',
        ]);

        $class->students()->updateExistingPivot($studentId, [
            'status' => $request->status,
            'joined_at' => $request->status === 'active' ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Student status updated successfully!'
        ]);
    }

    // Quiz Management
    public function getQuizzes($classId = null)
    {
        $query = Quiz::with(['class', 'questions', 'attempts'])
            ->whereIn('class_id', function($query) {
                $query->select('id')
                    ->from('classes')
                    ->where('teacher_id', Auth::id());
            });

        if ($classId) {
            $query->where('class_id', $classId);
        }

        $quizzes = $query->get();

        return response()->json($quizzes);
    }

    public function createQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id' => 'required|exists:classes,id',
            'difficulty' => 'required|in:easy,medium,hard',
            'time_limit' => 'nullable|integer|min:1',
            'total_points' => 'required|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attempts_allowed' => 'required|integer|min:1',
            'shuffle_questions' => 'boolean',
            'shuffle_options' => 'boolean',
            'show_result_immediately' => 'boolean',
        ]);

        // Verify teacher owns the class
        $class = ClassModel::where('id', $request->class_id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'class_id' => $request->class_id,
            'difficulty' => $request->difficulty,
            'time_limit' => $request->time_limit,
            'total_points' => $request->total_points,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'attempts_allowed' => $request->attempts_allowed,
            'shuffle_questions' => $request->boolean('shuffle_questions'),
            'shuffle_options' => $request->boolean('shuffle_options'),
            'show_result_immediately' => $request->boolean('show_result_immediately'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz created successfully!',
            'quiz' => $quiz
        ]);
    }

    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'required|in:easy,medium,hard',
            'time_limit' => 'nullable|integer|min:1',
            'total_points' => 'required|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attempts_allowed' => 'required|integer|min:1',
            'shuffle_questions' => 'boolean',
            'shuffle_options' => 'boolean',
            'show_result_immediately' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $quiz->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Quiz updated successfully!',
            'quiz' => $quiz
        ]);
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::where('id', $id)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $quiz->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quiz deleted successfully!'
        ]);
    }

    public function publishQuiz($id)
    {
        $quiz = Quiz::where('id', $id)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $quiz->update(['is_published' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz published successfully!'
        ]);
    }

    public function unpublishQuiz($id)
    {
        $quiz = Quiz::where('id', $id)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $quiz->update(['is_published' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz unpublished successfully!'
        ]);
    }

    // Question Management
    public function getQuestions($quizId)
    {
        $quiz = Quiz::where('id', $quizId)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $questions = $quiz->questions()
            ->with(['options', 'correctOptions'])
            ->orderBy('order')
            ->get();

        return response()->json($questions);
    }

    public function createQuestion(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'question_type' => 'required|in:mcq,identification,fill_in_the_blanks,true_false,multiple_response,essay,matching,ordering',
            'points' => 'required|integer|min:1',
            'correct_answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'order' => 'integer',
            'options' => 'array',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'boolean',
            'options.*.order' => 'integer',
            'options.*.match_key' => 'nullable|string',
        ]);

        // Verify teacher owns the quiz
        $quiz = Quiz::where('id', $request->quiz_id)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        DB::beginTransaction();
        try {
            $question = Question::create([
                'quiz_id' => $request->quiz_id,
                'question_text' => $request->question_text,
                'question_type' => $request->question_type,
                'points' => $request->points,
                'correct_answer' => $request->correct_answer,
                'explanation' => $request->explanation,
                'order' => $request->order ?? 0,
            ]);

            // Create options if provided
            if ($request->has('options') && is_array($request->options)) {
                foreach ($request->options as $optionData) {
                    Option::create([
                        'question_id' => $question->id,
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $optionData['is_correct'] ?? false,
                        'order' => $optionData['order'] ?? 0,
                        'match_key' => $optionData['match_key'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Question created successfully!',
                'question' => $question->load('options')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create question: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = Question::where('id', $id)
            ->whereHas('quiz.class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:mcq,identification,fill_in_the_blanks,true_false,multiple_response,essay,matching,ordering',
            'points' => 'required|integer|min:1',
            'correct_answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'order' => 'integer',
            'options' => 'array',
            'options.*.id' => 'nullable|exists:options,id',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'boolean',
            'options.*.order' => 'integer',
            'options.*.match_key' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $question->update([
                'question_text' => $request->question_text,
                'question_type' => $request->question_type,
                'points' => $request->points,
                'correct_answer' => $request->correct_answer,
                'explanation' => $request->explanation,
                'order' => $request->order ?? 0,
            ]);

            // Update or create options
            if ($request->has('options') && is_array($request->options)) {
                $existingOptionIds = $question->options->pluck('id')->toArray();
                $newOptionIds = [];
                
                foreach ($request->options as $optionData) {
                    if (isset($optionData['id']) && in_array($optionData['id'], $existingOptionIds)) {
                        // Update existing option
                        $option = Option::find($optionData['id']);
                        $option->update([
                            'option_text' => $optionData['option_text'],
                            'is_correct' => $optionData['is_correct'] ?? false,
                            'order' => $optionData['order'] ?? 0,
                            'match_key' => $optionData['match_key'] ?? null,
                        ]);
                        $newOptionIds[] = $optionData['id'];
                    } else {
                        // Create new option
                        $newOption = Option::create([
                            'question_id' => $question->id,
                            'option_text' => $optionData['option_text'],
                            'is_correct' => $optionData['is_correct'] ?? false,
                            'order' => $optionData['order'] ?? 0,
                            'match_key' => $optionData['match_key'] ?? null,
                        ]);
                        $newOptionIds[] = $newOption->id;
                    }
                }

                // Delete options that were removed
                $optionsToDelete = array_diff($existingOptionIds, $newOptionIds);
                if (!empty($optionsToDelete)) {
                    Option::whereIn('id', $optionsToDelete)->delete();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Question updated successfully!',
                'question' => $question->load('options')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update question: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteQuestion($id)
    {
        $question = Question::where('id', $id)
            ->whereHas('quiz.class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Question deleted successfully!'
        ]);
    }

    public function updateQuestionOrder(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.order' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->questions as $item) {
                Question::where('id', $item['id'])
                    ->whereHas('quiz.class', function($query) {
                        $query->where('teacher_id', Auth::id());
                    })
                    ->update(['order' => $item['order']]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Question order updated successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update question order: ' . $e->getMessage()
            ], 500);
        }
    }

    // Quiz Attempts & Results
    public function getQuizAttempts($quizId)
    {
        $quiz = Quiz::where('id', $quizId)
            ->whereHas('class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $attempts = QuizAttempt::where('quiz_id', $quizId)
            ->with(['user', 'answers.question'])
            ->latest()
            ->get();

        return response()->json($attempts);
    }

    public function getQuizAttemptDetails($attemptId)
    {
        $attempt = QuizAttempt::where('id', $attemptId)
            ->whereHas('quiz.class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->with(['user', 'quiz', 'answers.question.options'])
            ->firstOrFail();

        return response()->json($attempt);
    }

    public function updateAttemptAnswer(Request $request, $answerId)
    {
        $answer = QuizAttemptAnswer::where('id', $answerId)
            ->whereHas('attempt.quiz.class', function($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->firstOrFail();

        $request->validate([
            'points_earned' => 'required|integer|min:0',
            'manual_score' => 'nullable|integer|min:0',
            'teacher_feedback' => 'nullable|string',
        ]);

        $answer->update([
            'points_earned' => $request->points_earned,
            'manual_score' => $request->manual_score,
            'teacher_feedback' => $request->teacher_feedback,
        ]);

        // Recalculate total score
        $attempt = $answer->attempt;
        $scoreData = $attempt->calculateScore();
        
        $attempt->update([
            'total_score' => $scoreData['score'],
            'total_points_earned' => $scoreData['points_earned'],
            'correct_answers' => $scoreData['correct'],
            'incorrect_answers' => $scoreData['incorrect'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Answer updated successfully!',
            'attempt' => $attempt->fresh()
        ]);
    }

    // Student Quiz Taking (Admin side)
    public function getStudentQuizzes()
    {
        // Get classes where student is enrolled
        $studentClasses = DB::table('class_user')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->pluck('class_id');

        $quizzes = Quiz::whereIn('class_id', $studentClasses)
            ->where('is_published', true)
            ->with(['class', 'attempts' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get()
            ->map(function($quiz) {
                $quiz->remaining_attempts = $quiz->getRemainingAttempts(Auth::id());
                $quiz->is_active = $quiz->isActive();
                return $quiz;
            });

        return response()->json($quizzes);
    }

    public function startQuizAttempt(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Check if student is enrolled in the class
        $isEnrolled = DB::table('class_user')
            ->where('class_id', $quiz->class_id)
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return response()->json([
                'success' => false,
                'message' => 'You are not enrolled in this class!'
            ], 403);
        }

        // Check if quiz is active
        if (!$quiz->isActive()) {
            return response()->json([
                'success' => false,
                'message' => 'This quiz is not currently available!'
            ], 403);
        }

        // Check remaining attempts
        $remainingAttempts = $quiz->getRemainingAttempts(Auth::id());
        if ($remainingAttempts <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No attempts remaining for this quiz!'
            ], 403);
        }

        // Get attempt number
        $attemptNumber = $quiz->userAttempts(Auth::id())->count() + 1;

        DB::beginTransaction();
        try {
            $attempt = QuizAttempt::create([
                'quiz_id' => $quizId,
                'user_id' => Auth::id(),
                'attempt_number' => $attemptNumber,
                'started_at' => now(),
                'status' => 'in_progress',
            ]);

            // Get questions for the quiz
            $questions = $quiz->questions()
                ->with(['options' => function($query) use ($quiz) {
                    if ($quiz->shuffle_options) {
                        $query->inRandomOrder();
                    } else {
                        $query->orderBy('order');
                    }
                }])
                ->when($quiz->shuffle_questions, function($query) {
                    $query->inRandomOrder();
                }, function($query) {
                    $query->orderBy('order');
                })
                ->get();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quiz attempt started!',
                'attempt' => $attempt,
                'questions' => $questions,
                'quiz' => $quiz
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to start quiz: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submitQuizAnswer(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::where('id', $attemptId)
            ->where('user_id', Auth::id())
            ->where('status', 'in_progress')
            ->firstOrFail();

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'nullable|string',
            'selected_options' => 'nullable|array',
            'selected_options.*' => 'integer',
        ]);

        $question = Question::findOrFail($request->question_id);

        // Check if answer already exists
        $existingAnswer = QuizAttemptAnswer::where('quiz_attempt_id', $attemptId)
            ->where('question_id', $request->question_id)
            ->first();

        if ($existingAnswer) {
            return response()->json([
                'success' => false,
                'message' => 'Answer already submitted for this question!'
            ], 400);
        }

        DB::beginTransaction();
        try {
            $isCorrect = false;
            $pointsEarned = 0;

            // Auto-grade based on question type
            switch ($question->question_type) {
                case 'mcq':
                case 'true_false':
                    $userAnswer = $request->answer_text;
                    $isCorrect = $question->isAnswerCorrect($userAnswer);
                    $pointsEarned = $isCorrect ? $question->points : 0;
                    break;

                case 'multiple_response':
                    $userAnswers = $request->selected_options ?? [];
                    $correctOptions = $question->correctOptions->pluck('id')->toArray();
                    sort($userAnswers);
                    sort($correctOptions);
                    $isCorrect = ($userAnswers == $correctOptions);
                    $pointsEarned = $isCorrect ? $question->points : 0;
                    break;

                case 'identification':
                case 'fill_in_the_blanks':
                    $userAnswer = $request->answer_text;
                    $isCorrect = $question->isAnswerCorrect($userAnswer);
                    $pointsEarned = $isCorrect ? $question->points : 0;
                    break;

                case 'essay':
                case 'matching':
                case 'ordering':
                    // Manual grading required
                    $isCorrect = false;
                    $pointsEarned = 0;
                    break;
            }

            $answer = QuizAttemptAnswer::create([
                'quiz_attempt_id' => $attemptId,
                'question_id' => $request->question_id,
                'answer_text' => $request->answer_text,
                'selected_options' => $request->selected_options,
                'points_earned' => $pointsEarned,
                'is_correct' => $isCorrect,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Answer submitted successfully!',
                'answer' => $answer,
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit answer: ' . $e->getMessage()
            ], 500);
        }
    }

    public function completeQuizAttempt(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::where('id', $attemptId)
            ->where('user_id', Auth::id())
            ->where('status', 'in_progress')
            ->firstOrFail();

        $quiz = $attempt->quiz;

        DB::beginTransaction();
        try {
            // Calculate final score
            $scoreData = $attempt->calculateScore();
            
            $attempt->complete([
                'total_score' => $scoreData['score'],
                'total_points_earned' => $scoreData['points_earned'],
                'total_questions' => $attempt->answers()->count(),
                'correct_answers' => $scoreData['correct'],
                'incorrect_answers' => $scoreData['incorrect'],
            ]);

            DB::commit();

            $showResult = $quiz->show_result_immediately;

            return response()->json([
                'success' => true,
                'message' => 'Quiz completed successfully!',
                'attempt' => $attempt->fresh(),
                'score_data' => $scoreData,
                'show_result' => $showResult
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to complete quiz: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStudentAttempts()
    {
        $attempts = QuizAttempt::where('user_id', Auth::id())
            ->with(['quiz.class'])
            ->orderBy('completed_at', 'desc')
            ->get();

        return response()->json($attempts);
    }

    public function getStudentAttemptDetails($attemptId)
    {
        $attempt = QuizAttempt::where('id', $attemptId)
            ->where('user_id', Auth::id())
            ->with(['quiz', 'answers.question.options'])
            ->firstOrFail();

        return response()->json($attempt);
    }

    // Analytics
    public function getAnalytics()
    {
        $teacherId = Auth::id();

        // Class statistics
        $classStats = ClassModel::where('teacher_id', $teacherId)
            ->withCount(['activeStudents', 'quizzes'])
            ->get();

        // Quiz statistics
        $quizStats = Quiz::whereIn('class_id', function($query) use ($teacherId) {
                $query->select('id')
                    ->from('classes')
                    ->where('teacher_id', $teacherId);
            })
            ->withCount('attempts')
            ->with(['attempts' => function($query) {
                $query->select('quiz_id', DB::raw('AVG(total_score) as avg_score'))
                    ->where('status', 'completed')
                    ->groupBy('quiz_id');
            }])
            ->get();

        // Recent activity
        $recentActivity = QuizAttempt::whereHas('quiz.class', function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->with(['quiz', 'user'])
            ->orderBy('completed_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'class_stats' => $classStats,
            'quiz_stats' => $quizStats,
            'recent_activity' => $recentActivity
        ]);
    }
}
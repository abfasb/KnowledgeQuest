<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\QuizHistory;
use App\Models\UserStat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    private $categoryMap = [
        1 => 'Linux',
        2 => 'bash',
        3 => 'uncategorized',
        4 => 'Docker',
        5 => 'SQL',
        6 => 'CMS',
        7 => 'Code',
        8 => 'DevOps',
        9 => 'React',
        10 => 'Laravel',
        11 => 'Postgres',
        12 => 'Django',
        13 => 'cPanel',
        14 => 'NodeJs',
        15 => 'WordPress',
        16 => 'Next.js',
        17 => 'VueJS',
        18 => 'Apache Kafka',
        19 => 'HTML'
    ];

    public function quizzes(Request $request)
    {
        $params = [
            'limit' => $request->get('limit', 10),
        ];

        if ($request->category) {
            $id = (int) $request->category;
            if (isset($this->categoryMap[$id])) {
                $params['category'] = $this->categoryMap[$id];
            }
        }

        if ($request->difficulty && in_array($request->difficulty, ['Easy', 'Medium', 'Hard'])) {
            $params['difficulty'] = $request->difficulty;
        }

        try {
            $response = Http::withHeaders([
                'X-Api-Key' => 'k43Whm4AEPd7qFq2pRr1J8CRIOzSsBbaNzo23EkT'
            ])->get('https://quizapi.io/api/v1/questions', $params);

            $data = $response->json();

            if (!is_array($data)) {
                $data = [];
            }

            // Add category ID mapping
            foreach ($data as &$question) {
                if (isset($question['category'])) {
                    $question['category_id'] = array_search($question['category'], $this->categoryMap) ?: 3;
                }
            }

            return response()->json($data);

        } catch (\Exception $e) {
            \Log::error('Quiz API Error: ' . $e->getMessage());
            return response()->json([], 200);
        }
    }

    public function categories()
    {
        $response = Http::withHeaders([
            'X-Api-Key' => 'k43Whm4AEPd7qFq2pRr1J8CRIOzSsBbaNzo23EkT'
        ])->get('https://quizapi.io/api/v1/categories');

        $categories = $response->json();
        
        // Add custom mapping
        foreach ($categories as &$category) {
            if (isset($this->categoryMap[$category['id']])) {
                $category['display_name'] = $this->categoryMap[$category['id']];
            } else {
                $category['display_name'] = $category['name'];
            }
        }

        return response()->json($categories);
    }

    public function submitQuiz(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
            'total_questions' => 'required|integer',
            'correct_answers' => 'required|integer',
            'incorrect_answers' => 'required|integer',
            'percentage' => 'required|numeric',
            'category' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'time_taken' => 'required|integer',
            'details' => 'nullable|array'
        ]);

        $user = Auth::user();

        $pointsEarned = $request->correct_answers * 10;
        if ($request->percentage >= 90) {
            $pointsEarned += 50;
        } elseif ($request->percentage >= 75) {
            $pointsEarned += 25;
        } elseif ($request->percentage >= 60) {
            $pointsEarned += 10;
        }

        $quizHistory = QuizHistory::create([
            'user_id' => $user->id,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'score' => $request->score,
            'total_questions' => $request->total_questions,
            'correct_answers' => $request->correct_answers,
            'incorrect_answers' => $request->incorrect_answers,
            'percentage' => $request->percentage,
            'points_earned' => $pointsEarned,
            'time_taken' => $request->time_taken,
            'details' => $request->details
        ]);

        // Update user stats
        $userStat = UserStat::firstOrCreate(
            ['user_id' => $user->id],
            [
                'total_points' => 0,
                'total_quizzes' => 0,
                'total_questions_attempted' => 0,
                'total_correct_answers' => 0,
                'total_incorrect_answers' => 0,
                'accuracy' => 0,
                'current_streak' => 0,
                'max_streak' => 0,
                'last_quiz_date' => null
            ]
        );

        $userStat->updateStats([
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'points_earned' => $pointsEarned,
            'total_questions' => $request->total_questions,
            'correct_answers' => $request->correct_answers,
            'incorrect_answers' => $request->incorrect_answers,
            'percentage' => $request->percentage
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz results saved successfully',
            'quiz_history' => $quizHistory,
            'total_points' => $userStat->total_points,
            'points_earned' => $pointsEarned
        ]);
    }

    public function getHistory(Request $request)
    {
        $user = Auth::user();
        
        $query = QuizHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = $request->get('per_page', 10);
        $history = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'history' => $history,
            'stats' => [
                'total_attempts' => QuizHistory::where('user_id', $user->id)->count(),
                'average_score' => round(QuizHistory::where('user_id', $user->id)->avg('percentage') ?? 0, 2),
                'total_points' => QuizHistory::where('user_id', $user->id)->sum('points_earned'),
                'best_score' => QuizHistory::where('user_id', $user->id)->max('percentage') ?? 0
            ]
        ]);
    }

    public function getDashboardStats()
    {
        $user = Auth::user();
        $userStat = UserStat::where('user_id', $user->id)->first();
        
        if (!$userStat) {
            $userStat = UserStat::create([
                'user_id' => $user->id,
                'total_points' => 0,
                'total_quizzes' => 0,
                'total_questions_attempted' => 0,
                'total_correct_answers' => 0,
                'total_incorrect_answers' => 0,
                'accuracy' => 0,
                'current_streak' => 0,
                'max_streak' => 0,
                'last_quiz_date' => null
            ]);
        }

        // Get recent history for activity chart
        $recentHistory = QuizHistory::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, AVG(percentage) as avg_score')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get category performance
        $categoryPerformance = QuizHistory::where('user_id', $user->id)
            ->whereNotNull('category')
            ->selectRaw('category, COUNT(*) as total_quizzes, AVG(percentage) as avg_score, SUM(points_earned) as total_points')
            ->groupBy('category')
            ->orderByDesc('avg_score')
            ->take(5)
            ->get();

        // Get leaderboard position (simplified - you might want to implement a proper ranking system)
        $leaderboardPosition = UserStat::where('total_points', '>', $userStat->total_points)->count() + 1;
        $totalUsers = UserStat::count();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_points' => $userStat->total_points,
                'total_quizzes' => $userStat->total_quizzes,
                'total_questions_attempted' => $userStat->total_questions_attempted,
                'accuracy' => $userStat->accuracy,
                'current_streak' => $userStat->current_streak,
                'max_streak' => $userStat->max_streak,
                'leaderboard_position' => $leaderboardPosition,
                'total_users' => $totalUsers,
                'rank_percentage' => $totalUsers > 0 ? round(($leaderboardPosition / $totalUsers) * 100, 2) : 100
            ],
            'recent_activity' => $recentHistory,
            'category_performance' => $categoryPerformance,
            'weekly_quizzes' => QuizHistory::where('user_id', $user->id)
                ->where('created_at', '>=', now()->startOfWeek())
                ->count(),
            'today_quizzes' => QuizHistory::where('user_id', $user->id)
                ->whereDate('created_at', today())
                ->count()
        ]);
    }

    public function getCategoryStats()
    {
        $user = Auth::user();
        $userStat = UserStat::where('user_id', $user->id)->first();
        
        $categoryStats = $userStat->category_stats ?? [];
        $formattedStats = [];
        
        foreach ($categoryStats as $category => $stats) {
            $accuracy = $stats['total'] > 0 ? round(($stats['correct'] / $stats['total']) * 100, 2) : 0;
            $formattedStats[] = [
                'category' => $category,
                'quizzes' => $stats['quizzes'],
                'accuracy' => $accuracy,
                'correct_answers' => $stats['correct'],
                'total_questions' => $stats['total']
            ];
        }
        
        return response()->json([
            'success' => true,
            'categories' => $formattedStats
        ]);
    }
}
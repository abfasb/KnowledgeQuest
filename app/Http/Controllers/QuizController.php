<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    

public function quizzes(Request $request) 
    {
        $categoryMap = [
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

        $params = [
            'limit' => $request->get('limit', 10),
        ];

        if ($request->category) {
            $id = (int) $request->category;
            if (isset($categoryMap[$id])) {
                $params['category'] = $categoryMap[$id];
            }
        }

        if ($request->difficulty && in_array($request->difficulty, ['Easy','Medium','Hard'])) {
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

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }



    public function categories()
    {
        $response = Http::withHeaders([
            'X-Api-Key' => 'k43Whm4AEPd7qFq2pRr1J8CRIOzSsBbaNzo23EkT'
        ])->get('https://quizapi.io/api/v1/categories');

        return response()->json($response->json());
    }

}

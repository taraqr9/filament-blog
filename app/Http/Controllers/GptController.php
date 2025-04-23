<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Throwable;

class GptController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('services.anthropic.key'),
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model' => 'claude-3-5-sonnet-20241022', // or claude-3-sonnet...
                'max_tokens' => 5000,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $request->input('prompt', $request->post('content')),
                    ]
                ]
            ]);

            return response()->json($response->json());
        } catch (Throwable $e) {
            return "Error: ".$e->getMessage();
        }
    }

    public function index(): View
    {
        return view('gpt.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HelpdeskController extends Controller
{
    public function ask(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
        ]);

        $question = mb_strtolower(trim($validated['question']));
        $today = now()->toDateString();

        // 1. Today's check-in count - database answer
        if (
            str_contains($question, 'present today') ||
            str_contains($question, 'checked in today') ||
            str_contains($question, 'check in today') ||
            str_contains($question, 'attendance today')
        ) {
            $count = Attendance::whereDate('date', $today)
                ->whereNotNull('check_in')
                ->count();

            $answer = "There are {$count} attendance records with a check-in today.";
        }

        // 2. Today's check-out count - database answer
        elseif (
            str_contains($question, 'checked out today') ||
            str_contains($question, 'check out today')
        ) {
            $count = Attendance::whereDate('date', $today)
                ->whereNotNull('check_out')
                ->count();

            $answer = "{$count} attendance records have a check-out recorded today.";
        }

        // 3. Total employee count - database answer
        elseif (
            str_contains($question, 'how many employees') ||
            str_contains($question, 'employee count') ||
            str_contains($question, 'employees are registered') ||
            str_contains($question, 'total employees')
        ) {
            $count = Employee::count();

            $answer = "There are currently {$count} employees registered in IntelliDesk.";
        }

        // 4. Active employee count - database answer
        elseif (
            str_contains($question, 'active employees') ||
            str_contains($question, 'employees are active')
        ) {
            $count = Employee::where('status', 'Active')->count();

            $answer = "There are currently {$count} active employees in IntelliDesk.";
        }

        // 5. Excel reports
        elseif (
            str_contains($question, 'excel') ||
            str_contains($question, 'export') ||
            str_contains($question, 'report')
        ) {
            $answer = 'Open Attendance Reports, select your date range, and click the Excel export button to download the report.';
        }

        // 6. Add employee instructions
        elseif (
            str_contains($question, 'add employee') ||
            str_contains($question, 'new employee')
        ) {
            $answer = 'Open Employee Management, choose Add Employee, complete the required details, and save the form.';
        }

        // 7. Dashboard instructions
        elseif (str_contains($question, 'dashboard')) {
            $answer = 'The Dashboard provides an overview of employee and attendance information. Use the navigation menu to explore the system.';
        }

        // 8. Greetings
        elseif (preg_match('/\b(hello|hi|hey)\b/i', $question)) {
            $answer = 'Hello! I am your IntelliDesk AI Helpdesk Assistant. Ask me about employees, attendance, or reports.';
        }

        // 9. Use local Ollama AI for other questions
        else {
            try {
                $response = Http::timeout(120)->post(
                    'http://127.0.0.1:11434/api/chat',
                    [
                        'model' => 'llama3.2:3b',
                        'stream' => false,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => 'You are the IntelliDesk office helpdesk assistant. Answer in simple, clear English. Help users understand employee management, attendance check-in and check-out, dashboard navigation, and attendance reports. Give short step-by-step instructions when useful. Do not claim to access database information unless it is provided to you. Do not claim to perform actions for the user. If you are unsure about an IntelliDesk feature, say so instead of inventing details.'
                            ],
                            [
                                'role' => 'user',
                                'content' => $validated['question']
                            ],
                        ],
                    ]
                );

                if ($response->successful()) {
                    $answer = $response->json('message.content')
                        ?? 'Sorry, I could not generate an answer. Please try again.';
                } else {
                    $answer = 'The local AI service returned an error. Please try again.';
                }
            } catch (\Throwable $e) {
                report($e);

                $answer = 'I cannot connect to the local AI model. Please make sure Ollama is running and try again.';
            }
        }

        return response()->json([
            'answer' => $answer,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Message;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Monthly stats for mini widgets
        $skillsThisMonth = Skill::whereMonth('created_at', now()->month)->count();
        $projectsThisMonth = Project::whereMonth('created_at', now()->month)->count();
        $messagesThisMonth = Message::whereMonth('created_at', now()->month)->count();

        // Projects chart
        $projectMonths = Project::selectRaw("DATE_FORMAT(created_at, '%b') as month")
            ->orderBy('created_at')->pluck('month');

        $projectCounts = Project::selectRaw("COUNT(*) as count")
            ->groupByRaw("DATE_FORMAT(created_at, '%b')")->pluck('count');

        // Messages chart
        $messageMonths = Message::selectRaw("DATE_FORMAT(created_at, '%b') as month")
            ->orderBy('created_at')->pluck('month');

        $messageCounts = Message::selectRaw("COUNT(*) as count")
            ->groupByRaw("DATE_FORMAT(created_at, '%b')")->pluck('count');

        return view('admin.dashboard', [
            'skills' => Skill::count(),
            'projects' => Project::count(),
            'messages' => Message::count(),
            'unread' => Message::where('is_read', false)->count(),

            // Mini KPIs
            'skillsThisMonth' => $skillsThisMonth,
            'projectsThisMonth' => $projectsThisMonth,
            'messagesThisMonth' => $messagesThisMonth,

            // Chart data
            'projectMonths' => $projectMonths,
            'projectCounts' => $projectCounts,
            'messageMonths' => $messageMonths,
            'messageCounts' => $messageCounts,
        ]);
    }

    // ✅ REQUIRED FOR DASHBOARD v6 (LIVE UPDATE)
    public function stats()
{
    // Projects chart
    $projectMonths = \App\Models\Project::selectRaw("DATE_FORMAT(created_at, '%b') as month")
        ->groupByRaw("DATE_FORMAT(created_at, '%b')")
        ->orderByRaw("MIN(created_at)")
        ->pluck('month');

    $projectCounts = \App\Models\Project::selectRaw("COUNT(*) as count")
        ->groupByRaw("DATE_FORMAT(created_at, '%b')")
        ->pluck('count');

    // Messages chart
    $messageMonths = \App\Models\Message::selectRaw("DATE_FORMAT(created_at, '%b') as month")
        ->groupByRaw("DATE_FORMAT(created_at, '%b')")
        ->orderByRaw("MIN(created_at)")
        ->pluck('month');

    $messageCounts = \App\Models\Message::selectRaw("COUNT(*) as count")
        ->groupByRaw("DATE_FORMAT(created_at, '%b')")
        ->pluck('count');

    return response()->json([
        // KPIs
        'skills'   => \App\Models\Skill::count(),
        'projects' => \App\Models\Project::count(),
        'messages' => \App\Models\Message::count(),
        'unread'   => \App\Models\Message::where('is_read', false)->count(),

        // Charts
        'projectMonths'  => $projectMonths,
        'projectCounts'  => $projectCounts,
        'messageMonths'  => $messageMonths,
        'messageCounts'  => $messageCounts,
    ]);
}

}

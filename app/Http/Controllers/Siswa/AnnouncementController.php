<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::query()
            ->with('creator')
            ->latest()
            ->paginate(10);

        return view('siswa.pengumuman.index', compact('announcements'));
    }

    public function show(Announcement $announcement): View
    {
        return view('siswa.pengumuman.show', compact('announcement'));
    }
}

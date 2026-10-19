<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LkpdSubmission;
use Illuminate\Http\Request;

class LkpdManagementController extends Controller
{
    public function index()
    {
        $submissions = LkpdSubmission::with(['user.student'])->latest()->get();

        return view('admin.lkpd.index', compact('submissions'));
    }

    public function show(int $id)
    {
        $submission = LkpdSubmission::with(['user.student'])->findOrFail($id);

        return view('admin.lkpd.show', compact('submission'));
    }

    public function grade(Request $request, int $id)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'teacher_feedback' => 'nullable|string',
        ]);

        $submission = LkpdSubmission::findOrFail($id);
        $submission->update([
            'score' => $request->score,
            'teacher_feedback' => $request->teacher_feedback,
            'status' => 'reviewed',
        ]);

        return redirect()->route('admin.lkpd.index')->with('success', 'Nilai dan umpan balik LKPD berhasil disimpan.');
    }
}

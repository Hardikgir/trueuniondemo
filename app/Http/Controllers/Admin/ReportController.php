<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index(Request $request)
    {
        $query = Report::with(['reporter', 'reportedUser'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by reason
        if ($request->has('reason') && $request->reason !== '') {
            $query->where('reason', $request->reason);
        }

        $reports = $query->paginate(20);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $report->load(['reporter', 'reportedUser']);
        return view('admin.reports.show', compact('report'));
    }

    /**
     * Update the status of a report.
     */
    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,dismissed',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report status updated successfully.');
    }

    /**
     * Update multiple reports status.
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'report_ids' => 'required|array',
            'report_ids.*' => 'exists:reports,id',
            'status' => 'required|in:pending,reviewed,resolved,dismissed',
        ]);

        Report::whereIn('id', $request->report_ids)
            ->update(['status' => $request->status]);

        return redirect()->route('admin.reports.index')
            ->with('success', count($request->report_ids) . ' report(s) status updated successfully.');
    }
}

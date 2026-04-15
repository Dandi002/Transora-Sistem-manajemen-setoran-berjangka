<?php

namespace App\Http\Controllers;

use App\Models\SetoranHistory;
use Illuminate\Http\Request;

class SetoranHistoryController extends Controller
{
    public function ownerIndex(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');
        $method = (string) $request->query('method', '');

        $histories = SetoranHistory::query()
            ->with(['user:id,name', 'staff:id,name'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('staff', function ($staffQuery) use ($search) {
                        $staffQuery->where('name', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->whereDate('recorded_at', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->whereDate('recorded_at', '<=', $dateTo);
            })
            ->when(in_array($method, ['transfer', 'manual_check', 'manual_uncheck'], true), function ($query) use ($method) {
                if ($method === 'transfer') {
                    $query->where('action_type', 'transfer_paid');
                    return;
                }

                $query->where('action_type', $method);
            })
            ->orderByDesc('recorded_at')
            ->get();

        return view('owner.page.histories.index', compact('histories', 'search', 'dateFrom', 'dateTo', 'method'));
    }

    public function index(Request $request)
    {
        $staff = auth()->user();
        $search = trim((string) $request->query('search', ''));
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');
        $method = (string) $request->query('method', '');

        $histories = SetoranHistory::query()
            ->with(['user:id,name', 'staff:id,name'])
            ->where(function ($query) use ($staff) {
                $query->where('staff_id', $staff->id)
                    ->orWhereHas('user', function ($userQuery) use ($staff) {
                        $userQuery->where('assigned_staff_id', $staff->id);
                    });
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->whereDate('recorded_at', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->whereDate('recorded_at', '<=', $dateTo);
            })
            ->when(in_array($method, ['transfer', 'manual_check', 'manual_uncheck'], true), function ($query) use ($method) {
                if ($method === 'transfer') {
                    $query->where('action_type', 'transfer_paid');
                    return;
                }

                $query->where('action_type', $method);
            })
            ->orderByDesc('recorded_at')
            ->get();

        return view('staff.histories.index', compact('histories', 'search', 'dateFrom', 'dateTo', 'method'));
    }
}

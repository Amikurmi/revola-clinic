<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    /**
     * 📨 Handle user enquiry submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'mobile' => 'required|string|max:10',
            'message' => 'required|string|max:1024',
        ]);

        Enquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Enquiry submitted successfully!',
        ]);
    }

    /**
     * 👨‍💼 Admin view - show filtered + paginated enquiries
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Enquiry::query();

        if ($filter === 'contacted') {
            $query->where('contacted', true);
        } elseif ($filter === 'pending') {
            $query->where('contacted', false);
        }

        // Latest entries + keep filter on pagination
        $enquiries = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['filter' => $filter]);

        return view('admin.enquiries.index', compact('enquiries', 'filter'));
    }


    /**
     * ✅ Update "contacted" status via AJAX (checkbox toggle)
     */
    public function updateContacted(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'contacted' => 'required|boolean',
        ]);

        $enquiry->update(['contacted' => $request->contacted]);

        return response()->json(['success' => true]);
    }
}

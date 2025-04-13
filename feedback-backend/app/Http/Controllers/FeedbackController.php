<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query()->latest();
        
        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }
        
        $feedbacks = $query->take(10)->get();
        
        return response()->json($feedbacks);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'app_happiness' => 'required|integer|min:1|max:5',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $feedback = Feedback::create($request->all());
        
        return response()->json($feedback, 201);
    }
}
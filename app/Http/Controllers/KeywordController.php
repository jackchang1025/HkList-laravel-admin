<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index(Request $request)
    {
        $keywords = Keyword::paginate($request["size"]);
        return ResponseController::success($keywords);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255',
            'match_type' => 'required|string|in:contains,equals,not_equals',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $keyword = Keyword::create($validated);
        return response()->json($keyword, 201);
    }

    public function update(Request $request, Keyword $keyword)
    {
        $validated = $request->validate([
            'keyword' => 'string|max:255',
            'match_type' => 'string|in:contains,equals,not_equals',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $keyword->update($validated);
        return response()->json($keyword);
    }

    public function destroy(Request $request)
    {
        $ids = $request->input("ids");
        Keyword::whereIn("id", $ids)->delete();
        return ResponseController::success();
    }

    // 检查文件名是否匹配关键词
    public function checkMatch(Request $request)
    {
        $request->validate([
            'filename' => 'required|string'
        ]);

        $filename = $request->input('filename');
        $matches = Keyword::where('is_active', true)
            ->get()
            ->filter(function($keyword) use ($filename) {
                return $keyword->isMatch($filename);
            });

        return response()->json([
            'matches' => $matches
        ]);
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductQuestionController extends Controller
{
    public function index()
    {
        $questions = DB::table('product_questions')
            ->join(
                'products',
                'product_questions.product_id',
                '=',
                'products.id'
            )
            ->join(
                'users',
                'product_questions.customer_id',
                '=',
                'users.id'
            )
            ->select(
                'product_questions.*',
                'products.name as product_name',
                'users.name as customer_name'
            )
            ->orderByDesc('product_questions.id')
            ->paginate(10);

        return view('admin.questions.index', [
            'questions' => $questions,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $question = DB::table('product_questions')
            ->where('id', $id)
            ->first();

        abort_if($question === null, 404);

        $validated = $request->validate([
            'answer' => ['required', 'string', 'max:2000'],
        ]);

        DB::table('product_questions')
            ->where('id', $id)
            ->update([
                'answer' => $validated['answer'],
                'updated_at' => now(),
            ]);

        return back()->with(
            'success',
            'Answer saved successfully.'
        );
    }
}
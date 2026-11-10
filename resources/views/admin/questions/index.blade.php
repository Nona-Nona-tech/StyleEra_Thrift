<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer Questions - StyleEra Thrift</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f6f7f3;
            color: #24352b;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        a {
            color: #285943;
        }

        .question-card {
            margin: 20px 0;
            padding: 24px;
            background: white;
            border: 1px solid #dce3da;
            border-radius: 10px;
        }

        .question-text {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .meta {
            color: #596653;
            font-size: 14px;
        }

        label {
            display: block;
            margin: 16px 0 8px;
            font-weight: 700;
        }

        textarea {
            display: block;
            width: 100%;
            padding: 12px;
            border: 1px solid #9aa793;
            border-radius: 7px;
            font: inherit;
            resize: vertical;
        }

        button {
            margin-top: 12px;
            padding: 10px 16px;
            border: 0;
            border-radius: 7px;
            background: #285943;
            color: white;
            font: inherit;
            cursor: pointer;
        }

        .success {
            padding: 12px;
            background: #e4edde;
            border-radius: 7px;
        }

        .errors {
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 7px;
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            margin-top: 24px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>

    <h1>Customer Questions</h1>

    <p>Total questions: {{ $questions->total() }}</p>

    @if (session('success'))
        <p class="success" role="status">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div class="errors" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @forelse ($questions as $question)
        <article class="question-card">
            <h2>
                <a href="{{ route('product.show', [
                    'id' => $question->product_id
                ]) }}">
                    {{ $question->product_name }}
                </a>
            </h2>

            <p class="meta">
                Asked by {{ $question->customer_name }}
                · {{ $question->created_at }}
            </p>

            <p class="question-text">{{ $question->question }}</p>

            <p>
                Status:
                {{ $question->answer === null ? 'Unanswered' : 'Answered' }}
            </p>

            <form
                action="{{ route('admin.questions.update', [
                    'id' => $question->id
                ]) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <label for="answer-{{ $question->id }}">
                    Public shop reply
                </label>

                <textarea
                    id="answer-{{ $question->id }}"
                    name="answer"
                    rows="4"
                    maxlength="2000"
                    required
                >{{ $question->answer }}</textarea>

                <button type="submit">
                    {{ $question->answer === null ? 'Save Answer' : 'Update Answer' }}
                </button>
            </form>
        </article>
    @empty
        <p>No customer questions yet.</p>
    @endforelse

    @if ($questions->hasPages())
        <nav class="pagination" aria-label="Questions pagination">
            @if ($questions->previousPageUrl())
                <a href="{{ $questions->previousPageUrl() }}">
                    Previous
                </a>
            @endif

            <span>
                Page {{ $questions->currentPage() }}
                of {{ $questions->lastPage() }}
            </span>

            @if ($questions->nextPageUrl())
                <a href="{{ $questions->nextPageUrl() }}">
                    Next
                </a>
            @endif
        </nav>
    @endif
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil NLP (Laravel + Flask)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4">Analisis NLP dari Flask (Waitress)</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Teks Input:</h5>
            <p class="card-text">{{ $text }}</p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kata</th>
                <th>POS (Part of Speech)</th>
                <th>Dependency</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tokens as $token)
                <tr>
                    <td>{{ $token['text'] }}</td>
                    <td>{{ $token['pos'] }}</td>
                    <td>{{ $token['dep'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada hasil</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>

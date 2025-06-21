<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Animal - {{ $animal->name }}</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Animal: {{ $animal->name }}</h1>
        <a href="{{ route('animals.index') }}" class="btn btn-secondary">Back to All Animals</a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Animal Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $animal->id }}</p>
                    <p><strong>Name:</strong> {{ $animal->name }}</p>
                    <p><strong>Species:</strong> {{ $animal->species }}</p>
                    <p><strong>Age:</strong> {{ $animal->age }} years</p>
                    <p><strong>Description:</strong> {{ $animal->description }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Cage:</strong>
                        @if($animal->cage)
                            <a href="{{ route('zoo.show', $animal->cage->id) }}">
                                {{ $animal->cage->name }} ({{ $animal->cage->volume }} m³)
                            </a>
                        @else
                            <span class="text-muted">Not assigned to any cage</span>
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $animal->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $animal->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-warning me-2">Edit Animal</a>
{{--        <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display: inline;">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this animal?')">Delete Animal</button>--}}
{{--        </form>--}}
    </div>
</div>

</body>
</html>

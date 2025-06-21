<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cage - {{ $cage->name }}</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cage: {{ $cage->name }}</h1>
        <a href="{{ route('zoo.index') }}" class="btn btn-secondary">Back to All Cages</a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Cage Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $cage->id }}</p>
                    <p><strong>Name:</strong> {{ $cage->name }}</p>
                    <p><strong>Volume:</strong> {{ $cage->volume }} m³</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('zoo.edit', $cage->id) }}" class="btn btn-warning me-2">Edit Cage</a>
{{--                    <form action="{{ route('cages.destroy', $cage->id) }}" method="POST" style="display: inline;">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this cage? All animals in this cage will be removed.')">Delete Cage</button>--}}
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Animals in This Cage</h3>
            <a href="{{ route('animals.create', ['cage_id' => $cage->id]) }}" class="btn btn-primary btn-sm">Add Animal to This Cage</a>
        </div>
        <div class="card-body">
            @if($cage->animals->count() > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cage->animals as $animal)
                        <tr>
                            <td>{{ $animal->name }}</td>
                            <td>{{ $animal->species }}</td>
                            <td>{{ $animal->age }} years</td>
                            <td>
                                <a href="{{ route('animals.show', $animal->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    No animals currently in this cage.
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>

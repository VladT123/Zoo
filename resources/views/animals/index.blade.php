<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Management</title>
    <style>
        .description-cell {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Animal Management</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('animals.create') }}" class="btn btn-primary">Add New Animal</a>
        <a href="{{ route('zoo.index') }}" class="btn btn-secondary">View Cages</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>All Animals</h3>
        </div>
        <div class="card-body">
            @if($animals->count() > 0)
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Age</th>
                        <th>Description</th>
                        <th>Cage</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animals as $animal)
                        <tr>
                            <td>{{ $animal->id }}</td>
                            <td>{{ $animal->name }}</td>
                            <td>{{ $animal->species }}</td>
                            <td>{{ $animal->age }} years</td>
                            <td class="description-cell" title="{{ $animal->description }}">
                                {{ $animal->description }}
                            </td>
                            <td>
                                @if($animal->cage)
                                    <a href="{{ route('zoo.show', $animal->cage->id) }}">
                                        {{ $animal->cage->name }}
                                    </a>
                                @else
                                    <span class="text-muted">No cage assigned</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('animals.show', $animal->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-sm btn-warning">Edit</a>
{{--                                <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display: inline;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this animal?')">Delete</button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $animals->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No animals found. Please add an animal to get started.
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>

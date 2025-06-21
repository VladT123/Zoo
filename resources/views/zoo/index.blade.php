<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Cage Management</title>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Zoo Cage Management</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('zoo.create') }}" class="btn btn-primary">Add New Cage</a>
            <a href="{{ route('animals.index') }}" class="btn btn-secondary">View Animals</a>
        </div>

    <div class="card">
        <div class="card-header">
            <h3>All Cages</h3>
        </div>
        <div class="card-body">
            @if($cages->count() > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Volume</th>
                        <th>Animal Count</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cages as $cage)
                        <tr>
                            <td>{{ $cage->id }}</td>
                            <td>{{ $cage->name }}</td>
                            <td>{{ $cage->volume }}</td>
                            <td>{{ $cage->animals->count() }}</td>
                            <td>
                                <a href="{{ route('zoo.show', $cage->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('zoo.edit', $cage->id) }}" class="btn btn-sm btn-warning">Edit</a>
{{--                                <form action="{{ route('cages.destroy', $cage->id) }}" method="POST" style="display: inline;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $cages->links() }}
                </div>
            @else
                <p>No cages found. Please add a cage to get started.</p>
            @endif
        </div>
    </div>
</div>

</body>
</html>

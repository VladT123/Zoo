<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cage - {{ $cage->name }}</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Cage: {{ $cage->name }}</h1>
        <a href="{{ route('zoo.show', $cage->id) }}" class="btn btn-secondary">Back to Cage</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Cage Information</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('zoo.update', $cage->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Cage Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $cage->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="volume" class="form-label">Volume (m³)</label>
                    <input type="number" class="form-control @error('volume') is-invalid @enderror"
                           id="volume" name="volume" value="{{ old('volume', $cage->volume) }}" required>
                    @error('volume')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Cage</button>
                </div>
            </form>
            <form action="{{ route('zoo.destroy', $cage->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this cage? All animals in this cage will be removed.')">Delete Cage</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

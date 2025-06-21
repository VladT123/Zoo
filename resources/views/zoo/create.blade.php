<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Cage</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Cage</h1>
        <a href="{{ route('zoo.index') }}" class="btn btn-secondary">Back to All Cages</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Cage Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('zoo.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Cage Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="volume" class="form-label">Volume (m³)</label>
                    <input type="number" class="form-control @error('volume') is-invalid @enderror"
                           id="volume" name="volume" value="{{ old('volume') }}" required>
                    @error('volume')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Cage</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

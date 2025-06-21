<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal - {{ $animal->name }}</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Animal: {{ $animal->name }}</h1>
        <a href="{{ route('animals.show', $animal->id) }}" class="btn btn-secondary">Back to Animal</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Animal Information</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('animals.update', $animal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Animal Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $animal->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="species" class="form-label">Species</label>
                            <input type="text" class="form-control @error('species') is-invalid @enderror"
                                   id="species" name="species" value="{{ old('species', $animal->species) }}" required>
                            @error('species')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Age (years)</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror"
                                   id="age" name="age" value="{{ old('age', $animal->age) }}" required>
                            @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cage_id" class="form-label">Cage</label>
                            <select class="form-select @error('cage_id') is-invalid @enderror"
                                    id="cage_id" name="cage_id">
                                <option value="">-- Select Cage --</option>
                                @foreach($cages as $cage)
                                    <option value="{{ $cage->id }}"
                                        {{ old('cage_id', $animal->cage_id) == $cage->id ? 'selected' : '' }}>
                                        {{ $cage->name }} ({{ $cage->volume }} m³)
                                    </option>
                                @endforeach
                            </select>
                            @error('cage_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3">{{ old('description', $animal->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Animal</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Animal</title>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Animal</h1>
        <a href="{{ route('animals.index') }}" class="btn btn-secondary">Back to All Animals</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Animal Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Animal Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="species" class="form-label">Species</label>
                            <input type="text" class="form-control @error('species') is-invalid @enderror"
                                   id="species" name="species" value="{{ old('species') }}" required>
                            @error('species')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Age (years)</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror"
                                   id="age" name="age" value="{{ old('age') }}" required>
                            @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Animal Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="image-preview" src="#" alt="Image preview" style="display:none;">
                        </div>

                        <div class="mb-3">
                            <label for="cage_id" class="form-label">Cage</label>
                            <select class="form-control @error('cage_id') is-invalid @enderror"
                                    id="cage_id" name="cage_id">
                                <option value="">-- Select Cage --</option>
                                @foreach($cages as $cage)
                                    <option value="{{ $cage->id }}" @if((old('cage_id', $selectedCageId ?? null) == $cage->id)) selected @endif>
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
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Animal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('image-preview');
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>

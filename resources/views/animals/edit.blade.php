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
            <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="image" class="form-label">Animal Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($animal->image_path)
                                <div class="mt-2" style="position: relative; display: inline-block;">
                                    <strong>Current Image:</strong>
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $animal->image_path) }}" alt="Current animal image" style="max-width: 200px; display: block;">
                                        <button type="button" onclick="removeImage()" style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer;">×</button>
                                    </div>
                                    <input type="hidden" id="remove_image_flag" name="remove_image" value="0">
                                </div>
                            @endif
                            <img id="image-preview" src="#" alt="New image preview" style="display:none; max-width: 200px; margin-top: 10px;">
                        </div>

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
            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this animal?')">Delete Animal</button>
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

    function removeImage() {
        document.getElementById('remove_image_flag').value = '1';
        const imageContainer = document.querySelector('.mb-3 .mt-2');
        if (imageContainer) {
            imageContainer.style.display = 'none';
        }
    }
</script>

</body>
</html>


<!-- Parent Category Dropdown -->
<div class="form-group">
    <label class="floating-label" for="parent_id">Parent Category</label>
    <select class="form-control" id="parent_id" name="parent_id" placeholder="Select a parent category">
        <option value="">None</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}"  {{ old('parent_id', isset($category) ? $category->parent_id : '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->fullPath }}
            </option>
        @endforeach
    </select>
</div>

<!-- Category Name -->
<div class="form-group">
    <label class="floating-label" for="name">Category Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($category) ? $category->name : '') }}" placeholder="Enter category name" required>
</div>

<!-- Category Status -->
<div class="form-group">
    <label class="floating-label" for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="1" {{ old('status', isset($category) ? $category->status : '') == 1 ? 'selected' : '' }}>Enabled</option>
        <option value="2" {{ old('status', isset($category) ? $category->status : '') == 2 ? 'selected' : '' }}>Disabled</option>
    </select>
</div>

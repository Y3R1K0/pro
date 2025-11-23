<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" 
           value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Categoría</label>
    <input type="text" name="category" class="form-control" 
           value="{{ old('category', $product->category ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="number" name="price" class="form-control" step="0.01"
           value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Imagen principal</label>
    <input type="file" name="image" class="form-control">

    @if(isset($product))
        <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2 rounded shadow">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Imagen 2</label>
    <input type="file" name="image2" class="form-control">

    @if(isset($product) && $product->image2)
        <img src="{{ asset('storage/' . $product->image2) }}" width="100" class="mt-2 rounded shadow">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Imagen 3</label>
    <input type="file" name="image3" class="form-control">

    @if(isset($product) && $product->image3)
        <img src="{{ asset('storage/' . $product->image3) }}" width="100" class="mt-2 rounded shadow">
    @endif
</div>

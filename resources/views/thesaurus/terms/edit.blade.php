@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le terme</h1>
        <form action="{{ route('terms.update', $term->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $term->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $term->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="type_id">Category</label>
                <select name="type_id" class="form-control" required>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $term->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->code }} - {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="parent_id"> Parent </label>
                <select name="parent_id" class="form-control" required>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" {{ $term->parent_id == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $term->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="language_id">Langue</label>
                <select name="language_id" class="form-control" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $term->language_id == $language->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('terms.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection

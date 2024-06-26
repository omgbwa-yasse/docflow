@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter un terme</h1>
        <form action="{{ route('terms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="parent_id"> Parent</label>
                <select name="parent_id" class="form-control">
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->code }} - {{ $parent->name }}</option>
                    @endforeach
                    <option value=""> Créer une nouvelle branche </option>
                </select>
            </div>
            <div class="form-group">
                <label for="type_id"> Type </label>
                <select name="type_id" class="form-control" required>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->code }} - {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="language_id">Langue</label>
                <select name="language_id" class="form-control" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('terms.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection

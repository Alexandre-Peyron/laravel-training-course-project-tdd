@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Création Transaction
            </div>
            <div class="panel-body">
                <form action="/transactions" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="text" name="amount" class="form-control" value="{{ old('amount') }}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Catégorie</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-success" type="submit">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
@endsection
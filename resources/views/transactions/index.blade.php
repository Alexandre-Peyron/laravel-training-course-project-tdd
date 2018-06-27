@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                plop
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Description</td>
                        <td>Catégorie</td>
                        <td>Montant</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                <form action="/transactions/{{$transaction->id}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-xs" type="submit" >Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
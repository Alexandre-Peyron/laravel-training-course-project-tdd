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
                        <td>Montant</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
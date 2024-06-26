@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Communications</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Create New Communication</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Operator</th>
                    <th>Operator Organisation</th>
                    <th>User</th>
                    <th>User Organisation</th>
                    <th>Return Date</th>
                    <th>Return Effective</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($communications as $communication)
                    <tr>
                        <td>{{ $communication->id }}</td>
                        <td>{{ $communication->code }}</td>
                        <td>{{ $communication->operator->name }}</td>
                        <td>{{ $communication->operatorOrganisation->name }}</td>
                        <td>{{ $communication->user->name }}</td>
                        <td>{{ $communication->userOrganisation->name }}</td>
                        <td>{{ $communication->return_date }}</td>
                        <td>{{ $communication->return_effective }}</td>
                        <td>{{ $communication->status->name }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $communication->id) }}" class="btn btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

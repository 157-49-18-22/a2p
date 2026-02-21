@extends('adminlte::page')

@section('title', 'Wallet')

@section('content_header')
    <h1>Wallet</h1>
@stop

@section('content')
    <div class="card px-3 py-2">
        @can('payment_create')
        <div class="my-3">
            <a class="btn btn-success text-uppercase float-right" href="{{ route('wallet.create') }}">
                <i class="fas fa-plus fa-fw"></i>
                <span class="big-btn-text">Add Money</span>
            </a>
        </div>
        @endcan
        <input type="text" id="searchBox" placeholder="🔍 Search the table below">
        <br>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-uppercase" scope="col">#</th>
                        <th class="text-uppercase" scope="col">User</th>
                        <th class="text-uppercase" scope="col">Amount</th>
                        <th class="text-uppercase" scope="col">Added on </th>
                        <th class="text-uppercase" scope="col">Balance</th>
                        <!--th class="text-uppercase" scope="col">Action</th-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wallet as $due)
                    <tr>
                        <td>{{ $due['id'] }}</td>
                        <td>{{ $due['name'] }}</td>
                        <td>{{ App\Lancer\Utilities::CURRENCY_SYMBOL }} {{ $due['amount'] }}</td>
                        <td>{{ $due['created_at'] }}</td>
                        <td>{{ App\Lancer\Utilities::CURRENCY_SYMBOL }} {{ $due['balance'] }}</td>
                        <!--td>
                            
                        </td-->
                    </tr>
                   
                    @endforeach
                   

                </tbody>
            </table>
            @if (count($wallet) < 1)
                <div class="px-4 py-5 mx-auto text-secondary">
                    No results found!
                </div>
            @endif
        </div>

        {{-- Pagination links --}}
        <div class="mt-4">

        </div>

        <input type="hidden" id="closedRedirectUrl" value="{{ route('wallet.index') }}">
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/delete_entry.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/due_payment.js') }}"></script>
@stop

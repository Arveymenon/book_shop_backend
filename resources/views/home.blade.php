@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#inventory_modal">
                        Update Inventory
                      </button>
                    <table id="inventory" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Input Type</th>
                                <th>Book</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>

                    <!-- Modal -->
                    <div class="c-modal modal fade" id="inventory_modal" tabindex="-1" role="dialog" aria-labelledby="modal2">
                        <div class="c-modal__dialog modal-dialog" role="document">
                            <div class="c-modal__content">
                                <div class="c-modal__body">
                                    <form action='api/inventory/update' method='post'>
                                        {{ @csrf_field() }}

                                        <input class="c-input" id="retailers_book_id" type="hidden" name="retailers_book_id" value="0">

                                        <div class="c-field">
                                            <label class="c-choice__label" for="input_type">Input Type</label>
                                            <select class="c-select__input" id="input_type" name="input_type">
                                                <option value="1">Credit</option>
                                                <option value="0">Debit</option>
                                            </select>
                                        </div>

                                        <div class="c-field">
                                            <label class="c-choice__label" for="book_id">Select Book</label>
                                            <select class="c-select__input" id="book_id" name="book_id" type="text" placeholder="Select">
                                                @foreach($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->book->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="c-field">
                                            <label class="c-field__label" for="count">Count</label>
                                            <input class="c-input" id="count" name="count" type="text">
                                        </div>

                                        <button type="submit" class="c-btn c-btn--info c-btn--fullwidth">Update Inventory</button>
                                    </form>
                                </div>
                            </div><!-- // .c-modal__content -->
                        </div><!-- // .c-modal__dialog -->
                    </div><!-- // .c-modal -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        console.log(APP_URL+'/api/inventory/datatable');

        $(document).ready(function() {
            $('#inventory').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/inventory/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'input_type', name: 'input_type'},
                    { data: 'book', name: 'book' },
                    { data: 'count', name: 'count'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>
@endpush

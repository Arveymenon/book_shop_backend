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
                        Add New
                      </button>
                    <table id="inventory" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Book ID</th>
                                <th>User ID</th>
                                <th>Our Price</th>
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
                                    <div class="c-select u-mb-xsmall">
                                        <form action='api/retailers-book/update' method='post'>
                                            {{ @csrf_field() }}

                                            <input class="c-input" id="retailers_book_id" type="hidden" name="retailers_book_id" value="0">
                                            <div class="c-field">
                                                <label class="c-choice__label" for="book">Select Book</label>
                                                <select class="c-select__input" id="book" name="book" type="text" placeholder="Select">
                                                    @foreach($books as $book)
                                                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="c-field">
                                                <label class="c-field__label" for="mrp">Your MRP</label>
                                                <input class="c-input" id="mrp" name="mrp" type="text" placeholder="mrp_to_be_shown">
                                            </div>

                                            <button type="submit" class="c-btn c-btn--info c-btn--fullwidth">Add Book</button>
                                        </form>
                                      </div>
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
                ajax: APP_URL+'/api/retailers-books/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'book_id', name: 'book_id'},
                    { data: 'user_id', name: 'user_id' },
                    { data: 'retailers_price', name: 'retailers_price'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>
@endpush

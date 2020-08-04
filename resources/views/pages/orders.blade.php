@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
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
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Address</th>
                                <th>Flat</th>
                                <th>Landmark</th>
                                <th>Details</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>

                    <script type="text/javascript">
                        {{-- $('#orderStatus').on('change', function() {
                            console.log('change status');
                            console.log(this.value);
                          }); --}}
                        {{-- document.getElementById("orderStatus").addEventListener("select", updateStaus()); --}}
                        function updateStatus(order_id,status) {
                         console.log(order_id);
                         console.log(status);
                            $.ajax({
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    order_id: order_id,
                                    status: status
                                },
                                url: APP_URL + "/order/status/update",
                                success: function(data){
                                    console.log(data);
                                },
                                error: function(err){
                                    console.log(err);
                                }
                            });
                        }
                    </script>
                    <!-- Modal -->
                    {{-- <div class="c-modal modal fade" id="inventory_modal" tabindex="-1" role="dialog" aria-labelledby="modal2">
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
                        </div><!-- // .c-modal --> --}}
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
                ajax: APP_URL+'/api/orders/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'customer.name', name: 'Customer Name'},
                    { data: 'customer.mobile', name: 'Customer Contact'},
                    { data: 'address.address', name: 'Address'},
                    { data: 'address.flat', name: 'Flat'},
                    { data: 'address.landmark', name: 'Landmark'},
                    { data: 'detail_section', name: 'Details'},
                    { data: 'transaction_id', name: 'Transaction ID'},
                    { data: 'status', name: 'status'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>

@endpush

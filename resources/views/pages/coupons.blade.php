@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{-- Dashboard --}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#coupon_create">
                        Add New
                      </button>
                    <table id="inventory" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Uses</th>
                                <th>Max Uses</th>
                                <th>Max Uses Per User</th>
                                <th>Minimum Cart Total</th>
                                <th>Minimum Cart Total Type</th>
                                <th>Minimum Cart Total Type Value</th>
                                <th>Discount</th>
                                <th>Discount Type</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>

                    <!-- Modal -->
                    <div class="c-modal modal fade" id="coupon_create" tabindex="-1" role="dialog" aria-labelledby="modal2">
                        <div class="c-modal__dialog modal-dialog" role="document">
                            <div class="c-modal__content">
                                <div class="c-modal__body">
                                    <div class="c-select u-mb-xsmall">
                                        <form action='update' method='post'>
                                            {{ @csrf_field() }}

                                            <input class="c-input" id="coupon_id" type="hidden" name="coupon_id" value="0">


                                            <div class="c-field">
                                                <label class="c-field__label" for="name">Name</label>
                                                <input class="c-input" id="name" name="name" type="text" placeholder="Name">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="subject">Code*</label>
                                                <input class="c-input" id="code" name="code" type="text" placeholder="Coupon Code">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="description">Description</label>
                                                <textarea class="c-input" id="description" name="description" placeholder="Descrption"></textarea>
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="uses">Uses (Number of times the coupon has already been used)</label>
                                                <input class="c-input" id="uses" name="uses" type="number" value="0" placeholder="Uses">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="max_uses">Max Uses (Max Number of times the coupon can be used)</label>
                                                <input class="c-input" id="max_uses" name="max_uses" type="number" value="0" placeholder="Uses">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="max_user_uses">Max Uses Per User (Max Number of times the coupon can be used by a USER)</label>
                                                <input class="c-input" id="max_user_uses" name="max_user_uses" type="number" value="0" placeholder="Uses">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="minimum_cart_total">Minimum Cart Total</label>
                                                <input class="c-input" id="minimum_cart_total" name="minimum_cart_total" type="number" value="0" placeholder="Minimum Cart Total">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="minimum_cart_total_type">Minimum Cart Total type</label>
                                                <select class="c-select__input" id="minimum_cart_total_type" name="minimum_cart_total_type" placeholder="Select">
                                                        <option value="0">None</option>
                                                        <option value="1">Books</option>
                                                        <option value="2">Products</option>
                                                </select>
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="minimum_cart_total_type_value">Minimum Cart Total Type Value</label>
                                                <input class="c-input" id="minimum_cart_total_type_value" name="minimum_cart_total_type_value" type="number" value="0" placeholder="Minimum Cart Total Value">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="discount_amount">Discount Amount</label>
                                                <input class="c-input" id="discount_amount" name="discount_amount" type="number" value="0" placeholder="Discount Amount">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="discount_type">Discount Type</label>
                                                <select class="c-select__input" id="discount_type" name="discount_type" placeholder="Select">
                                                        <option value="0">Fixed</option>
                                                        <option value="1">Percentage</option>
                                                </select>
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="start_at">Start At</label>
                                                <input class="c-input" id="start_at" name="start_at" type="date" placeholder="Start Date">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="expire_at">Expire At</label>
                                                <input class="c-input" id="expire_at" name="expire_at" type="date" placeholder="Expire At">
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
        console.log(APP_URL+'/api/books/datatable');
        $(document).ready(function() {
            $('#inventory').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/coupon/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'code', name: 'code' },
                    { data: 'description', name: 'description'},
                    { data: 'uses', name: 'uses'},
                    { data: 'max_uses', name: 'max_uses'},
                    { data: 'max_user_uses', name: 'max_user_uses'},
                    { data: 'minimum_cart_total', name: 'minimum_cart_total'},
                    { data: 'minimum_cart_total_type', name: 'minimum_cart_total_type'},
                    { data: 'minimum_cart_total_type_value', name: 'minimum_cart_total_type_value'},
                    { data: 'discount_amount', name: 'discount_amount'},
                    { data: 'discount_type', name: 'discount_type'},
                    { data: 'start_at', name: 'start_at'},
                    { data: 'expire_at', name: 'expire_at'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>
@endpush

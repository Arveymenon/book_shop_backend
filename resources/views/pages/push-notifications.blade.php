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
                    <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#notification_modal">
                        Add New
                      </button>
                    <table id="notification" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                    <!-- Modal -->
                    <div class="c-modal modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="modal2">
                        <div class="c-modal__dialog modal-dialog" role="document">
                            <div class="c-modal__content">
                                <div class="c-modal__body">
                                    <div class="c-select u-mb-xsmall">
                                        <form action='send' method='post'>
                                            {{ @csrf_field() }}

                                            <input class="c-input" id="retailers_book_id" type="hidden" name="retailers_book_id" value="0">
                                            <div class="c-field">
                                                <label class="c-choice__label" for="user">Select Users</label>
                                                <select class="c-select__input" id="user" name="user" type="text" placeholder="Select">
                                                    <option value="0" selected>Everyone</option>
                                                    @foreach($users as $user)
                                                        @if($user->player_id)
                                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->mobile }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="c-field">
                                                <label class="c-field__label" for="mrp" required>Title</label>
                                                <input class="c-input" id="title" name="title" type="text" placeholder="Title">
                                            </div>
                                            <div class="c-field">
                                                <label class="c-field__label" for="mrp">Message</label>
                                                <input class="c-input" id="message" name="message" type="text" placeholder="Message">
                                            </div>
                                            <div class="c-field">
                                                <label class="c-field__label" for="link">Link</label>
                                                <input class="c-input" id="link" name="link" type="text" placeholder="Link">
                                            </div>

                                            <button type="submit" class="c-btn c-btn--info c-btn--fullwidth">Send Notification</button>
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



@endsection
@push('scripts')
    <script>
        console.log(APP_URL+'/api/inventory/datatable');
        $(document).ready(function() {
            $('#notification').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/push-notification/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'user', name: 'User'},
                    { data: 'title', name: 'Title'},
                    { data: 'message', name: 'Message'},
                    { data: 'link', name: 'Link'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>

@endpush

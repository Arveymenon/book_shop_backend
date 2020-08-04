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
                    <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#inventory_modal">
                        Add New
                      </button>
                    <table id="inventory" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>MRP</th>
                                <th>Board</th>
                                <th>Language</th>
                                <th>Active</th>
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
                                        <form action='update' method='post' enctype="multipart/form-data">
                                            {{ @csrf_field() }}

                                            <input class="c-input" id="retailers_book_id" type="hidden" name="retailers_book_id" value="0">


                                            <div class="c-field">
                                                <label class="c-field__label" for="name">Name</label>
                                                <input class="c-input" id="name" name="name" type="text" placeholder="Name">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="cover_image">Cover Image</label>
                                                <input class="c-input" id="cover_image" name="cover_image" type="file" accept="image/*">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-choice__label" for="board_id">Select Board</label>
                                                <select class="c-select__input" id="board_id" name="board_id" type="text" placeholder="Select">
                                                    @foreach($boards as $board)
                                                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="active">Active</label>
                                                <input class="c-input" id="active" name="active" type="checkbox" placeholder="Active">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-choice__label" for="language_id">Select Language</label>
                                                <select class="c-select__input" id="language_id" name="language_id" type="text" placeholder="Select">
                                                    @foreach($languages as $language)
                                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="mrp">MRP</label>
                                                <input class="c-input" id="mrp_in_rupees" name="mrp_in_rupees" type="text" placeholder="mrp_to_be_shown">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="other_image">Other Image</label>
                                                <input class="c-input" id="other_image" name="other_image[]" type="file" accept="image/*" multiple="true">
                                            </div>

                                            <div class="c-field">
                                                <label class="c-field__label" for="tags">Tags</label>
                                                <select class="form-control js-example-tags" id="tags" name="tags[]" multiple="multiple">
                                                    <option selected="selected">orange</option>
                                                    <option>white</option>
                                                    <option selected="selected">purple</option>
                                                  </select>
                                                {{--  <input class="c-input" id="tags" name="tags[]" type="file" accept="image/*" multiple="true">  --}}
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
        $(document).ready(function() {
            $('#inventory').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/packages/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'image', name: 'image' },
                    { data: 'mrp_in_rupees', name: 'mrp_in_rupees'},
                    { data: 'board.name', name: 'board'},
                    { data: 'language.name', name: 'language', orderable: false},
                    { data: 'active', name: 'active'},
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>

    <script>
        $(document).ready(function() {
            $(".js-example-tags").select2({
                tags: true
            });
        });
    </script>
@endpush

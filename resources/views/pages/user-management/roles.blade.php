@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{--  Dashboard  --}}

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#create-role">
                    Add New Role
                  </button>

                  <table id="roles" class="display text-center" style="width:100%; text-align: center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Edit</th>
                            {{--  <th>Our Price</th>  --}}
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                </table>
            </div>



            <!-- Modal -->
            <div class="c-modal modal fade" id="create-role" tabindex="-1" role="dialog" aria-labelledby="modal2">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="c-modal__content">
                        <div class="c-modal__body">
                            <div class="c-select u-mb-xsmall">
                                <form action='update' method='post'>
                                    {{ @csrf_field() }}

                                    <input class="c-input" id="role_id" type="hidden" name="role_id" value="0">

                                    <div class="c-field">
                                        <label class="c-choice__label" for="book">Role</label>
                                        <input class="c-input" id="role" name="role" type="text" placeholder="Enter Name Of The Role">
                                    </div>
                                    <div class="c-field">
                                        <label class="c-field__label" for="mrp">Permissions To Be Assigned</label>

                                        <div class="col-md-12">
                                            <select class="form-control js-example-tags" id="permissions" name="permissions[]" multiple="multiple" style="width: 100%">
                                                @foreach($permissions as $permission)   <option id="permission-option-{{ $permission->id }}" value="{{ $permission->id }}">{{ $permission->name }}</option>  @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="c-btn c-btn--info c-btn--fullwidth">Create/Update New Role</button>
                                </form>
                              </div>
                            </div>
                        </div><!-- // .c-modal__content -->
                    </div><!-- // .c-modal__dialog -->
                </div><!-- // .c-modal -->



        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        console.log(APP_URL+'/api/roles/datatable');
        $(document).ready(function() {
            $('#roles').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/roles/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'permissions', name: 'permissions' },
                    { data: 'edit', name: 'edit' },
                    {{--  { data: 'retailers_price', name: 'retailers_price'},  --}}
                ],
                "order": [[ 0, "desc" ]]

            } );
        } );
    </script>
    <script>
        console.log($(".js-example-tags"));
        {{--  console.log(select2())  --}}
        $(document).ready(function() {
            $(".js-example-tags").select2();
        });
    </script>

    <script>
        function edit(id){
            console.log(id);
            $.ajax({
                method: 'get',
                url: APP_URL+'/user-management/role/get/'+id,
                success: function(res){
                    console.log(res);
                    if(res.error == false){
                        console.log($('#role_id'));
                        $('#role_id').attr('value',id);
                        $('#role').attr('value',res.response.name);
                        console.log($('#permissions'));
                        permissions = [];
                        for(let permission of res.response.permissions){
                            permissions.push(permission.id);
                        }
                        console.log(permissions);
                        $('.js-example-tags').val(permissions);
                        $('.js-example-tags').trigger('change');
                        $('#create-role').modal({
                            backdrop: true,
                            focus: true,
                            show: true
                        });
                    }
                },
                error: function(err){
                    console.log(err);
                }
            })
        }
    </script>
@endpush

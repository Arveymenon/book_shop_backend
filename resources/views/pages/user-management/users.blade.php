@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <button type="button" class="c-btn c-btn--info" data-toggle="modal" data-target="#create-user">
                    Add New
                  </button>

                  <table id="users" class="display text-center" style="width:100%; text-align: center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Edit</th>
                            {{--  <th>Our Price</th>  --}}
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                </table>
            </div>



            <!-- Modal -->
            <div class="c-modal modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="modal2">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="c-modal__content">
                        <div class="c-modal__body">
                            <div class="c-select u-mb-xsmall">
                                <form action='{{ route('register') }}' method='post'>
                                    {{ @csrf_field() }}

                                    <input class="c-input" id="user_id" type="hidden" name="user_id" value="0">

                                    <div class="c-field">
                                        <label class="c-choice__label" for="book">Name</label>
                                        <input class="c-input" id="name" name="name" type="text" placeholder="Enter Name">
                                    </div>

                                    <div class="c-field">
                                        <label class="c-choice__label" for="book">Email</label>
                                        <input class="c-input" id="email" name="email" type="email" placeholder="Enter Email">
                                    </div>

                                    <div class="c-field" id="password">
                                        <label class="c-choice__label" for="book">Password</label>
                                        <input class="c-input @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="c-field" id="confirm_password">
                                        <label class="c-choice__label" for="book">Confirm Password</label>
                                        <input class="c-input" name="confirm_password" type="password" placeholder="Confirm Password">
                                    </div>

                                    <div class="c-field">
                                        <label class="c-field__label" for="mrp">Roles To Be Assigned</label>

                                        <div class="col-md-12">
                                            <select class="form-control js-example-tags" id="roles" name="roles[]" multiple="multiple" style="width: 100%">
                                                @foreach($roles as $role)   <option>{{ $role->name }}</option>  @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <button id="edit_user_button" onclick="updateUser()" class="hidden" type="button" class="c-btn c-btn--info c-btn--fullwidth">Update User</button>
                                    <button id="create_user_button" type="submit" class="c-btn c-btn--info c-btn--fullwidth">Create New User</button>
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
        console.log(APP_URL+'/api/users/datatable');
        $(document).ready(function() {
            $('#users').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: APP_URL+'/api/users/datatable',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email' },
                    { data: 'roles', name: 'roles' },
                    { data: 'edit', name: 'edit' },
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

            $('#password').css('display: none');
            $('#password').addClass('hidden')
            console.log($('#password'));
            $.ajax({
                method: 'get',
                url: APP_URL+'/user-management/users/get/'+id,
                success: function(res){
                    console.log(res);
                    if(res.error == false){
                        console.log($('#role_id'));
                        $('#user_id').attr('value',id);
                        $('#name').attr('value',res.response.name);
                        $('#email').attr('value',res.response.email);
                        console.log($('#roles'));
                        roles = [];
                        for(let role of res.response.roles){
                            roles.push(role.name);
                        }
                        console.log(roles);
                        $('.js-example-tags').val(roles);
                        $('.js-example-tags').trigger('change');
                        $('#create-role').modal({ backdrop: true, focus: true, show: true });

                        $('#create_user_button').addClass('hidden');
                        $('#create_user_button').removeClass('hidden');
                    }
                },
                error: function(err){
                    console.log(err);
                }
            })
        }
    </script>
    <script>
        function updateUser(){
            console.log('heh');
            console.log($('form').val());
            $.ajax({
                method: 'post',
                url: APP_URL+'/user-management/users/update',
                data: $('form'),
                success: function(res){
                    console.log(res);
                    if(res.error == false){
                    }
                },
                error: function(err){
                    console.log(err);
                }
            })
        }
    </script>
@endpush

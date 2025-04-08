<x-cover_page_layout>
    <br>
    <style>
        th {
            text-align: center;
        }
    </style>
    @include('actions.nav')
    <div class="container my-5">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>User</h4>
                    <div class=" d-flex justify-content-end">
                        <a href="/users/create"><button class="btn btn-primary float-end">Add User</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            @canany(['edit user', 'delete user'])
                                <th>Action</th>
                            @endcanany
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        @if ($data->getRoleNames())
                                            @foreach ($data->getRoleNames() as $role)
                                                <label class="mx-2"
                                                    for="">{{ $role }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    @canany(['edit user', 'delete user'])
                                        <td class="d-flex">
                                            @can('edit user')
                                                <div class="mx-2" style="width: 100%">
                                                    <a href="/users/{{ $data->id }}/edit"><button class="btn btn-warning"
                                                            style="width: 100%">Edit</button></a>
                                                </div>
                                            @endcan
                                            @can('delete user')
                                                <div class="mx-2" style="width: 100%">
                                                    <form action="/users/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" id="delete_user"
                                                            style="width: 100%">Delete</button>
                                                    </form>
                                                </div>
                                            @endcan
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete_user', function(e) {
                console.log("hi");
                if (!confirm('Remove this user')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</x-cover_page_layout>

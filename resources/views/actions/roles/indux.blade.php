<x-cover_page_layout>
    <style>
        th {
            text-align: center
        }
    </style>
    <br>
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
                    <h4>Roles</h4>
                    <div class=" d-flex justify-content-end">
                        <a href="/roles/create"><button class="btn btn-primary">Add Roles</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <th>Role Name</th>
                            @canany(['edit user', 'delete user'])
                                <th>Action</th>
                            @endcanany
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    @canany(['edit user', 'delete user'])
                                        <td class="d-flex d-flex justify-content-between align-items-center">
                                            @if (auth()->user()->hasRole('super-admin'))
                                                <div class="mx-2" style="width: 100%">
                                                    <a href="/roles/{{ $data->id }}/give_permission"><button
                                                            class="btn btn-primary"
                                                            style="width: 100%">Add/Edit_Role&Permission</button></a>
                                                </div>
                                            @endif
                                            @can('edit role')
                                                <div class="mx-2" style="width: 100%">
                                                    <a href="/roles/{{ $data->id }}/edit"><button class="btn btn-warning"
                                                            style="width: 100%">Edit</button></a>
                                                </div>
                                            @endcan
                                            @can('delete role')
                                                <div class="mx-2" style="width: 100%">
                                                    <form action="/roles/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" id="delete_role"
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
            $(document).on('click', '#delete_role', function(e) {
                console.log("hi");
                if (!confirm('Remove this role')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</x-cover_page_layout>

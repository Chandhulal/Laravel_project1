<x-cover_page_layout>
    <br>
    <style>
        th {
            text-align: center;
            /* width: 100%; */
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
                    <h4>Permissions</h4>
                    <div class=" d-flex justify-content-end">
                        <a href="/permissions/create"><button class="btn btn-primary">Add Permission</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <th>Name</th>
                            @canany(['edit user', 'delete user'])
                                <th style="width: 50%">Action</th>
                            @endcanany
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    @canany(['edit user', 'delete user'])
                                        <td class="d-flex">
                                            @can('edit permission')
                                                <div style="width: 100%">
                                                    <a href="/permissions/{{ $data->id }}/edit"><button
                                                            class="btn btn-warning" style="width: 100%">Edit</button></a>
                                                </div>
                                            @endcan
                                            @can('delete permission')
                                                <div class="mx-2" style="width: 100%">
                                                    <form action="/permissions/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" id="delete_permission"
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
    <br>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete_permission', function(e) {
                console.log("hi");
                if (!confirm('Remove this permission')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</x-cover_page_layout>

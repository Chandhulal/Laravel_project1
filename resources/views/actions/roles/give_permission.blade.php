<x-cover_page_layout>
    <br>
    <style>
        th {
            text-align: center;
            width: 200px
        }
    </style>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Give Permission to {{ $data->name }}</h4>
                        <div class=" d-flex justify-content-end">
                            <a href="/roles"><button class="btn btn-danger float-end">Back</button></a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <form action="/roles/{{ $data->id }}/add_permission" method="post">
                            @csrf
                            <div class="container p-5">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <th>Name</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission as $permission)
                                            <tr>
                                                <td>
                                                    {{ $permission->name }}
                                                </td>
                                                <td>
                                                    @if (in_array($permission->id, $permission_id))
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}" checked>&nbsp;
                                                    @else
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}">&nbsp;
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success" style="width: 200px">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</x-cover_page_layout>

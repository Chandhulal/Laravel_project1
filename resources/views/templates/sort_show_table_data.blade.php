<style>
    .glyphicon {
        cursor: pointer;
    }
</style>
<div class="card">
    {{-- <div class="container">
        <div class="float-start">
            {{ $datas->links() }}
        </div>
    </div> --}}
    <div class="card-body">
        <table class="table text-center table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <div class="d-flex align-items-center justify-content-center">
                            Course Name
                            <div>
                                <span class="name_ase glyphicon">&#xe253;</span><br>
                                <span class="name_desc glyphicon">&#xe252;</span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex align-items-center justify-content-center">
                            Course Id
                            <div class="mx-2">
                                <span class="id_ase glyphicon">&#xe253;</span><br>
                                <span class="id_desc glyphicon">&#xe252;</span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex align-items-center justify-content-center">
                            <span>
                                Semester
                                <small>(in month)</small>
                            </span>
                            <div class="mx-2">
                                <span class="semester_ase glyphicon">&#xe253;</span><br>
                                <span class="semester_desc glyphicon">&#xe252;</span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex align-items-center justify-content-center">
                            Status
                            <div class="mx-2">
                                <span class="glyphicon"></span><br>
                                <span class="glyphicon"></span>
                            </div>
                        </div>
                    </th>
                    @canany(['edit course', 'delete course'])
                        <th>
                            <div class="d-flex align-items-center justify-content-center">
                                Actions
                                <div class="mx-2">
                                    <span class="glyphicon"></span><br>
                                    <span class="glyphicon"></span>
                                </div>
                            </div>
                        </th>
                    @endcanany
                </tr>
            </thead>
            <tbody id="body">
                @foreach ($datas as $data)
                    <tr id="{{ $data->id }}">
                        <td class="table_name_sort">
                            <a href="https://www.youtube.com/results?search_query={{ $data->name }}"
                                target="_blank">{{ $data->name }}</a>
                        </td>
                        <td>{{ $data->course_id }}</td>
                        <td>{{ $data->semester }}</td>
                        @if ($data->status_id == 1)
                            <td style="color: green;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="glyphicon glyphicon-ok green-circle mx-2"></span>
                                    {{ $data->status->status }}
                                </div>
                            </td>
                        @else
                            <td style="color: red;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="glyphicon glyphicon-remove red-circle mx-2"></span>
                                    {{ $data->status->status }}
                                </div>
                            </td>
                        @endif
                        @canany(['edit course', 'delete course'])
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    @can('edit course')
                                        <button class="edit btn btn-warning mx-1" style="width: 100%">Edit</button>
                                    @endcan
                                    @can('delete course')
                                        <button class="delete btn btn-danger mx-1" style="width: 100%">Delete</button>
                                    @endcan
                                </div>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>

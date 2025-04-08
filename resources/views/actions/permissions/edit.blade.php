<x-cover_page_layout>
    <br>
    @include('actions.nav')
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit Permission</h4>
                        <div class=" d-flex justify-content-end">
                            <a href="/permissions"><button class="btn btn-danger float-end">Back</button></a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <form action="/permissions/{{ $data->id }}" method="post" style="width: 300px">
                            @csrf
                            @method('patch')
                            <div class="d-flex">
                                <div class="form-group mb-3">
                                    <input class="form-control" type="text" name="permission" id="permission"
                                        value="{{ $data->name }}" required>
                                </div>
                                <div class="form-group ml-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cover_page_layout>

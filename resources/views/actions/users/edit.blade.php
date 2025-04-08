<x-cover_page_layout>
    <br>
    @include('actions.nav')
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit user</h4>
                        <div class=" d-flex justify-content-end">
                            <a href="/roles"><button class="btn btn-danger float-end">Back</button></a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <form action="/users/{{ $data->id }}" method="post" style="width: 300px">
                            @csrf
                            @method('patch')
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ $data->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="email" name="email" id="email"
                                    value="{{ $data->email }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <select class="form-control" name="roles[]" multiple>
                                    @foreach ($role as $role)
                                        @if (in_array($role, $data->getRoleNames()->toArray()))
                                            <option value="{{ $role }}" selected>{{ $role }}</option>
                                        @else
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cover_page_layout>

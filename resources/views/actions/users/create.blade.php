<x-cover_page_layout>
    <br>
    @include('actions.nav')
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Add User</h4>
                        <div class=" d-flex justify-content-end">
                            <a href="/users"><button class="btn btn-danger float-end">Back</button></a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <form action="/users" method="post" style="width: 300px">
                            @csrf
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" name="name" id="name"
                                    placeholder="User" required>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="email" name="email" id="email"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="password" name="password" id="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group mb-3">
                                <select class="form-control" name="roles[]" multiple>
                                    <option value="">--Roles--</option>
                                    @foreach ($data as $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cover_page_layout>

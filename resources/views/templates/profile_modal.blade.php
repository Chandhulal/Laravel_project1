<div class="modal" id="profile_modal">
    <div class="modal-dialog" role="document">
        <div class="d-flex align-items-center">
            <div class="modal-content p-5">
                <h3>Profile</h3>
                <label for="" class="form-control">Name : {{ Auth::user()->name }}</label>
                <label for="" class="form-control">Email : {{ Auth::user()->email }}</label>
                <label for="" class="form-control">Logged in as :
                    @if ($data=Auth::user()->roles->pluck('name'))
                        @foreach ($data as $role)
                            <span class="mx-2" for="">{{ $role }}</span>
                        @endforeach
                    @endif
                </label>
                <br>
                <button type="button" class="close_modal btn btn-danger">Close</button>
            </div>
        </div>
    </div>
</div>

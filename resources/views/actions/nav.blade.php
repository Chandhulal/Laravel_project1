<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center py-3">
        <div class="d-flex align-items-center">
            <a href="/permissions" class="btn btn-success mx-2">Permissions</a>
            <a href="/roles" class="btn btn-primary mx-2">Roles</a>
            <a href="/users" class="btn btn-secondary mx-2">User</a>
        </div>
        <div class="d-flex align-items-right justify-content-between">
            <a href="/courses" class="btn btn-warning mx-2">Course</a>
            <a href="/logout" id="logout" class="btn btn-danger mx-2">Logout {{ Auth::user()->name }}</a>
        </div>
    </div>
</div>
<hr>
<script>
    $(document).ready(function() {
        $(document).on('click', '#logout', function(e) {
            if (!confirm('Confirm Logout')) {
                e.preventDefault();
            }
        });
    });
</script>

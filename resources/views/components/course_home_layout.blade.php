<div class="one">
    <h4>Course Library</h4>
</div>
<div class="container">
    <div class="d-flex justify-content-end">
        <a href="/course_home" class="btn border btn-outline-primary m-2">Home</a>
        <a href="/courses" class="btn border btn-outline-primary m-2">Course Table</a>
        @if (auth()->user()->hasRole(['super-admin', 'admin']))
            <span id="settings" class="btn border btn-outline-primary m-2">Settings</span>
            <a href="/faq_mails" class="btn border btn-outline-primary m-2">Emails</a>
        @endif
        <span id="profile" class="btn border btn-outline-primary m-2">Profile</span>
        @if (auth()->user()->hasRole(['student']))
            <span id="support" class="btn border btn-outline-primary m-2">Support</span>
        @endif
        <a href="/logout" id="logout" class="btn btn-outline-danger border m-2">Logout
            {{ Auth::user()->name }}</a>
    </div>
</div>
<hr>
{{-- -------------------------------------profile------------------------------------ --}}
@include('templates.profile_modal')

{{-- -------------------------------------settings------------------------------------ --}}
@include('templates.settings_modal')

{{-- -------------------------------------support------------------------------------ --}}
@include('templates.support_modal')

{{-- -------------------------------------add_course------------------------------------ --}}
@include('templates.add_course_modal')

{{-- -------------------------------------edit_course------------------------------------ --}}
@include('templates.edit_course_modal')

{{-- -------------------------------------delete_course------------------------------------ --}}
@include('templates.delete_course_modal')

{{-- -------------------------------------exel form------------------------------------ --}}
@include('templates.import_course_modal')

<script>
    $(document).ready(function() {

        //profile show
        $(document).on('click', '#profile', function(e) {
            e.preventDefault();
            $('#profile_modal').show();
        });

        //settings show
        $(document).on('click', '#settings', function(e) {
            e.preventDefault();
            $('#settings_modal').show();
        });

        //support modal
        $(document).on('click', '#support', function(e) {
            e.preventDefault();
            $('#support_modal').show();
        });

        //import modal
        $(document).on('click', '#import_courses', function(e) {
            e.preventDefault();
            $('#import_modal').show();
        });

        //logout
        $(document).on('click', '#logout', function(e) {
            if (!confirm('Confirm Logout')) {
                e.preventDefault();
            }
        });

        //close modals
        $(document).on('click', '.close_modal', function(e) {
            close_modal();
        });

        //close function
        function close_modal() {
            $('#add_form').find('.info').val("");
            $('#add_modal').hide();
            $('#edit_form').find('.info').val("");
            $('#delete_modal').hide();
            $('#delete_form').find('.info').val("");
            $('#edit_modal').hide();
            $('#profile_modal').hide();
            $('#settings_modal').hide();
            $('#import_modal').hide();
            $('#support_form').find('.info').val("");
            $('#support_modal').hide();
        };
    });
</script>

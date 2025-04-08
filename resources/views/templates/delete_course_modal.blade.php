<div class="modal" id="delete_modal">
    <div class="modal-dialog modal-sm" role="document">
        <!-- Added 'modal-sm' class here for small modal -->
        <div class="modal-content d-flex justify-content-center align-items-center">
            <form id="delete_form" class="p-5">
                @csrf
                @method('delete')
                <span class="delete_course_name form-control"></span><br>
                <span class="delete_course_id form-control"></span><br>
                <button type="submit" class="delete_user btn btn-danger">Delete</button>
                <button type="button" class="close_modal btn btn-secondary">Close</button>
            </form>
        </div>
    </div>
</div>
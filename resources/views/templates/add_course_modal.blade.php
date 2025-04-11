<div class="modal" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-flex justify-content-center align-items-center">
            <form id="add_form" class="p-2">
                @csrf
                <h5>Add new course</h5>
                <div class="content">
                    <div class="form-input">
                        <label for="course_name">Course Name</label>
                        <input class="info" type="text" name="course_name" id="course_names"
                            value="{{ old('course_name') }}" required>
                    </div>
                </div>
                <span id="course_name_error" style="color: rgb(216, 26, 26)"></span>
                <br>
                <div class="content">
                    <div class="form-input">
                        <label for="course_id">Kh course id</label>
                        <input class="info" type="text" name="course_id" id="course_ids"
                            value="{{ old('course_id') }}" required>
                    </div>
                </div>
                <span id="course_id_error" style="color: rgb(216, 26, 26)"></span>
                <br>
                <div class="content">
                    <div class="form-input">
                        <label for="semester">Semester(month)</label>
                        <input class="info" type="number" name="semester" id="semester"
                            value="{{ old('semester') }}" required>
                    </div>
                </div>
                <span id="semester_error" style="color: rgb(216, 26, 26)"></span>
                <br>
                <div class="content">
                    <div clss="form-input">
                        <label for="status">Status</label>
                        <label id="active-status">

                        </label>
                    </div>
                </div>
                <span id="status_error" style="color: rgb(216, 26, 26)"></span>
                <br>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="button" class="close_modal btn btn-warning shadow-lg mx-2" style="width:100%"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary shadow-lg mx-2" style="width:100%">Save
                        course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-flex justify-content-center align-items-center">
            <form action="" id="edit_form" class="p-5">
                @csrf
                @method('patch')
                <h5>Edit new course</h5>
                <div class="content">
                    <div class="form-input">
                        <label for="edit_name">Course Name</label>
                        <input class="info" type="text" name="edit_name" id="edit_name"
                            value="{{ old('edit_name') }}" required>
                    </div>
                </div>
                @error('edit_name')
                    <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                @enderror
                <br>
                <div class="content">
                    <div class="form-input">
                        <label for="edit_id">Kh course id</label>
                        <input class="info" type="text" name="edit_id" id="edit_id" value="{{ old('edit_id') }}"
                            required>
                    </div>
                </div>
                @error('edit_id')
                    <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                @enderror
                <br>
                <div class="content">
                    <div class="form-input">
                        <label for="edit_semester">Semester</label>
                        <input class="info" type="text" name="edit_semester" id="edit_semester"
                            value="{{ old('edit_semester') }}" required>
                    </div>
                </div>
                @error('edit_semester')
                    <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                @enderror
                <br>
                <div class="content">
                    <div class="form-input">
                        <label for="edit_status">Status</label>
                        <label>
                            <input type="radio" class="edit_status" id="active" name="status" value="active"> Active
                            <input type="radio" class="edit_status" id="non-active" name="status" value="non-active"> Non-Active
                        </label>
                    </div>
                </div>
                @error('edit_status')
                    <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                @enderror
                <br>

                <div class="buttons">
                    <button class="close_modal btn shadow-lg" style="background-color: rgb(212, 212, 212)"
                        type="reset">Close</button>
                    <button type="submit" class="btn bg-primary shadow-lg" style="color: white">Save
                        course</button>
                </div>
            </form>
        </div>
    </div>
</div>

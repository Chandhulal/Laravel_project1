<div class="modal" id="support_modal">
    <div class="modal-dialog" role="document">
        <div class="d-flex align-items-center">
            <div class="modal-content p-5">
                <h3>Support</h3>
                <form action="" method="post" class="p-5" id="support_form">
                    @csrf
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="3">{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                    @enderror
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="button" class="close_modal btn btn-warning shadow-lg mx-2"
                            style="width:100%" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary shadow-lg mx-2" style="width:100%">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

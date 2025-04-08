<div class="modal" id="import_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content d-flex justify-content-center align-items-center">
            <form id="import_data" action="" method="POST" class="p-5" enctype="multipart/form-data">
                @csrf
                <h4>Import course</h4>
                <div class="mb-4">
                    <input type="file" accept=".xlsx,.csv" name="import" id="import" style="background-color: rgb(151, 151, 151)">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger mx-2">Upload</button>
                    <button type="button" class="close_modal btn btn-secondary mx-2">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

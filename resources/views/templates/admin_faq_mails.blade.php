<x-cover_page_layout>
    @include('components.course_home_layout')
    <div class="container my-4">
        <h3>Mails</h3>
        <div class="row g-4">
            @foreach ($mails as $mail)
                <div class="col-md-6 mb-5">
                    <form action="" method="post" id="{{ $mail->id }}" class="delete_faq_mail">
                        <div class="card shadow-lg" style="border-radius: 10px;">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between">
                                    <span class="form-control mr-2">Name: {{ $mail->user->name }}</span>
                                    @csrf
                                    @method('delete')
                                    <button id="checked" class="btn btn-primary">Remove</button>
                                </div><br>
                                <textarea class="form-control" rows="5" readonly>{{ $mail->message }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <br>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '.delete_faq_mail', function(e) {
                if (confirm('Confirm delete?')) {
                    e.preventDefault();
                    let id = $(this).closest('form')[0].id;
                    let closest_form = $(this).closest('form');

                    $.ajax({
                        url: '/delete_faq_mail/' + id,
                        type: 'delete',
                        data: closest_form.serialize(),
                        success: function(response) {

                            if (response == "deleted") {
                                closest_form.remove();
                                close_modal();
                            }
                        },
                    });
                } else {
                    e.preventDefault();
                }
            });

            function close_modal() {
                $('#support_form').find('#message').val("");
                $('#support_modal').hide();
            };
        });
    </script>
</x-cover_page_layout>

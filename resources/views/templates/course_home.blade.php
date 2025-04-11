<x-cover_page_layout>
    @include('components.course_home_layout')

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body d-flex">
                <div class="m-5">
                    <img src="storage/img/cover3.jpg" alt="img" style="width: 400px;height:300px;border-radius:10px">
                </div>
                <div class="p-5 d-flex align-items-center"
                    style="font-family: 'Times New Roman', Times, serif;font-size:large">
                    Choosing to study at this college offers you a chance to receive a high-quality education in a
                    supportive and dynamic environment. With experienced faculty, modern facilities, and a focus on
                    practical learning, the college ensures that students are well-prepared for their future careers.
                    The diverse academic programs, coupled with a range of extracurricular activities, foster personal
                    growth and development.
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-body d-flex">
                <div class="p-5 d-flex align-items-center"
                    style="font-family: 'Times New Roman', Times, serif;font-size:large">
                    Education is the foundation of personal and societal growth. It equips individuals with knowledge,
                    skills, and values, empowering them to make informed decisions and contribute meaningfully to their
                    communities. Beyond academics, education fosters critical thinking, creativity, and emotional
                    intelligence, shaping the future of individuals and nations alike.
                </div>
                <div class="m-5">
                    <img src="storage/img/cover2.jpg" alt="img"
                        style="width: 400px;height:300px;border-radius:10px">
                </div>
            </div>
        </div>
    </div>
    <br>



    <div class="">
        <div class="container">
            <form action="/add_comment" method="post" class="px-5">
                @csrf
                <div class="d-flex justify-content-center align-items-center m-5">
                    <textarea class="form-control mx-2" name="comment" id="comment" cols="10" rows="2" required></textarea>
                    <button class="btn btn-primary mx-2" style="width: 100px">Post</button>
                </div>
            </form>
        </div>


        <div class="container shadow-lg p-5" style="width: 500px">
            @foreach ($comments as $comment)
                @if ($comment->parent_id == null)
                    <div class="comment">
                        <div>
                            <div class="d-flex">
                                <span>
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="background-color: brown;width: 40px;height:40px;border-radius:50%">
                                        <div style="background-color: white;width: 36px;height:36px;border-radius:50%">
                                        </div>
                                    </div>
                                </span>
                                <span style="width: 100%;margin-left: 10px;">
                                    <b style="color: rgb(12, 15, 19)">{{ $comment->user->name }}</b><br>
                                    <div class="d-flex align-items-center">
                                        <span style="width: 100%">
                                            {!! nl2br(e(wordwrap($comment->comment, 40, "\n", true))) !!}
                                        </span><br>
                                        <span class="glyphicon glyphicon-heart-empty"></span>
                                    </div>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="reply mr-5" style="color: gray">Reply</a>
                                        <a href="" style="color: gray">See translation</a>
                                    </div>

                                    <div class="reply-form-container" style="display: none;">
                                        <form action="/add_replay/{{ $comment->id }}" method="post"
                                            class="reply-form px-5">
                                            @csrf
                                            <div class="d-flex justify-content-center align-items-center m-5">
                                                <textarea class="form-control mx-2" name="replay" id="replay" cols="10" rows="1"
                                                    placeholder="Write your reply here..." required></textarea>
                                                <button class="btn btn-primary mx-2" style="width: 100px">Post</button>
                                            </div>
                                        </form>
                                    </div>

                                </span>
                            </div>
                            @php
                                $replies = \App\Models\Comment::where('parent_id', $comment->id)->get();
                            @endphp

                            @if ($replies->isNotEmpty())
                                <div class="replies" style="margin-left: 40px;">
                                    @foreach ($replies as $reply)
                                        @php
                                            $user = \App\Models\Comment::find($comment->id);
                                        @endphp
                                        @include('templates.reply_form', [
                                            'comment' => $reply,
                                            'user' => $user,
                                        ])
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <br>
    </div>

    <script>
        $(document).ready(function() {
            document.querySelectorAll('.reply').forEach(button => {
                button.addEventListener('click', function() {
                    console.log($('.reply-form-container'));

                    const replyForm = $(this)[0].parentNode.nextElementSibling;
                    replyForm.style.display = 'block';
                });
            });
        });
    </script>

</x-cover_page_layout>

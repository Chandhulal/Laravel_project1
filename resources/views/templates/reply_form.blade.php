<div class="comment mb-4">
    <div>
        <div class="d-flex my-4">
            <span>
                <div class="d-flex justify-content-center align-items-center"
                    style="background-color: brown;width: 30px;height:30px;border-radius:50%">
                    <div style="background-color: white;width: 26px;height:26px;border-radius:50%">
                    </div>
                </div>
            </span>
            <span style="width: 100%;margin-left: 10px;">
                <b style="color: rgb(12, 15, 19)">{{ $comment->user->name }}</b>
                @if ($user)
                    <div class="d-flex align-items-center">
                        <div style="width: 100%">
                            <a href="" class="mr-2"><span>@</span>{{ $user->user->name }}</a>
                            <span style="width: 100%">
                                {!! nl2br(e(wordwrap($comment->comment, 37, "\n", true))) !!}
                            </span><br>
                        </div>
                        <span class="glyphicon glyphicon-heart-empty" style="cursor: pointer"></span>
                    </div>
                @endif
                <div class="d-flex">
                    <a href="javascript:void(0);" class="reply mr-5" style="color: gray">Reply</a>
                    <a href="" style="color: gray">See translation</a>
                </div>
                <div class="reply-form-container" style="display: none;">
                    <form action="/add_replay/{{ $comment->id }}" method="post" class="reply-form px-5">
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
            <div class="replies">
                @foreach ($replies as $reply)
                    @php
                        $user = \App\Models\Comment::find($comment->id);
                    @endphp
                    @include('templates.reply_form', ['comment' => $reply, 'user' => $user])
                @endforeach
            </div>
        @endif

    </div>
</div>

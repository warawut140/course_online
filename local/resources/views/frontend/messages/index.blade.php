{{--<div class="message-wrapper">--}}
    <ul class="messages bubble-chat">
        @foreach($messages as $message)
            {{--<li class="message clearfix">--}}
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                {{--<div class="{{ ($message->from == Auth::id()) ? 'sent' : 'received' }}">--}}
                    {{--<p>{{ $message->message }}</p>--}}
                    {{--<p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>--}}
                {{--</div>--}}
            {{--</li>--}}
            <li class="{{ ($message->from == Auth::id()) ? 'sent' : 'replies' }}">
                @if($message->from == Auth::id())
                    <img src="{{ asset('images/profile/'.$message->image_to) }}" alt="" />
                @else
                    <img src="{{ asset('images/profile/'.$message->image_from) }}" alt="" />
                @endif

                <p>{{ $message->message }} <br>
                    {{--<i style="font-size: 2px">{{ date('d M Y, h:i a', strtotime($message->created_at)) }}</i>--}}
                </p>
            </li>
        @endforeach
    </ul>
{{--</div>--}}

{{--<div class="input-text">--}}
    {{--<input type="text" name="message" class="submit">--}}
{{--</div>--}}

<div class="message-input input-text">
    <div class="wrap">
        <input type="text" class="submit" name="message" placeholder="Write your message..." >
        {{--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>--}}
        <button name="message"  class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </div>
</div>
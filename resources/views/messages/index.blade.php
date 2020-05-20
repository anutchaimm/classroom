<div class="message-profile">

    @if($friend->prf_img)
        <img src="{{asset('storage')}}/{{$friend->prf_img}}" class="messages-profile media-object" alt="Avatar">
    @else
        <img src="{{asset('images/user.jpg')}}" class="messages-profile media-object" alt="Avatar">
    @endif
    <span class="pl-2">
        {{$friend->prf_firstname}} {{$friend->prf_lastname}}
    </span>
</div>
<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
        <li class="message clearfix">
            {{--if message from id is equal to auth id then it is sent by logged in user --}}
            <div class="{{ ($message->from == Auth::id()) ? 'sent' : 'received' }}">
                <p>{{ $message->message }}</p>
                <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>
<div class="message-input">
    <div class="input-text">
        <div class="input-group mb-0">
            <input type="text" class="form-control submit border-0" name="message" placeholder="Say Somethings..." aria-describedby="message-send">
            <div class="input-group-append">
                <button class="btn  border-0" id="message-send">
                    <img src="{{asset('images/icon/send.png')}}" class="icon-send" alt="">
                </button>
            </div>
        </div>
    </div>
</div>

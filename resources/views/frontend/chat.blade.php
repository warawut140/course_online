@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            /*cursor: pointer;*/
            /*padding: 5px 0;*/
            /*position: relative;*/
        }

        .user:hover {
            /*background: #eeeeee;*/
        }

        .user:last-child {
            /*margin-bottom: 0;*/
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        /*.sent {*/
            /*background: #3bebff;*/
            /*float: right;*/
            /*text-align: right;*/
        /*}*/

        /*.message p {*/
            /*margin: 5px 0;*/
        /*}*/

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        /*input[type=text] {*/
            /*width: 100%;*/
            /*padding: 12px 20px;*/
            /*margin: 15px 0 0 0;*/
            /*display: inline-block;*/
            /*border-radius: 4px;*/
            /*box-sizing: border-box;*/
            /*outline: none;*/
            /*border: 1px solid #cccccc;*/
        /*}*/

        /*input[type=text]:focus {*/
            /*border: 1px solid #aaaaaa;*/
        /*}*/
    </style>
@endsection
@section('content')
    <div id="app">
        <div id="message-content" class="bg-light">
            <div id="frame">
                {{-- List User --}}
                <div id="sidepanel">
                    <div id="profile">
                        <div class="wrap">
                            <img id="profile-img" src="{{ asset('images/profile/'.$profile->image_profile) }}" class="online" alt="" />
                            <p>{{ Auth::user()->name }}</p>
                            {{--<div id="status-options">--}}
                                {{--<ul>--}}
                                    {{--<li id="status-online" class="active"><span class="status-circle"></span><p>Online</p></li>--}}
                                    {{--<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>--}}
                                    {{--<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>--}}
                                    {{--<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    {{--<div id="search">--}}
                        {{--<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>--}}
                        {{--<input type="text" placeholder="Search contacts..." />--}}
                    {{--</div>--}}
                    <div id="contacts">
                        <ul class="list-contact">
                            {{-- Loop list user --}}
                            @foreach($users as $user)
                              <li class="user contact" id="{{ $user->id }}">
                                <div class="wrap">
                                    {{--<span class="contact-status online"></span>--}}
                                    @if($user->unread)
                                        <span class="pending" style="   position: absolute;left: 28px; top: 31px;
            background: #b600ff; margin: 0; border-radius: 50%;width: 18px;height: 18px;line-height: 18px;
            padding-left: 5px;color: #ffffff;font-size: 12px;">{{ $user->unread }}</span>
                                    @endif
                                    <img src="{{ asset('images/profile/'.$user->image_profile) }}" alt="" />
                                    <div class="meta">
                                        <p class="name">{{ $user->firstname }} {{ $user->lastname }}</p>
                                        {{--<p class="preview">You just got LITT up, Mike.</p>--}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{-- Content Chat User --}}
                <div class="content">
                    {{--<div class="contact-profile">--}}
                        {{--<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />--}}
                        {{--<p>Harvey Specter</p>--}}
                        {{--<div class="social-media">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div id="messages" class="messages">
                        {{--<ul class="bubble-chat">--}}
                            {{--<li class="sent">--}}
                                {{--<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />--}}
                                {{--<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>--}}
                            {{--</li>--}}
                            {{--<li class="replies">--}}
                                {{--<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />--}}
                                {{--<p>When you're backed against the wall, break the god damn thing down.</p>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    </div>
                    {{--<div class="message-input">--}}
                        {{--<div class="wrap">--}}
                            {{--<input type="text" placeholder="Write your message..." />--}}
                            {{--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>--}}
                            {{--<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection
@section('script')
    <script>
        $(".messages").animate({ scrollTop: $(document).height() }, "fast");

        $("#profile-img").click(function() {
            $("#status-options").toggleClass("active");
        });

        $(".expand-button").click(function() {
            $("#profile").toggleClass("expanded");
            $("#contacts").toggleClass("expanded");
        });

        $("#status-options ul li").click(function() {
            $("#profile-img").removeClass();
            $("#status-online").removeClass("active");
            $("#status-away").removeClass("active");
            $("#status-busy").removeClass("active");
            $("#status-offline").removeClass("active");
            $(this).addClass("active");

            if($("#status-online").hasClass("active")) {
                $("#profile-img").addClass("online");
            } else if ($("#status-away").hasClass("active")) {
                $("#profile-img").addClass("away");
            } else if ($("#status-busy").hasClass("active")) {
                $("#profile-img").addClass("busy");
            } else if ($("#status-offline").hasClass("active")) {
                $("#profile-img").addClass("offline");
            } else {
                $("#profile-img").removeClass();
            };

            $("#status-options").removeClass("active");
        });

        function newMessage() {
            // message = $(".message-input input").val();
            // if($.trim(message) == '') {
            //     return false;
            // }
            // $('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
            // $('.message-input input').val(null);
            // $('.contact.active .preview').html('<span>You: </span>' + message);
            // $(".messages").animate({ scrollTop: $(document).height() }, "fast");
        };

        $('.submit').click(function() {
            newMessage();
        });

        $(window).on('keydown', function(e) {
            if (e.which == 13) {
                newMessage();
                return false;
            }
        });


        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var pusher = new Pusher('dac6c375bf9938c822d9', {
                cluster: 'ap1',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                // alert(receiver_id);
                $.ajax({
                    type: "GET",
                    url: "message/" + receiver_id,
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        // scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            // scrollToBottomFunc();
                        }
                    })


                     var image = "{{ asset('images/profile/'.$profile->image_profile) }}";
                    $('<li class="sent"><img src="'+image+'"><p>' + message + '</p></li>').appendTo($('.messages ul'));
                    $('.message-input input').val(null);
                    $('.contact.active .preview').html('<span>You: </span>' + message);
                    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                }
            });
            // $(document).on('keyup', '.input-text button', function (e) {
            //     var message = $(this).val();
            //
            //     // check if enter key is pressed and message is not null also receiver is selected
            //     if (e.keyCode == 13 && message != '' && receiver_id != '') {
            //         $(this).val(''); // while pressed enter text box will be empty
            //
            //         var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            //         $.ajax({
            //             type: "post",
            //             url: "message", // need to create this post route
            //             data: datastr,
            //             cache: false,
            //             success: function (data) {
            //
            //             },
            //             error: function (jqXHR, status, err) {
            //             },
            //             complete: function () {
            //                 scrollToBottomFunc();
            //             }
            //         })
            //
            //         $('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
            //         $('.message-input input').val(null);
            //         $('.contact.active .preview').html('<span>You: </span>' + message);
            //         $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            //     }
            // });

        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }


    </script>
@endsection
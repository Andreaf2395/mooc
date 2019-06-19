<div class="navbar-fixed ">

    <nav class="nav-wrapper  green lighten-1 ">
        <div class="container">
            <a href="#!" class="brand-logo">Logo</a>
            <ul class="right hide-on-med-and-down" >
            <li ><a href="#">FAQ</a></li>
            <li ><a href="/thread">Discussion</a></li>
            <li>
            <a class="dropdown-trigger" href="#!" data-target="dropdown2" id="markasread" onclick="markNotificationAsRead('{{count(auth()->user()->unreadNotifications)}}')">Notifications
                <span class="new badge">{{count(auth()->user()->unreadNotifications)}}</span>
                </a>
                <ul id="dropdown2" class="dropdown-content">
                    <li>@forelse(auth()->user()->unreadNotifications as $notification)
                            @include('layouts.partials.notification.'.snake_case(class_basename($notification->type)))
                        @empty
                        <a href="#">No unread notifications</a>
                        @endforelse
                    </li>
                </ul>
            </li>
            <li style="font-size: 25px;">|</li>
            <li>
            <a class="dropdown-trigger" href="#!" data-target="dropdown1"> {{ Auth::user()->username }}
                <i  class="material-icons right large">arrow_drop_down</i>
                </a>
                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="/signout" id="logout"> Logout</a></li>
                </ul>
            </li>
            </ul>
        </div>
    	

    </nav>
</div>


<script>
        $(document).ready(function(){
            $(".dropdown-trigger").dropdown({ hover: false,constrainWidth: false});
        });
</script>


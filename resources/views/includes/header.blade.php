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

        function markNotificationAsRead(notificationCount) {
            if(notificationCount !=='0'){
                $.get('/markAsRead');
            }
        }


//code for realtime notification
/* 
        var es = new EventSource("/notification/push");
        es.addEventListener("message", function(e) {
          
           if(e.data != ''){
            let noti =JSON.parse(e.data)[0]; 
            console.log(noti);
            console.log('thread id is'+noti.data.thread.id);
            console.log('updated by '+noti.data.login.username);
            console.log('thread sub: '+noti.data.thread.subject);
            $('#dropdown2').append('<li><a href="/thread/'+noti.data.thread.id+'">'+ noti.data.login.username + " commented on <strong>" + noti.data.thread.subject + "</strong></a></li>");
              

           }
      
            
        }, false);
*/

</script>


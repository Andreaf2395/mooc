<div class="navbar-fixed ">

    <nav class="nav-wrapper  green lighten-1 ">
      <div class="container">
        <a href="#!" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down" >
          <li ><a href="#">FAQ</a></li>
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
        $( document ).ready(function(){
        	
            $(".dropdown-trigger").dropdown({ hover: false });
        });
</script>


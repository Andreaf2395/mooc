<div class="navbar-fixed ">

	
    <nav class="nav-wrapper  green lighten-1">
    	<a href="#!" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
          <li>
          	<a class="dropdown-trigger" href="#!" data-target="dropdown1"> {{ Auth::user()->name }}
          		<i class="material-icons right">arrow_drop_down</i>
          	</a>
          	<ul id="dropdown1" class="dropdown-content">
				<li><a href="#"> Logout</a></li>
			</ul>
		  </li>
          
        </ul>

    </nav>
</div>


<script>
        $( document ).ready(function(){
        	
        		
        
            $(".dropdown-trigger").dropdown({ hover: false });
        });
</script>


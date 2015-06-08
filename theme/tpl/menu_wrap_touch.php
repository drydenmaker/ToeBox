<div class="nav-container container-fluid">
    <div class="row">	
    <div class="col-sm-9 tb-nav navbar-menu">
        <div class="navbar-header">
        		 <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target="#tb-navbar-collapse">
        		   <span class="sr-only">Toggle navigation</span>
        		   <span class="icon-bar"></span>
        		   <span class="icon-bar"></span>
        		   <span class="icon-bar"></span>
        		 </button>
        </div>
        <div class="collapse navbar-collapse" id="tb-navbar-collapse">
    		<ul class="nav navbar-nav">
    			%3$s
    		</ul>
    	</div>
	</div>
    	
    <div class="hidden-xs col-sm-3 tb-nav-text">
        <div class="tb-search search-form form-inline">
         <form role="search" >
                    <div class="form-group">
                		<label class="screen-reader-text sr-only" for="s"><?php print __( 'Search for:', 'label', 'toebox-basic') ?></label>
                		<input type="search" class="search-field form-control" placeholder="<?php esc_attr_x( 'Search &hellip;', 'placeholder', 'flat-bootstrap' ) ?>" 
                		                value="<?php print esc_attr( get_search_query() ) ?>" name="s">
                    </div>
                        <button type="submit" class="search-submit btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </form>
        </div>
	</div>
		
  </div>	
</div>
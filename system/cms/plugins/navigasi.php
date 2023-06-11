<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Global Plugin
 *
 * Make global constants available as tags
 * 
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Plugins
 */
class Plugin_Navigasi extends Plugin
{

	/**
	 * Load a constant
	 *
	 * Magic method to get a constant or global var
	 *
	 * @return	null|string
	 */
	function nav()
	{
		$nav='
<div style=" position: fixed;" class="navbar navbar-fixed-top">
             <div class="navbar">
              <div class="navbar-inner" style="height:70px;width:1000px;margin-right: auto;margin-left: auto;margin-top:0px;   	-moz-border-radius: 0 0 5px 5px;     -webkit-border-bottom-left-radius: 5px;     -webkit-border-bottom-right-radius: 5px;     border-radius: 0 0 5px 5px; -moz-box-shadow: 0 0 15px #333; -webkit-box-shadow: 0 0 15px#333; box-shadow: 0 0 15px #333;">
                <div class="container" style="width:1000px">
                  <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a href="'.base_url().'" class="brand" style="  padding: 20px 27px;"><img src="logo.png"></a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav"> 
                      <li class="divider-vertical" style="height:70px"></li>
                      <li style="height:70px">
                        <center><i class="icon-tasks" style="margin-top:10px"></i></center>
                        <a href="#" style="padding:0px 10px;letter-spacing:3px;text-shadow: 0 2px 0 #FFFFFF;">FEATURES</a></li>
                      <li class="divider-vertical" style="height:70px"></li>
                      <li style="height:70px"> 
                      <center><i class="icon-flag" style="margin-top:10px"></i></center>
                        <a href="#" style="padding:0px 10px;letter-spacing:3px;text-shadow: 0 2px 0 #FFFFFF;">GET STARTED</a>
                      </li>
                      <li class="divider-vertical" style="height:70px"></li>
                       <li style="height:70px"> 
                      <center><i class="icon-bullhorn" style="margin-top:10px"></i></center>
                        <a href="#" style="padding:0px 10px;letter-spacing:3px;text-shadow: 0 2px 0 #FFFFFF;">NEWS</a>
                      </li>
                       
                    </ul>
                         
                  </div>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                     
                   
                    <ul class="nav">
                        <li class="divider-vertical" style="height:70px"></li>
                      <li style="margin-top:15px;text-align:center"> '.form_open('twitter/analisa/9/action',' class="navbar-search pull-left"').'
                      <input type="text" placeholder="Search" name="cari" class="search-query span2">
                    '.form_close().'</li>
                      <li class="divider-vertical" style="height:70px"></li>
                      <li class="dropdown" style="margin-top:15px">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="text-shadow: 0 2px 0 #FFFFFF;">MyOpini <b class="caret"></b></a>
                        <ul class="dropdown-menu"> 
			   ';
			  
                          $res=$this->db->get('category')->result() ;
			  if(!empty($res)){
                          foreach($res as $dat => $val){ 
                         $nav.='<li><a href="'.base_url().'twitter/index/'.$val->id.'">'.$val->name.'</a></li>';
                          } 
                         $nav.= ' 
                          <li class="divider"></li>';
			  if(!empty($this->current_user->username)){
                       $nav.='
		       <li><a href="{{ url:site uri=\'edit-profile\' }}">{{ helper:lang line="edit_profile_label" }}</a></li>
		       <li><a href="{{ url:site uri=\'users/logout\' }}">{{ helper:lang line="logout_label" }}</a>
                            </li>
			    ';
			  }else{
			$nav.='<li><a href="'.base_url().'users/login'.'">Login</a></li>';
			}}
			$nav.=' </ul>
                      </li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
            </div>';
	   
	    return $nav;
	}
	
	public function subnav(){
		
	}

}
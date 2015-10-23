jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_modal_tab = $('.cd-switcher'),
        $tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$main_nav = $('.main-nav');
        
  	var $form_edit_modal = $('.cd-edit-modal'),
		$form_edit_login = $form_edit_modal.find('#cd-login'),
		$form_edit_signup = $form_edit_modal.find('#cd-signup'),
		$form_modal_edit_tab = $('.cd-switcher'),
        $tab_edit_login = $form_modal_edit_tab.children('li').eq(0).children('a'),
		$tab_edit_signup = $form_modal_edit_tab.children('li').eq(1).children('a'),
		$edit_nav = $('.edit-nav');

	//open modal
	$main_nav.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
            
            //EDIT MODAL
            $form_edit_modal.removeClass('is-visible');
	    }
    });

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}
    
    
    //EDIT MODAL
    //
    
    //open modal
	$edit_nav.on('click', function(event){

		if( $(event.target).is($edit_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$edit_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_edit_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : edit_selected();
		}

	});
    
   	//close modal
	$('.cd-edit-modal').on('click', function(event){
		if( $(event.target).is($form_edit_modal) || $(event.target).is('.cd-close-form') ) {
			$form_edit_modal.removeClass('is-visible');
		}	
	});
    
	function edit_selected(){
		$form_edit_login.addClass('is-selected');
		$form_edit_signup.removeClass('is-selected');
		$tab_edit_login.addClass('selected');
		$tab_edit_signup.removeClass('selected');
	}
    
});
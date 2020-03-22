<?php

	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(220,150);
		add_image_size('show-image', 580, 380, false);

	}

	add_action("admin_init", "show_manager_add_meta");

	function show_manager_add_meta() {
		add_meta_box('show-meta', 'Show Options', 'show_manager_meta_options', 'tribe_events', 'normal', 'high');
		add_meta_box('project-meta', 'Class Info', 'project_meta_options', 'project', 'normal', 'high');
		add_meta_box('profile-meta', 'Site Info', 'profile_meta_options', 'profile', 'normal', 'high');
	}

	function show_manager_meta_options() {
		global $post;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		
		$custom = get_post_meta($post->ID);

        if(isset($custom["writer"])){
                    $writer= $custom["writer"][0];
            }
        if(isset($custom["director"])){
        			$director= $custom["director"][0];
        	}
        if(isset($custom["website"])){
                    $website= $custom["website"][0];
            }
        if(isset($custom["price"])){
                    $price= $custom["price"][0];
            }          
      	if(isset($custom["info"])){
                    $info= $custom["info"][0];
         } 

        if(isset($custom["month"])){
                    $month= $custom["month"][0];
            } else {
            	$month= "";
            }
        if(isset($custom["dates"])){
                    $dates= $custom["dates"][0];
            }
        if(isset($custom["year"])){
                    $year= $custom["year"][0];
            }

        if(isset($custom["month2"])){
                    $month2= $custom["month2"][0];
            } else {
            	$month2= "";
            }
        if(isset($custom["dates2"])){
                    $dates2= $custom["dates2"][0];
            }
        if(isset($custom["year2"])){
                    $year2= $custom["year2"][0];
            }
 

   ?>

		<style type="text/css">
			<?php include('css/show-manager.css'); ?>
		</style>

		<div class="show_manager_extras">
		<div><label>Writer:</label><input name="writer" value="<?php echo isset($writer) ? $writer : ''; ?>" /></div>
		<div><label>Director:</label><input name="director" value="<?php echo isset($director) ? $director : ''; ?>" /></div>
		<div><label>Website:</label><input name="website" value="<?php echo isset($website) ? $website : ''; ?>" /></div>
		<div><label>Cost:</label><input name="price" value="<?php echo isset($price) ? $price : '$'; ?>" /></div>

		<div><label class="bold">First Date</label></div><br/>

		<div><label>Month:</label><select name="month"><?php
		for($m=0;$m<13;$m++) {
			$months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			?><option value="<?php echo $months[$m] ?>" <?php selected($month, $months[$m]); ?>><?php echo $months[$m] ?></option> 
			<?php
			}
			?>
		</select><span class="req"> *</span>
		</div>
		<div><label>Date:</label><input id="dates" name="dates" value="<?php echo isset($dates) ? $dates : ''; ?>" /><span class="req"> *</span></div>
		<div><label>Year:</label><input id="year" name="year" value="<?php echo isset($year) ? $year : ''; ?>" /><span class="req"> *</span></div>

		<div><label  class="bold">Second Date</label></div><br/>

		<div><label>Month:</label><select name="month2"><?php
		for($mt=0;$mt<13;$mt++) {
			$months2 = array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			?><option value="<?php echo $months2[$mt] ?>" <?php selected($month2, $months2[$mt]); ?>><?php echo $months2[$mt] ?></option> 
			<?php
			}
			?>
		</select>
		</div>
		<div><label>Date:</label><input id="dates2" name="dates2" value="<?php echo isset($dates2) ? $dates2 : ''; ?>" /></div>
		<div><label>Year:</label><input id="year2" name="year2" value="<?php echo isset($year2) ? $year2 : ''; ?>" /></div><br/>


		<div><label>Additional Notes:</label><br><textarea name="info" rows="4" cols="50"><?php echo isset($info) ? $info : ''; ?></textarea></div>
		</div>
<?php
		}


function project_meta_options() {
		global $post;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		
		$custom = get_post_meta($post->ID);

		if(isset($custom["teacher"])){
                  $teacher = $custom["teacher"][0];
        } else {
        	$teacher = null;
        }

        if(isset($custom["director"])){
                  $director = $custom["director"][0];
        } else {
        	$director = null;
        }
        if(isset($custom["page_id"])){
                    $page_id= $custom["page_id"][0];
                    $link= $custom["link"][0];
        } else {
        	$page_id = null;
        	$link = null;
        }
        if(isset($custom["ticket"])){
                    $ticket= $custom["ticket"][0];
        }
        if(isset($custom["price"])){
                    $price= $custom["price"][0];
        }          

        if(isset($custom["month"])){
                    $month= $custom["month"][0];
            } else {
            	$month= "";
            }
        if(isset($custom["dates"])){
                    $dates= $custom["dates"][0];
            }
        if(isset($custom["year"])){
                    $year= $custom["year"][0];
            }

        if(isset($custom["month2"])){
                    $month2= $custom["month2"][0];
            } else {
            	$month2= "";
            }
        if(isset($custom["dates2"])){
                    $dates2= $custom["dates2"][0];
            }
        if(isset($custom["year2"])){
                    $year2= $custom["year2"][0];
            }
        if(isset($custom["info"])){
                    $info= $custom["info"][0];
         } 
 

   ?>

		<style type="text/css">
			<?php include('css/show-manager.css'); ?>
		</style>

		<div class="show_manager_extras">


		<div><label>Teacher:</label><input name="teacher" value="<?php echo isset($teacher) ? $teacher : ''; ?>" /></div>

		<div><label>Director:</label><input name="director" value="<?php echo isset($director) ? $director : ''; ?>" /></div>

	<?php	

	$args = array(
        'numberposts'      => -1,
        'category'         => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => array(),
        'exclude'          => array(),
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'project',
        'suppress_filters' => true,
    );
	$pages = get_posts($args); 

   		?>
		<div><label>Select Sign Up Page:</label><select name="page_id"> 
		    <option selected="selected" value=""><?php echo esc_attr( __( 'Select page' ) ); ?>
		    </option> 
		    <?php
		    if(!empty($pages)):
		        foreach ( $pages as $page ) { ?>
		        	<option value="<?php echo $page->ID ?>" <?php selected( $page_id, $page->ID ); ?>><?php echo $page->post_title ?></option> 
		     	<?php
		        }
		    endif;
		    ?>
		    					
		</select>
		</div>	

		<div><input name="link" type="hidden" value="<?php echo isset($page_id) ? get_permalink($page_id) : ''; ?>" Placeholder="Please select a page and click update"/></div>

		<div><label>Ticket Link:</label><input name="ticket" value="<?php echo isset($ticket) ? $ticket : ''; ?>" Placeholder="Ticket link from 3rd Party site"/></div>

		<div><label>Cost:</label><input name="price" value="<?php echo isset($price) ? $price : '$'; ?>" /></div>

		<div><label class="bold">Start Date</label></div><br/>

		<div><label>Month:</label><select name="month"><?php
		for($m=0;$m<13;$m++) {
			$months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			?><option value="<?php echo $months[$m] ?>" <?php selected($month, $months[$m]); ?>><?php echo $months[$m] ?></option> 
			<?php
			}
			?>
		</select><span class="req"> *</span>
		</div>
		<div><label>Date:</label><input id="dates" name="dates" value="<?php echo isset($dates) ? $dates : ''; ?>" /><span class="req"> *</span></div>
		<div><label>Year:</label><input id="year" name="year" value="<?php echo isset($year) ? $year : ''; ?>" /><span class="req"> *</span></div>

		<div><label  class="bold">End Date</label></div><br/>

		<div><label>Month:</label><select name="month2"><?php
		for($mt=0;$mt<13;$mt++) {
			$months2 = array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			?><option value="<?php echo $months2[$mt] ?>" <?php selected($month2, $months2[$mt]); ?>><?php echo $months2[$mt] ?></option> 
			<?php
			}
			?>
		</select>
		</div>
		<div><label>Date:</label><input id="dates2" name="dates2" value="<?php echo isset($dates2) ? $dates2 : ''; ?>" /></div>
		<div><label>Year:</label><input id="year2" name="year2" value="<?php echo isset($year2) ? $year2 : ''; ?>" /></div><br/>

		<div><label>Additional Notes:</label><br><textarea name="info" rows="4" cols="50"><?php echo isset($info) ? $info : ''; ?></textarea></div>
		</div>
<?php
		}



function profile_meta_options() {
		global $post;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		
		$custom = get_post_meta($post->ID);

		if(isset($custom["website"])){
                  $website = $custom["website"][0];
        }

		?>

        <style type="text/css">
		<?php include('css/show-manager.css'); ?>
		</style>

		<div class="show_manager_extras">

			<div><label>Website:</label><input name="website" value="<?php echo isset($website) ? $website : ''; ?>" /></div>

		</div>


<?php

}




add_action('save_post', 'show_manager_save_extras');

		function show_manager_save_extras( $post_id ){
			global $post;
		
			if ( defined ( 'DOING_AUTOSAVE' )  && DOING_AUTOSAVE ) {
				//do not remove this
				return;
				} else {
				if ( isset($_POST['teacher']) ) {
					update_post_meta($post_id, "teacher", $_POST["teacher"]);
				}
				if ( isset($_POST['writer']) ) {
					update_post_meta($post_id, "writer", $_POST["writer"]);
				}
				if ( isset($_POST['director']) ) {
					update_post_meta($post_id, "director", $_POST["director"]);
				}
				if ( isset($_POST['ticket']) ) {
					update_post_meta($post_id, "ticket", $_POST["ticket"]);
				}
				if ( isset($_POST['link']) ) {
					update_post_meta($post_id, "link", $_POST["link"]);
				}
				if ( isset($_POST['page_id']) ) {
					update_post_meta($post_id, "page_id", $_POST["page_id"]);
				}
				if ( isset($_POST['website']) ) {
					update_post_meta($post_id, "website", $_POST["website"]);
				}
				if ( isset($_POST['price']) ) {
					update_post_meta($post_id, "price", $_POST["price"]);
				}
				if ( isset($_POST['info']) ) {
					update_post_meta($post_id, "info", $_POST["info"]);
				}
				if ( isset($_POST['month']) ) {
					update_post_meta($post_id, "month", $_POST["month"]);
				}
				if ( isset($_POST['dates']) ) {
					update_post_meta($post_id, "dates", $_POST["dates"]);
				}
				if ( isset($_POST['year']) ) {
					update_post_meta($post_id, "year", $_POST["year"]);
				}

				if ( isset($_POST['month2']) ) {
					update_post_meta($post_id, "month2", $_POST["month2"]);
				}
				if ( isset($_POST['dates2']) ) {
					update_post_meta($post_id, "dates2", $_POST["dates2"]);
				}
				if ( isset($_POST['year2']) ) {
					update_post_meta($post_id, "year2", $_POST["year2"]);
				}

		}

}

				
?>
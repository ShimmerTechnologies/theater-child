<?php

function audition_manager_register() {
	
	//Arguments to create post type
	$labels = array(
		'label'	=> __('Auditions'),
		'singular_label' => __('Auditions'),
		'public' => true,
		'audition_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
		'rewrite' => array('slug' => 'auditions', 'with_front' => true),	
	);

	//Register type and custom taxonomy for type
	register_post_type('auditions', $labels );

		$args = array(
		'hierarchical'          => true,
		'labels'                => 'Audition Types',
		'singular_label'		=> 'Audition Type',
		'query_var'             => true,
		'rewrite'               => true,
		'slug' 					=> 'audition-type',
		'register_meta_box_cb'  => 'audition_manager_add_meta',
	);

	register_taxonomy( 'audition-type', 'auditions', $args );
}

add_action('init', 'audition_manager_register');

	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(220,150);
		add_image_size('audition-image', 580, 380, true);

	}

	add_action("admin_init", "audition_manager_add_meta");

	function audition_manager_add_meta() {
		add_meta_box('audition-meta', 'Audition Options', 'audition_manager_meta_options', 'auditions', 'normal', 'high');
	}

	function audition_manager_meta_options() {
		global $post;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		
		$custom = get_post_meta($post->ID);

        if(isset($custom["writer"])){
                    $writer= $custom["writer"][0];
            }
        if(isset($custom["director"])){
        			$director= $custom["director"][0];
        	}         
        if(isset($custom["month"])){
                    $month= $custom["month"][0];
            } else {
            	$month= "";
            }
        if(isset($custom["dates"])){
                    $dates= $custom["dates"][0];
            } else {
            	$dates = null;
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
            } else {
            	$dates2 = null;
            }
        if(isset($custom["year2"])){
                    $year2= $custom["year2"][0];
            }
		if(isset($custom["time"])){
                    $time= $custom["time"][0];
            } else {
            	$time = "";
          }
        if(isset($custom["timeEnd"])){
                    $timeEnd = $custom["timeEnd"][0];
            } else {
            	$timeEnd = "";
          }
        if(isset($custom["ampm"])){
                    $ampm= $custom["ampm"][0];
         } else {
         	$ampm = "";
         } 
         if(isset($custom["ampmEnd"])){
                    $ampmEnd= $custom["ampmEnd"][0];
         } else {
         	$ampmEnd = "";
         } 
         if(isset($custom["time2"])){
                    $time2= $custom["time2"][0];
            } else {
            	$time2 = "";
         }
         if(isset($custom["timeEnd2"])){
                    $timeEnd2 = $custom["timeEnd2"][0];
            } else {
            	$timeEnd2 = "";
          }
        if(isset($custom["ampm2"])){
                    $ampm2 = $custom["ampm2"][0];
         } else {
         	$ampm2 = "";
         } 
         if(isset($custom["ampmEnd2"])){
                    $ampmEnd2 = $custom["ampmEnd2"][0];
         } else {
         	$ampmEnd2 = "";
         } 
         if(isset($custom["moredates"])){
                    $moredates= $custom["moredates"][0];
         }  
         if(isset($custom["address"])){
                    $address= $custom["address"][0];
         }
        if(isset($custom["city"])){
                    $city= $custom["city"][0];
         }
        if(isset($custom["state"])){
                    $state= $custom["state"][0];
        }
        if(isset($custom["zip"])){
                    $zip= $custom["zip"][0];
         }
          if(isset($custom["moreinfo"])){
                    $moreinfo= $custom["moreinfo"][0];
         }
         if(isset($custom["contact"])){
                    $contact= $custom["contact"][0];
         } 
         if(isset($custom["email"])){
                    $email= $custom["email"][0];
         }  
         if(isset($custom["phone"])){
                    $phone = $custom["phone"][0];
         }  

        if(isset($custom["page_id"])){
                    $page_id= $custom["page_id"][0];
        } else {
        	$page_id = null;
        } 

        if(isset($custom["synopsis"])){

                    $synopsis= $custom["synopsis"][0];

        }
        if(isset($custom["link"])){
                    $link= $custom["link"][0];
        } else {
        	$link = null;
        }
        if(isset($custom["extlink"])){
                    $extlink= $custom["extlink"][0];
        }


   ?>

		<style type="text/css">
			<?php include('css/audition-manager.css'); ?>
		</style>

		<div class="audition_manager_extras">
		<div><label>Writer:</label><input name="writer" value="<?php echo isset($writer) ? $writer : ''; ?>" /></div>
		<div><label>Director:</label><input name="director" value="<?php echo isset($director) ? $director : ''; ?>" /></div>

		<div><label class="bold">First Audition Date</label></div><br/>

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

		<div><label>Start Time:</label>
		<select name="time"><?php
				for($hours=1; $hours<=12; $hours++){
				for($mins=0; $mins<60; $mins+=30){
				$selected = $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT);
				?>	<option value="<?php echo $selected ?>" <?php selected($time, $selected); ?>> <?php echo $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) ?></option>


				<?php
				}
				}
				?>
		</select>
		

		<select name="ampm">
			<option value="am" <?php selected($ampm, 'am'); ?> >AM</option>
			<option value="pm" <?php selected($ampm, 'pm'); ?> >PM</option>
		</select>

		</div>

		<div><label>End Time:</label>
		<select name="timeEnd"><?php
				for($hours=1; $hours<=12; $hours++){
				for($mins=0; $mins<60; $mins+=30){
				$selected = $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT);
				?>	<option value="<?php echo $selected ?>" <?php selected($timeEnd, $selected); ?>> <?php echo $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) ?></option>


				<?php
				}
				}
				?>
		</select>
		

		<select name="ampmEnd">
			<option value="am" <?php selected($ampmEnd, 'am'); ?> >AM</option>
			<option value="pm" <?php selected($ampmEnd, 'pm'); ?> >PM</option>
		</select>

		</div>


		<div><label  class="bold">Second Audition Date</label></div><br/>

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


		<div><label >Start Time:</label>
		<select name="time2"><?php
				for($hours=1; $hours<=12; $hours++){
				for($mins=0; $mins<60; $mins+=30){
				$selected = $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT);
				?>	<option value="<?php echo $selected ?>" <?php selected($time2, $selected); ?>> <?php echo $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) ?></option>


				<?php
				}
				}
				?>
		</select>
		

		<select name="ampm2">
			<option value="am" <?php selected($ampm2, 'am'); ?> >AM</option>
			<option value="pm" <?php selected($ampm2, 'pm'); ?> >PM</option>
		</select>

		</div>

		<div><label >End Time:</label>
		<select name="timeEnd2"><?php
				for($hours=1; $hours<=12; $hours++){
				for($mins=0; $mins<60; $mins+=30){
				$selected = $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT);
				?>	<option value="<?php echo $selected ?>" <?php selected($timeEnd2, $selected); ?>> <?php echo $hours . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) ?></option>


				<?php
				}
				}
				?>
		</select>
		

		<select name="ampmEnd2">
			<option value="am" <?php selected($ampmEnd2, 'am'); ?> >AM</option>
			<option value="pm" <?php selected($ampmEnd2, 'pm'); ?> >PM</option>
		</select>

		</div>

		<div><label class="bold">More Dates:</label></div><br/>

		<div><textarea name="moredates" rows="4" cols="100"><?php echo isset($moredates) ? $moredates : ''; ?></textarea></div>

		<div><label class="bold">Contact Name:</label><input name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>" /></div>

		<div><label class="bold">Contact Email:</label><input name="email" value="<?php echo isset($email) ? $email : ''; ?>" /></div>
		<div><label class="bold">Contact Phone:</label><input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" /></div>

		<div><label class="bold">Location</label></div><br/>

		<div><label>Address:</label><input name="address" value="<?php echo isset($address) ? $address : '1249 Main Street'; ?>" /></div>
		<div><label>City:</label><input name="city" value="<?php echo isset($city) ? $city : 'West Warwick'; ?>" /></div>
		<div><label>State:</label><input name="state" value="<?php echo isset($state) ? $state : 'RI'; ?>" /></div>
		<div><label>Zip:</label><input name="zip" value="<?php echo isset($zip) ? $zip : '02893'; ?>" /></div>		
		<div><label>Notes:</label><input name="moreinfo" value="<?php echo isset($moreinfo) ? $moreinfo : ''; ?>" /></div>

		<div><label class="bold">Synopsis:</label></div><br/>

		<div><textarea name="synopsis" rows="8" cols="100"><?php echo isset($synopsis) ? $synopsis : ''; ?></textarea></div>

		<?php

		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'auditions',
			'post_status' => 'publish'
		);

		$pages = get_pages($args);

   		?>
		<div><label class="bold">Select Sign Up Page:</label><select name="page_id"> 
		    <option selected="selected" value=""><?php echo esc_attr( __( 'Select page' ) ); ?>
		    </option> 
		    <?php
		      
		        foreach ( $pages as $page ) { ?>
		        	<option value="<?php echo $page->ID ?>" <?php selected( $page_id, $page->ID ); ?>><?php echo $page->post_title ?></option> 
		     	<?php
		        }
		    ?>
		    					
		</select>
		</div>	

		<div><input name="link" type="hidden" value="<?php echo isset($page_id) && !empty($page_id) && $page_id != null ? get_permalink($page_id) : ''; ?>" Placeholder="Please select a page and click update"/></div>

		<div><input name="extlink" type="text" value="<?php echo isset($extlink) ? $extlink : ''; ?>" Placeholder="Please enter external signup link here"/></div>



<?php
		}

		add_action('save_post', 'audition_manager_save_extras');

		function audition_manager_save_extras( $post_id ){
			global $post;
		
			if ( defined ( 'DOING_AUTOSAVE' )  && DOING_AUTOSAVE ) {
				//do not remove this
				return;
				} else {
				if ( isset($_POST['writer']) ) {
					update_post_meta($post_id, "writer", $_POST["writer"]);
				}
				if ( isset($_POST['director']) ) {
					update_post_meta($post_id, "director", $_POST["director"]);
				}
				if ( isset($_POST['address']) ) {
					update_post_meta($post_id, "address", $_POST["address"]);
				}
				if ( isset($_POST['city']) ) {
					update_post_meta($post_id, "city", $_POST["city"]);
				}
				if ( isset($_POST['state']) ) {
					update_post_meta($post_id, "state", $_POST["state"]);
				}
				if ( isset($_POST['zip']) ) {
					update_post_meta($post_id, "zip", $_POST["zip"]);
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

				if ( isset($_POST['time']) ) {
					update_post_meta($post_id, "time", $_POST["time"]);
				}
				if ( isset($_POST['ampm']) ) {
					update_post_meta($post_id, "ampm", $_POST["ampm"]);
				}
				if ( isset($_POST['timeEnd']) ) {
					update_post_meta($post_id, "timeEnd", $_POST["timeEnd"]);
				}
				if ( isset($_POST['ampmEnd']) ) {
					update_post_meta($post_id, "ampmEnd", $_POST["ampmEnd"]);
				}

				if ( isset($_POST['time2']) ) {
					update_post_meta($post_id, "time2", $_POST["time2"]);
				}
				if ( isset($_POST['ampm2']) ) {
					update_post_meta($post_id, "ampm2", $_POST["ampm2"]);
				}
				if ( isset($_POST['timeEnd2']) ) {
					update_post_meta($post_id, "timeEnd2", $_POST["timeEnd2"]);
				}
				if ( isset($_POST['ampmEnd2']) ) {
					update_post_meta($post_id, "ampmEnd2", $_POST["ampmEnd2"]);
				}
				if ( isset($_POST['moreinfo']) ) {
					update_post_meta($post_id, "moreinfo", $_POST["moreinfo"]);
				}

				if ( isset($_POST['email']) ) {
					update_post_meta($post_id, "email", $_POST["email"]);
				}

				if ( isset($_POST['phone']) ) {
					update_post_meta($post_id, "phone", $_POST["phone"]);
				}
				if ( isset($_POST['page_id']) ) {
					update_post_meta($post_id, "page_id", $_POST["page_id"]);
				}
				if ( isset($_POST['contact']) ) {
					update_post_meta($post_id, "contact", $_POST["contact"]);
				}
				if ( isset($_POST['synopsis']) ) {
					update_post_meta($post_id, "synopsis", $_POST["synopsis"]);
				}
				if ( isset($_POST['link']) ) {
					update_post_meta($post_id, "link", $_POST["link"]);
				}
				if ( isset($_POST['extlink']) ) {
					update_post_meta($post_id, "extlink", $_POST["extlink"]);
				}
				if ( isset($_POST['moredates']) ) {
					update_post_meta($post_id, "moredates", $_POST["moredates"]);
				}


			}

		}

		add_filter("manage_edit-auditions_columns", "audition_manager_edit_columns");

		function audition_manager_edit_columns($columns) {
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Title",
				"created" => "Created Date",
				"description" => "Description",				
				);
			return $columns;
		}

		add_action("manage_auditions_posts_custom_column", "audition_manager_custom_columns");

		function audition_manager_custom_columns($column){
			global $post;
			$custom = get_post_custom();
			switch ($column)
			{

				case "created":
					$created = get_the_date();
					echo $created;
					break;
				case "description":
					the_excerpt();
					break;
			}
		}


			add_filter( 'manage_edit-auditions_sortable_columns', 'audition_sortable_columns' );

			function audition_sortable_columns( $columns ) {

				$columns['created'] = 'created';
				
				return $columns;
			}

			add_action( 'pre_get_posts', 'auditions_orderby' );
			function auditions_orderby( $query ) {
			    if( ! is_admin() )
			        return;
			 
			    $orderby = $query->get( 'created');
			 
			    if( 'slice' == $orderby ) {
			        $query->set('meta_key','created');
			        $query->set('orderby','meta_value_num');
			    }

			}
?>
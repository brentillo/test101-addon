<?php

function test101_imageflip ($atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => '', // small, medium, large, x-large
		'textcolor' => '',
		'newwindow' => 'false'
	), $atts ) );
	$output = '<div id="flippanel" class="test101-flip-container hidepanelonload">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('test101-imageflip', 'test101_imageflip');
function test101_imageflip_block ($atts, $content = null ) {
	extract( shortcode_atts( array(
		'imgsrc' => '', 
		'name' => '',
		'codename' => '',
	), $atts ) );
	
	if($codename != '') {
		$codename = '<span>code name:</span> '.$codename.'';
	}
	
	$output = '<div class="test101-flip-blk" ontouchstart="this.classList.toggle(\'hover\');">
				<div class="flip-blk-nsyd" class="shadow">
				  <div class="front face">
					<div class="content-blk">
						<div class="img-blk">
						<img src="'.$imgsrc.'" alt="'.$name.'"/>
						</div>
						<div class="dtls-blk">
						<h2>'.$name.'</h2>
						'.$codename.'
						</div>
					</div>
				  </div>
				  <div class="back face center">
				  	<div class="content-blk">
						<div class="rv-meminfopnl">
							<div class="rv-nameblk"><h3>'.$name.'</h3></div>
							'.do_shortcode($content).'
						</div>
					</div>
				  </div>
				</div>
			</div>';
	return $output;
}
add_shortcode('test101-imageflip-block', 'test101_imageflip_block');

function test101_columns4panel ($atts, $content = null ) {
	extract( shortcode_atts( array(
		'textalign' => '', 
	), $atts ) );
	if($textalign != ''){
		$textalign = ' align-' . $textalign;
	}
	$output = '<div class="columns4panel'.$textalign.'">'.do_shortcode($content).'</div><div class="clear"></div>';
	return $output;
}
add_shortcode('test101-columns4panel', 'test101_columns4panel');
function test101_columns3panel ($atts, $content = null ) {
	extract( shortcode_atts( array(
		'textalign' => '', 
	), $atts ) );
	if($textalign != ''){
		$textalign = ' align-' . $textalign;
	}
	$output = '<div class="columns3panel'.$textalign.'">'.do_shortcode($content).'</div><div class="clear"></div>';
	return $output;
}
add_shortcode('test101-columns3panel', 'test101_columns3panel');

function test101_columns4blk ($atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	$output = '<div>'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('test101-columns4blk', 'test101_columns4blk');


function test101adsense_hook() { 
  echo '<div class="adsense-footblk"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- test101 ads -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5447099673330897"
     data-ad-slot="1758430166"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>';
}
//add_action( 'fusion_after_content', 'test101adsense_hook', 1000);

function test101_searchform ( $form )  {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div class="test101-searchform"><input type="text" value="' . get_search_query() . '" name="s" id="s" />
<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" /></div>
</form>';
return $form;

}
add_shortcode('test101-searchform', 'test101_searchform');


// DOWNLOAD FREE 
function test101_subscriberdownload  ($atts, $content = null ) {
	extract( shortcode_atts( array(
		'filelink' => '', 
	), $atts ) );
	$output = '';
	$url=$_SERVER['REQUEST_URI'];
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	$email = str_replace('%40','@',$query['email']);
	//$name = str_replace('%20',' ',$query['name']);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$output .= '<div class="downloadmsg-after"><div>You have downloaded the document</div></div>';
	}else{
	
	
	if(!empty($email)){
		$output .= '<form class="frm-download" action="" method="post">
			<p class="msg-downloaddoc">Download our latest article for FREE!<br /></p>
			<input type="submit" class="btn-downloaddocument"  value="" onclick="window.open(\''.$filelink.'\')" />
			<input type="hidden" name="download_doc" value="1" />
		</form>';
		
		if(isset($_POST['download_doc']))
		{
			$to      = 'rohnvenson@gmail.com';
			$subject = 'latest article downloaded by ';
			$message = 'your book is download by:\n\n
						email:' .$email.'\n
						';
//						name: '.$name.'\n\n\n
			$headers = 'From: admin@test101.com' . "\r\n" .
				'Reply-To: admin@test101.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		
			mail($to, $subject, $message, $headers);
		
		}
	}
	}

	
	return $output;
}
add_shortcode('test101-subscriberdownload', 'test101_subscriberdownload');



function remove_page_from_query_string($query_string)
{ 
	if(isset($query_string['name'])){
    if ($query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        // 'page' in the query_string looks like '/2', so i'm spliting it out
        list($delim, $page_index) = explode('/', $query_string['page']);
        $query_string['paged'] = $page_index;
    }      
	}
    return $query_string;
}
// I will kill you if you remove this. I died two days for this line 
add_filter('request', 'remove_page_from_query_string');

// following are code adapted from Custom Post Type Category Pagination Fix by jdantzer
function fix_category_pagination($qs){
	if(isset($qs['category_name']) && isset($qs['paged'])){
		$qs['post_type'] = get_post_types($args = array(
			'public'   => true,
			'_builtin' => false
		));
		array_push($qs['post_type'],'post');
	}
	return $qs;
}
add_filter('request', 'fix_category_pagination');


//****** PROFILE ADDITIONAL FIELS (START)
function fb_add_custom_user_profile_fields( $user ) {
    
	wp_enqueue_media();
	?>
	<h3><?php _e('TEST101 Author Information', 'test101'); ?></h3>
	
	<table class="form-table">
		<tr>
			<th>
				<label for="address"><?php _e('Photo', 'test101'); ?>
			</label></th>
			<td>
				<input type="text" name="test101authorphoto" id="test101authorphoto" value="<?php echo esc_attr( get_the_author_meta( 'test101authorphoto', $user->ID ) ); ?>" class="regular-text" /><input type="button" class="btn-uploadmedia" value="upload" /><br />
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php _e('Extended Name', 'test101'); ?>
			</label></th>
			<td>
				<input type="text" name="test101extendedname" id="test101extendedname" value="<?php echo esc_attr( get_the_author_meta( 'test101extendedname', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php _e('Title', 'test101'); ?>
			</label></th>
			<td>
				<input type="text" name="test101authortitle" id="test101authortitle" value="<?php echo esc_attr( get_the_author_meta( 'test101authortitle', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php _e('Information', 'test101'); ?>
			</label></th>
			<td>
				<textarea name="test101authorinfo" id="test101authorinfo" cols="30" rows="5" ><?php echo esc_attr( get_the_author_meta( 'test101authorinfo', $user->ID ) ); ?></textarea><br />
			</td>
		</tr>
        
	</table>
    <script type="text/javascript">
	jQuery(document).ready(function() {
	var _custom_media = true;
	function showMediaUploader(tbMedia)
	{
		
		var custom_uploader;
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			jQuery(tbMedia).val(attachment.url);
		});
		custom_uploader.open();
	}
jQuery(".btn-uploadmedia").live('click', function(e) {
			e.preventDefault();
			var tbID = '#'+jQuery(this).prev('input[type=text]').attr('id');
			showMediaUploader(tbID);
		});
});

	</script>
<?php }

function fb_save_custom_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	
	update_user_meta( $user_id, 'test101authorphoto', $_POST['test101authorphoto'] );
	update_user_meta( $user_id, 'test101extendedname', $_POST['test101extendedname'] );
	update_user_meta( $user_id, 'test101authortitle', $_POST['test101authortitle'] );
	update_user_meta( $user_id, 'test101authorinfo', $_POST['test101authorinfo'] );
}


add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );


//****** PROFILE ADDITIONAL FIELS (START)

if ( ! function_exists( 'test101_render_author_info' ) ) {
	function test101_render_author_info() {
		global $social_icons;

		// Initialize needed variables
		$author             = get_user_by( 'id', get_query_var( 'author' ) );
		$author_id          = $author->ID;
		$author_name        = get_the_author_meta( 'display_name', $author_id );
		$author_avatar      = get_avatar( get_the_author_meta( 'email', $author_id ), '82' );
		$author_custom      = get_the_author_meta( 'author_custom', $author_id );

		$author_test101authorphoto = get_the_author_meta( 'test101authorphoto', $author_id );
		$author_test101extendedname = get_the_author_meta( 'test101extendedname', $author_id );
		$author_test101authortitle = get_the_author_meta( 'test101authortitle', $author_id );
		$author_test101authorinfo = get_the_author_meta( 'test101authorinfo', $author_id );

		// If no description was added by user, add some default text and stats
		if ( empty( $author_test101authorinfo ) ) {
			$author_test101authorinfo  = __( 'This author has not yet filled in any details.', 'Avada' );
			$author_test101authorinfo .= '<br />' . sprintf( __( 'So far %s has created %s blog entries.', 'Avada' ), $author_name, count_user_posts( $author_id ) );
		}
		?>
        <div class="test101-authorbiopnl">
        	<div class="title-blk">
            	About the Author
            </div>
        	<div class="info-blk">
            	<div class="img-blk">
                	<img src="<?php echo $author_test101authorphoto ?>" alt="<?php echo $author_name; ?> " />
                    <h2><?php echo $author_name; ?><?php echo $author_test101extendedname; ?></h2>
                    <span><?php echo $author_test101authortitle; ?></span>
                </div>
                <div class="dtls-blk">
                	<?php echo $author_test101authorinfo; ?>
                </div>
            </div>
            <div class="social-blk">
            	<div>Connect with <?php echo $author_name; ?> on social media</div>
            	<?php

				// Get the social icons for the author set on his profile page
				$author_soical_icon_options = array (
					'authorpage'		=> 'yes',
					'author_id'			=> $author_id,
					'position'			=> 'author',
					'icon_colors' 		=> Avada()->settings->get( 'social_links_icon_color' ),
					'box_colors' 		=> Avada()->settings->get( 'social_links_box_color' ),
					'icon_boxed' 		=> Avada()->settings->get( 'social_links_boxed' ),
					'icon_boxed_radius' => Avada()->settings->get( 'social_links_boxed_radius' ),
					'tooltip_placement'	=> Avada()->settings->get( 'social_links_tooltip_placement' ),
					'linktarget'		=> Avada()->settings->get( 'social_icons_new' ),
				);

				echo $social_icons->render_social_icons( $author_soical_icon_options );

				?>
            </div>
        </div>
        <div class="test101-authorpoststitle">
        	<?php $user_post_count = count_user_posts( $author_id ); 
			if($user_post_count > 1) {
				echo '<h3>Recent Articles by ' .$author_name .' on TEST101 Blog</h3>';
			}elseif($user_post_count = 1){
				echo '<h3>Recent Article by ' .$author_name .' on TEST101 Blog</h3>';
			}else{
				echo 'No article written by this author yet.';
			}
			
			?>
        
        
        	
        </div>
        <style>
			.fusion-author,
			.fusion-page-title-bar {
				display:none;
			}
			.fusion-post-medium .fusion-flexslider,
			.fusion-post-medium .fusion-post-content-container,
			.fusion-post-medium .fusion-meta-info,
			#content .pagination  {
				display:none;
			}
			.fusion-post-medium h2.entry-title {
				margin-bottom:0;
			}
			.fusion-post-medium {
				margin-bottom:5px !important;
			}
			.fusion-blog-layout-medium > div:nth-child(n+6){
				display:none !important;
			}
		</style>

		<?php
	}
}
remove_action( 'avada_author_info', 'avada_render_author_info' );
add_action( 'avada_author_info', 'test101_render_author_info', 2 );

?>
<?php
if ( ! function_exists( 'test101_render_author_post' ) ) {
	function test101_render_author_post() {
		?>
	<?php query_posts('showposts=10'); if (have_posts()) : while (have_posts()) : the_post(); ?>

        <h2 class="test101-author-postlist entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<?php endwhile;?>


	<?php else : ?>
    
        <h1>No post from this author.</h1>
    
    <?php endif; wp_reset_query(); 
	}
}

add_action( 'test101_author_post', 'test101_render_author_post', 2 );
?>
<?php
function add_meta_tags2() {
	echo '<meta property="fb:pages" content="159202207501401" />';
	echo '<meta name="msvalidate.01" content="8B8204088047ECBAC6456797408C2163" />';
	echo '<meta name="yandex-verification" content="1a4c0a32e19606b9" />';
}
add_action('wp_head', 'add_meta_tags2',10);
?>
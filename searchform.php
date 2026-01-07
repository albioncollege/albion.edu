<?php
if ( isset( $_REQUEST['post_type'] ) ) {
	if ( is_string( $_REQUEST['post_type'] ) ) {
		$post_type = array(
			$_REQUEST['post_type']
		);
	} else {
		$post_type = $_REQUEST['post_type'];
	}
} else {
	$post_type = array();
}
?>
<form role="search" method="get" id="searchform" class="searchform" action="/" _lpchecked="1">
	<label><span>Search Term:</span> <input type="text" value="<?php print ( isset( $_REQUEST['s'] ) ? htmlspecialchars( $_REQUEST['s'] ) : '' ); ?>" name="s" id="s" placeholder="Search"></label>
	<label><input type="checkbox" name="post_type[]" value="page"<?php print ( in_array( 'page', $post_type ) ? ' checked="yes"' : '' ) ?> /> Pages</label>
	<label><input type="checkbox" name="post_type[]" value="post"<?php print ( in_array( 'post', $post_type ) ? ' checked="yes"' : '' ) ?> /> Articles</label>
	<label><input type="checkbox" name="post_type[]" value="event"<?php print ( in_array( 'event', $post_type ) ? ' checked="yes"' : '' ) ?> /> Events</label>
	<label><input type="checkbox" name="post_type[]" value="people"<?php print ( in_array( 'people', $post_type ) ? ' checked="yes"' : '' ) ?> /> People</label>
	<label><input type="submit" id="searchsubmit" value="Search" class="btn-arrow"></label>
</form>
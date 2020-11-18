<?php 

// Core codes for blog post schema 

function bps_header_schema(){

	$bps_id = get_the_ID(); 
	if (is_single($bps_id)) {
		
		$bps_permalink     = get_the_permalink( $bps_id );
		$bps_title         = get_the_title( $bps_id );
		$bps_img           = get_the_post_thumbnail_url( $bps_id );
		$bps_admin         = get_the_author_meta( 'display_name' );
		$bps_site          = get_bloginfo( 'name' );
		$bps_site_url      = get_site_url();
		$bps_date          = get_the_date( 'Y-m-j' );
		$bps_modified_date = get_the_modified_date( 'Y-m-j' );

		?>
		<script type="application/ld+json">
			{
			  "@context": "https://schema.org",
			  "@type": "BlogPosting",
			  "mainEntityOfPage": {
			    "@type": "WebPage",
			    "@id": "<?php echo esc_html( $bps_permalink ); ?>"
			  },
			  "headline": "<?php echo esc_html( $bps_title ); ?>",
			  "image": "<?php echo esc_url( $bps_img ); ?>",  
			  "author": {
			    "@type": "Person",
			    "name": "<?php echo esc_html( $bps_admin ); ?>"
			  },  
			  "publisher": {
			    "@type": "Organization",
			    "name": "<?php echo esc_html( $bps_site ); ?>",
			    "logo": {
			      "@type": "ImageObject",
			      "url": "<?php echo esc_url( $bps_site_url ); ?>",
			      "logo": "<?php echo esc_url( $bps_site_url ); ?>"
			    }
			  },
			  "datePublished": "<?php echo esc_html( $bps_date ); ?>",
			  "dateModified": "<?php echo esc_html( $bps_modified_date ); ?>"
			},
			{
			  "@context": "https://schema.org/", 
			  "@type": "BreadcrumbList", 
			  "itemListElement": [{
			    "@type": "ListItem", 
			    "position": 1, 
			    "name": "<?php echo esc_html( $bps_site ); ?>",
			    "item": "<?php echo esc_url( $bps_site_url ); ?>"  
			  },{
			    "@type": "ListItem", 
			    "position": 2, 
			    "name": "<?php echo esc_html( $bps_title ); ?>",
			    "item": "<?php echo esc_html( $bps_permalink ); ?>"  
			  }]
			}
		</script>
		<?php 
	}
}
add_action( 'wp_head', 'bps_header_schema' );


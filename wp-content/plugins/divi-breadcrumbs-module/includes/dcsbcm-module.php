<?php if ( ! defined( 'ABSPATH' ) ) exit; // don't load if file is accessed directly
/*  ################################################################
	Divi Breadcrumbs Module
	
	Module Name: Divi Breadcrumbs
	Version: 1.2.0
	www.DiviBreadcrumbs.com
	CODECRATER
	https://divicake.com/author/CODECRATER/
	################################################################
*/
	
	
	class dcsbcm_Divi_Breadcrumbs_Module extends ET_Builder_Module {
		function init() {
			$this->name       = 'Divi Breadcrumbs';
			$this->slug       = 'et_pb_dcsbcm_divi_breadcrumbs_module';
			$this->fb_support = false;


			$this->whitelisted_fields = array(
				'separator',
				'hide_homebreadcrumb',
				'homebreadcrumbtext',
				'hide_currentbreadcrumb',
				'homebreadcrumborientation',
				'background_layout',
				'admin_label',
				'module_id',
				'module_class',
			);

			$this->fields_defaults = array(
				'background_layout' => array( 'light' ),
			);

			$this->main_css_element = '%%order_class%%.dcsbcm_divi_breadcrumbs_wrapper';
			
			$this->options_toggles = array(
				'general'  => array(
					'toggles' => array(
						'breadcrumbnav_settings' => esc_html__( 'Breadcrumb Navigation Settings', 'et_builder' ),
					),
				),
				'advanced' => array(
					'toggles' => array(
						'breadcrumb_styles' => array(
							'title'    => esc_html__( 'Breadcrumb Style', 'et_builder' ),
							'priority' => 10,
						),
					),
				),
				'custom_css' => array(
					'toggles' => array(
						'dcsbcm_typurchase' => array(
							'title'    => 'Thank You for Purchasing The Divi Breadcrumbs Module! <3',
							'priority' => 95,
						),
					),
				),
			);
		
			$this->advanced_options = array(
				'background' => array(
					'settings' => array(
						'color' => 'alpha',
					),
				),
				'fonts' => array(
					'fontsbreadcrumbs' => array(
						'label'    => esc_html__( 'Breadcrumbs', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element}",
						),
					),
					'fontsseperator'   => array(
						'label'    => esc_html__( 'Seperator', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} span.dcsbcm_separator",
						),
					),
					'fontsbreadcrumblinks'   => array(
						'label'    => esc_html__( 'Breadcrumb Links', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} .dcsbcm_divi_breadcrumb a",
						),
					),
				),
				'custom_margin_padding' => array(
					'css' => array(
						'important' => 'all',
					),
				),
			);
			
			$this->custom_css_options = array(
				'breadcrumbcss_breadcrumbs' => array(
					'label'    => esc_html__( 'Breadcrumbs', 'et_builder' ),
					'selector' => 'span.dcsbcm_divi_breadcrumb',
				),
				'breadcrumbcss_activebreadcrumb' => array(
					'label'    => esc_html__( 'Active Breadcrumb', 'et_builder' ),
					'selector' => 'span.dcsbcm_divi_breadcrumb-active',
				),
				'breadcrumbcss_breadcrumblinks' => array(
					'label'    => esc_html__( 'Breadcrumb Links', 'et_builder' ),
					'selector' => 'span.dcsbcm_divi_breadcrumb a',
				),
				'breadcrumbcss_breadcrumblinkhover' => array(
					'label'    => esc_html__( 'Breadcrumb Link Hover', 'et_builder' ),
					'selector' => 'span.dcsbcm_divi_breadcrumb a:hover',
				),
				'breadcrumbcss_seperators' => array(
					'label'    => esc_html__( 'Seperators', 'et_builder' ),
					'selector' => 'span.dcsbcm_separator',
				),
			);
		}

		function get_fields() {
			$dcsbcm_separatorlist = array();
			$dcsbcm_separatorlist['sep-raquo'] 		= '»';
			$dcsbcm_separatorlist['sep-arrow'] 		= '→';
			$dcsbcm_separatorlist['sep-tri'] 		= '▶';
			$dcsbcm_separatorlist['sep-dash'] 		= '-';
			$dcsbcm_separatorlist['sep-ndash'] 		= '–';
			$dcsbcm_separatorlist['sep-mdash'] 		= '—';
			$dcsbcm_separatorlist['sep-tinydot']	= '·';
			$dcsbcm_separatorlist['sep-bull'] 		= '•';
			$dcsbcm_separatorlist['sep-tinystar'] 	= '*';
			$dcsbcm_separatorlist['sep-star'] 		= '⋆';
			$dcsbcm_separatorlist['sep-tilde']		= '~';
			$dcsbcm_separatorlist['sep-pipe']		= '|';
			$fields = array(
				'divi_cake' => array(
					'label'       => 'Discover more great Divi products on <a href="https://divicake.com/products/" target=="_blank">DiviCake.com</a>',
					'type'        => 'text',
					'description' => '<a href="https://divicake.com/products/" target="_blank"><img src="https://divicake.com/wp-content/uploads/dcnet/divi-cake-size-heading.jpg" alt="Divi Cake is a community driven marketplace for Divi Child Themes, Builder Layouts, and Plugins - Shop Now!" style="width:100%" /></a>',
					'toggle_slug' => 'dcsbcm_typurchase',
					'tab_slug'    => 'custom_css',
				),
				'hide_homebreadcrumb' => array(
					'label'             => esc_html__( 'Hide Home Breadcrumb', 'et_builder' ),
					'type'              => 'yes_no_button',
					'option_category'   => 'basic_option',
					'options'           => array(
						'off' => esc_html__( "No", 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'affects'           => array(
						'homebreadcrumbtext'
					),
					'toggle_slug'       => 'breadcrumbnav_settings',
					'description'       => esc_html__( 'Choose whether or not to display "Home" link.', 'et_builder' ),
				),
				'homebreadcrumbtext' => array(
					'label'           => esc_html__( 'Home Breadcrumb Text', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'depends_show_if' => 'off',
					'description'     => esc_html__( 'If you would like override the "Home" breadcrumb text, input your own text here. The word "Home" will be shown if this field is left blank.', 'et_builder' ),
					'toggle_slug'     => 'breadcrumbnav_settings',
				),
				'separator' => array(
					'label'           => esc_html__( 'Separator', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'basic_option',
					'options'         => $dcsbcm_separatorlist,
					'toggle_slug'     => 'breadcrumbnav_settings',
					'description'     => esc_html__( 'Choose a symbol to use as your breadcrumb separator. The appearance of separators can be customized in the Design Tab.', 'et_builder' ),
				),
				'hide_currentbreadcrumb' => array(
					'label'             => esc_html__( 'Hide Current Page', 'et_builder' ),
					'type'              => 'yes_no_button',
					'option_category'   => 'basic_option',
					'options'           => array(
						'off' => esc_html__( "No", 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'toggle_slug'       => 'breadcrumbnav_settings',
					'description'       => esc_html__( 'Choose whether or not to display the show current Post or Page title in the breadcrumbs.', 'et_builder' ),
				),
				'homebreadcrumborientation' => array(
					'label'           => esc_html__( 'Breadcrumb Orientation', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'basic_option',
					'options'		  => array(
						'left' => esc_html__( "Left", 'et_builder' ),
						'right'  => esc_html__( 'Right', 'et_builder' ),
						'center' => esc_html__( "Center", 'et_builder' ),
					),
					'toggle_slug'     => 'breadcrumb_styles',
					'tab_slug'    	=> 'advanced',
					'description'     => esc_html__( 'Choose which direction you would like to align the breadcrumbs.', 'et_builder' ),
				),
				'background_layout' => array(
					'label'           => esc_html__( 'Text Color', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'color_option',
					'options'         => array(
						'light' => esc_html__( 'Dark', 'et_builder' ),
						'dark'  => esc_html__( 'Light', 'et_builder' ),
					),
					'toggle_slug'       => 'breadcrumb_styles',
					'tab_slug'    => 'advanced',
					'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
				),
				'disabled_on' => array(
					'label'           => esc_html__( 'Disable on', 'et_builder' ),
					'type'            => 'multiple_checkboxes',
					'options'         => array(
						'phone'   => esc_html__( 'Phone', 'et_builder' ),
						'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
						'desktop' => esc_html__( 'Desktop', 'et_builder' ),
					),
					'additional_att'  => 'disable_on',
					'option_category' => 'configuration',
					'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'visibility',
				),
				'admin_label' => array(
					'label'       => esc_html__( 'Admin Label', 'et_builder' ),
					'type'        => 'text',
					'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
					'toggle_slug' => 'admin_label',
				),
				'module_id' => array(
					'label'           => esc_html__( 'CSS ID', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'classes',
					'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
					'label'           => esc_html__( 'CSS Class', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'classes',
					'option_class'    => 'et_pb_custom_css_regular',
				),
			);
			return $fields;
		}
		

		function shortcode_callback( $atts, $content = null, $function_name ) {
			$module_id         			= $this->shortcode_atts['module_id'];
			$module_class      			= $this->shortcode_atts['module_class'];
			$separator         			= $this->shortcode_atts['separator'];
			$hide_homebreadcrumb    	= $this->shortcode_atts['hide_homebreadcrumb'];
			$homebreadcrumbtext			= $this->shortcode_atts['homebreadcrumbtext'];
			$hide_currentbreadcrumb		= $this->shortcode_atts['hide_currentbreadcrumb'];
			$homebreadcrumborientation 	= $this->shortcode_atts['homebreadcrumborientation'];
			$background_layout 			= $this->shortcode_atts['background_layout'];
			$breadcrumbFullText['home'] = $homebreadcrumbtext;
			if ( $homebreadcrumbtext == '' ) { $breadcrumbFullText['home'] = 'Home'; }
			if ( $hide_homebreadcrumb == 'on' ) {
				$hide_homebreadcrumb = 1;
			} else {
				$hide_homebreadcrumb = 0;
			}
			if ( $hide_currentbreadcrumb == 'on' ) {
				$hide_currentbreadcrumb = 1;
			} else {
				$hide_currentbreadcrumb = 0;
			}
			$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );
			switch ( $separator ) {
				case 'sep-raquo':
					$separator = '&raquo;';
					break;
				case 'sep-arrow':
					$separator = '&rarr;';
					break;
				case 'sep-tri':
					$separator = '&#9654;';
					break;
				case 'sep-dash':
					$separator = '-';
					break;
				case 'sep-ndash':
					$separator = '&ndash;';
					break;
				case 'sep-mdash':
					$separator = '&mdash;';
					break;
				case 'sep-tinydot':
					$separator = '·';
					break;
				case 'sep-bull':
					$separator = '&bull;';
					break;
				case 'sep-tinystar':
					$separator = '*';
					break;
				case 'sep-star':
					$separator = '&#9733;';
					break;
				case 'sep-tilde':
					$separator = '~';
					break;
				case 'sep-pipe':
					$separator = '|';
					break;
			}
			$separator = '<span class="dcsbcm_separator">&nbsp;'.$separator.'&nbsp;</span>';
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => 'text-align: ' . $homebreadcrumborientation . ';',
			) );
			$breadcrumbActiveBefore      		= '<span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active">';
			$breadcrumbActiveAfter       		= '</span>';
			$breadcrumbFullText['category'] = 'Category: "%s"';
			$breadcrumbFullText['tax'] 	  	= 'Archive for "%s"';
			$breadcrumbFullText['search']   = 'Search Results for "%s"';
			$breadcrumbFullText['tag']      = 'Posts Tagged "%s"';
			$breadcrumbFullText['author']   = 'Posts by %s';
			$breadcrumbFullText['404']      = 'Error 404';
			
			
			global $post;
			$dcsbcm_Output_BreadcrumbsHTML = '';
			$homeLink = get_bloginfo('url') . '/';
			$linkBefore = '<span class="dcsbcm_divi_breadcrumb" typeof="v:Breadcrumb">';
			$linkAfter = '</span>';
			$linkAttr = ' rel="v:url" property="v:title"';
			$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

			
			if ( is_home() || is_front_page() ) {

				if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs"><span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active"><a href="' . $homeLink . '">' . $breadcrumbFullText['home'] . '</a></span></div>'; }

			} else {
		
				$dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
				
				if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML .= sprintf( $link, $homeLink, $breadcrumbFullText['home'] ) . $separator; }
				
				if ( is_category() ) {
					$thisCat = get_category(get_query_var('cat'), false);
					if ($thisCat->parent != 0) {
						$cats = get_category_parents($thisCat->parent, TRUE, $separator);
						$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
						$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
						$dcsbcm_Output_BreadcrumbsHTML .= $cats;
					}
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['category'], single_cat_title('', false)) . $breadcrumbActiveAfter;

				} elseif( is_tax() ){
					$thisCat = get_category(get_query_var('cat'), false);
					if ($thisCat->parent != 0) {
						$cats = get_category_parents($thisCat->parent, TRUE, $separator);
						$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
						$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
						$dcsbcm_Output_BreadcrumbsHTML .= $cats;
					}
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tax'], single_cat_title('', false)) . $breadcrumbActiveAfter;
				
				}elseif ( is_search() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['search'], get_search_query()) . $breadcrumbActiveAfter;

				} elseif ( is_day() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
					$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $separator;
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('d') . $breadcrumbActiveAfter;

				} elseif ( is_month() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('F') . $breadcrumbActiveAfter;

				} elseif ( is_year() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('Y') . $breadcrumbActiveAfter;

				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						$dcsbcm_Output_BreadcrumbsHTML .= sprintf( $link, $homeLink . $slug['slug'] . '/', $post_type->labels->name );
						if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title() . $breadcrumbActiveAfter;
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $separator);
						if ($hide_currentbreadcrumb == 1) $cats = preg_replace("#^(.+)$separator$#", "$1", $cats);
						$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
						$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
						$dcsbcm_Output_BreadcrumbsHTML .= $cats;
						if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title() . $breadcrumbActiveAfter;
					}

				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $post_type->labels->singular_name . $breadcrumbActiveAfter;

				} elseif ( is_page() && !$post->post_parent ) {
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title() . $breadcrumbActiveAfter;

				} elseif ( is_page() && $post->post_parent ) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) $dcsbcm_Output_BreadcrumbsHTML .= $separator;
					}
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title() . $breadcrumbActiveAfter;

				} elseif ( is_tag() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tag'], single_tag_title('', false)) . $breadcrumbActiveAfter;

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['author'], $userdata->display_name) . $breadcrumbActiveAfter;

				} elseif ( is_404() ) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $breadcrumbFullText['404'] . $breadcrumbActiveAfter;
					
				}

				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ' (';
					$dcsbcm_Output_BreadcrumbsHTML .= __('Page') . ' ' . get_query_var('paged');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ')';
				}

				$dcsbcm_Output_BreadcrumbsHTML .= '</div>';
		
			}
		
			$class = " et_pb_module et_pb_bg_layout_{$background_layout}";
			
			$dcsbcm_Output = sprintf(
				'<div%3$s class="dcsbcm_divi_breadcrumbs_wrapper clearfix%2$s%4$s">%1$s</div><!-- .dcsbcm_divi_breadcrumbs_wrapper -->',
				$dcsbcm_Output_BreadcrumbsHTML,
				esc_attr( $class ),
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
				( '' !== $module_class ? sprintf( ' %1$s', esc_attr( ltrim( $module_class ) ) ) : '' )
			);
			
			
			if ( is_home() || is_front_page() ) {
				if ( $hide_homebreadcrumb == 0 ) { return $dcsbcm_Output; }
			} else {
				return $dcsbcm_Output;
			}
		}
	}
	new dcsbcm_Divi_Breadcrumbs_Module;
?>
<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Navigation Plugin
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2008 - 2011, PyroCMS
 *
 */
class Plugin_Navigation extends Plugin
{
	/**
	 * Navigation
	 *
	 * Creates a list of menu items
	 *
	 * Usage:
	 * {pyro:navigation:links group="header"}
	 * Optional:  indent="", tag="li", list_tag="ul", top="text", separator="", group_segment="", class="", more_class=""
	 * @param	array
	 * @return	array
	 */
	function links()
	{
		$group			= $this->attribute('group');
		$group_segment	= $this->attribute('group_segment');

		is_numeric($group_segment) ? $group = $this->uri->segment($group_segment) : NULL;

		$this->load->model('navigation/navigation_m');
		
		$links=$this->navigation_m->get_link_tree($group);
		//$links = $this->pyrocache->model('navigation_m', 'get_link_tree', array($group), $this->settings->navigation_cache);
//print_r($links);
		return $this->_build_links($links, $this->content());
	}
	
	function links_vertical()
	{
		$this->load->model('navigation/navigation_m');
		return $links=$this->navigation_m->leftmenu();
	}

	private function _build_links($links = array(), $return_arr = TRUE)
	{
		static $is_current	= FALSE;
		static $level		= 0;

		$top			= $this->attribute('top', FALSE);
		$separator		= $this->attribute('separator', '');
															//deprecated
		$link_class		= $this->attribute('link-class', $this->attribute('link_class', ''));
															//deprecated
		$more_class		= $this->attribute('more-class', $this->attribute('more_class', ''));
		$current_class	= $this->attribute('class', 'current');
		$output			= $return_arr ? array() : '';

		$i		= 1;
		$total	= sizeof($links);

		if ( ! $return_arr)
		{
			$tag		= $this->attribute('tag', 'li');
														//deprecated
			$list_tag	= $this->attribute('list-tag', $this->attribute('list_tag', 'ul'));

			switch ($this->attribute('indent'))
			{
				case 't':
				case 'tab':
				case '	':
					$indent = "\t";
					break;
				case 's':
				case 'space':
				case ' ':
					$indent = "    ";
					break;
				default:
					$indent = FALSE;
					break;
			}

			if ($indent)
			{
				$ident_a = repeater($indent, $level);
				$ident_b = $ident_a . $indent;
				$ident_c = $ident_b . $indent;
			}
		}

		foreach ($links as $link)
		{
			$item		= array();
			$wrapper	= array();

			// attributes of anchor
			$item['url']					= $link['url'];
			$item['title']					= $link['title'];
			$item['attributes']['target']	= $link['target'] ? 'target="' . $link['target'] . '"' : NULL;
			$item['attributes']['class']	= $link_class ? 'class="' . $link_class . '"' : '';

			// attributes of anchor wrapper
			$wrapper['class']		= $link['class'] ? explode(' ', $link['class']) : array();
			$wrapper['children']	= $return_arr ? array() : NULL;
			$wrapper['separator']	= $separator;

			// is single ?
			if ($total === 1)
			{
				$wrapper['class'][] = 'single';
			}

			// is first ?
			elseif ($i === 1)
			{
				$wrapper['class'][] = 'first';
			}

			// is last ?
			elseif ($i === $total)
			{
				$wrapper['class'][]		= 'last';
				$wrapper['separator']	= '';
			}

			// has children ? build children
			if ($link['children'])
			{
				++$level;
				$wrapper['class'][] = $more_class;
				$wrapper['children'] = $this->_build_links($link['children'], $return_arr);
				--$level;
			}

			// is current ?
			if (current_url() === $link['url'] OR ($link['link_type'] === 'page' && $link['is_home'] == TRUE) AND site_url() === current_url())
			{
				$is_current = TRUE;
				$wrapper['class'][] = $current_class;
			}

			// current experimental
			// fail ..
			/*elseif ($link->module_name === get_instance()->module)
			{
				$is_current = TRUE;
				$wrapper['class'][] = 'current';
			}*/

			// has children as current ?
			if ($is_current)
			{
				if ( ! in_array($current_class, $wrapper['class']))
				{
					$wrapper['class'][] = 'has_' . $current_class;
				}

				if ($level === 0)
				{
					// we've got the expected result, stop check if has current children
					$is_current = FALSE;
				}
			}

			++$i;

			if ($return_arr)
			{
				$item['target']		=& $item['attributes']['target'];
				$item['class']		=& $item['attributes']['class'];
				$item['children']	= $wrapper['children'];

				if ($wrapper['class'] && $item['class'])
				{
					$item['class'] = implode(' ', $wrapper['class']) . ' ' . substr($item['class'], 7, -1);
				}
				elseif ($wrapper['class'])
				{
					$item['class'] = implode(' ', $wrapper['class']);
				}

				if ($item['target'])
				{
					$item['target'] = substr($item['target'], 8, -1);
				}

				// assign attributes to level family
				$output[] = $item;
			}
			else
			{
																							//deprecated
				$add_first_tag = $level === 0 && ! in_array($this->attribute('items-only', $this->attribute('items_only', 'true')), array('1','y','yes','true'));

				// render and indent or only render inline?
				if ($indent)
				{
					$output .= $add_first_tag ? "<{$list_tag}>" . PHP_EOL : '';
					$output .= $ident_b . '<' . $tag . ' class="' . implode(' ', $wrapper['class']) . '">' . PHP_EOL;
					$output .= $ident_c . ((($level == 0) AND $top == 'text' AND $wrapper['children']) ? $item['title'] : anchor($item['url'], $item['title'], trim(implode(' ', $item['attributes'])))) . PHP_EOL;

					if ($wrapper['children'])
					{
						$output .= $ident_c . "<{$list_tag}>" . PHP_EOL;
						$output .= $ident_c . $indent . str_replace(PHP_EOL, (PHP_EOL . $indent),  trim($ident_c . $wrapper['children'])) . PHP_EOL;
						$output .= $ident_c . "</{$list_tag}>" . PHP_EOL;
					}

					$output .= $wrapper['separator'] ? $ident_c . $wrapper['separator'] . PHP_EOL : '';
					$output .= $ident_b . "</{$tag}>" . PHP_EOL;
					$output .= $add_first_tag ? $ident_a . "</{$list_tag}>" . PHP_EOL : '';
				}
				else
				{
					$output .= $add_first_tag ? "<{$list_tag}>" : '';
					$output .= '<' . $tag . ' class="' . implode(' ', $wrapper['class']) . '">';
					$output .= (($level == 0) AND $top == 'text' AND $wrapper['children']) ? $item['title'] : anchor($item['url'], $item['title'], trim(implode(' ', $item['attributes'])));

					if ($wrapper['children'])
					{
						$output .= "<{$list_tag}>";
						$output .= $wrapper['children'];
						$output .= "</{$list_tag}>";
					}

					$output .= $wrapper['separator'];
					$output .= "</{$tag}>";
					$output .= $add_first_tag ? "</{$list_tag}>" : '';
				}
			}
		}

		return $output;
	}
	
	function calender_nav(){
		$this->load->model('kalenderevent/listings_model', 'listings'); 
		$prefs['template'] = '
		
		
		   {table_open}<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:none">{/table_open}
		
		   {heading_row_start}<tr>{/heading_row_start}
		
		   {heading_previous_cell}<th><a href="'.base_url().'{previous_url}">&laquo;</a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}" style="padding:4px;">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th><a href="'.base_url().'{next_url}">&raquo;</a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td style="padding:4px; text-align: center; background: #efefef">{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		
		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td style="padding:4px; text-align: center">{/cal_cell_start}
		
		   {cal_cell_content}<a style="display:block; background:#436629; color: white" href="'.base_url().'{content}">{day}</a>{/cal_cell_content}
		   {cal_cell_content_today}<div style="background: yellow"><a href="'.base_url().'{content}">{day}</a></div>{/cal_cell_content_today}
		
		   {cal_cell_no_content}{day}{/cal_cell_no_content}
		   {cal_cell_no_content_today}<div style="background: yellow"><b>{day}</b></div>{/cal_cell_no_content_today}
		
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		   {cal_cell_end}</td style="padding:4px; text-align: center">{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		
		   {table_close}</table>{/table_close}
		    
		';
		$prefs['show_next_prev'] = TRUE;
		$prefs['next_prev_url'] = 'kalenderevent/risalah';
		$this->load->library('calendar', $prefs);
		
		$currdate=date('Y-m-d') ;
		$bulan=date('m');
		$data = array();
		$arycurrdate = array();
		$prevdate = "";
		$nextdate = "";
		//echo $currdate;
		$arycurrdate = explode('-', $currdate); 
		//echo strtotime($currdate);
		$data = $this->listings->get_calendar_entries(strtotime($currdate));
		 
		if($arycurrdate[0]==''){$arycurrdate[0]=$tahun;$currdate=$tahun;}
		$calendar='
		<style>
		.kalender{
			background:#fff;
			border:0px;
			padding:0px;
			border-radius:7px 7px 4px 4px;
		}
		</style>
		<div class="kalender">';
		$calendar .= $this->calendar->generate(intval($arycurrdate[0]), $bulan, $data);
		 return  $calendar.='</div>';
		
	}
	 
}

/* End of file plugin.php */
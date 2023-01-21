<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('manager'))
{
	function manager($total_rows, $per_page_item) {
    $config['per_page']        = $per_page_item;
    $config['num_links']       = 2;
    $config['total_rows']      = $total_rows;
    $config['full_tag_open']   = '<ul class="pagination justify-content-end">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '<span class="page-link">Previous</span>';
    $config['prev_tag_open']   = '<li class="page-item">';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '<span class="page-link">Next</span>';
    $config['next_tag_open']   = '<li class="page-item">';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']   = '<span class="sr-only">(current)</span></span></li>';
    $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']   = '</span></li>';
    // $config['first_tag_open']  = '<span class="page-link">';
    // $config['first_tag_close'] = '</span>';
    // $config['last_tag_open']   = '<span class="page-link">';
    // $config['last_tag_close']  = '</span>';
    // $config['first_link']      = 'First';
    // $config['last_link']       = 'Last';
		$config['first_link'] = false;
		$config['last_link'] = false;
    return $config;
  }
}


if ( ! function_exists('get_settings'))
{

    function get_settings($type)
    {

        $CI = get_instance();
        $CI->load->database();
        $des = $CI->db->get_where('settings', array('type' => $type))->row()->description;

        return $des;


    }
}


if ( ! function_exists('file_names'))
{

    function file_names($dir = '/')
    {
        $files = scandir(BASEPATH."../".$dir);
        unset($files[0]);
        unset($files[1]);
        foreach($files as $key => $new_files){
          $remove  = explode("." , $new_files);
          $files[$key] = $remove[0];

        }
        return $files;


    }
}


/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
  function dump ($var, $label = 'Dump', $echo = TRUE)
  {
      // Store dump in variable 
      ob_start();
      var_dump($var);
      $output = ob_get_clean();
      
      // Add formatting
      $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
      $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
      
      // Output
      if ($echo == TRUE) {
          echo $output;
      }
      else {
          return $output;
      }
  }
}


if (!function_exists('dump_exit')) {
  function dump_exit($var, $label = 'Dump', $echo = TRUE) {
      dump ($var, $label, $echo);
      exit;
  }
}
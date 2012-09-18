<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * grabs all of the elements of that key from an array of arrays
 * 
 * @param string $needle
 * @param array  $arr  
 * @return array
 */
function array_pluck($needle, $arr) 
{
  $output = array();
  foreach($arr as $key => $value)
    {
      if(array_key_exists($needle,$value))
	{
	  $output[] = $value[$needle];
	}
    }
  return $output;
}

/**
 * Prints the array in HTML, to assist with debugging
 * 
 * @param array $data
 * @param boolean $return
 * @return void|string if $return is set to true, returns output as a string
 */
function array_print($data,$return=false)
{
  $output = print_r($data,true);
  $output = htmlentities($output);
  $output = str_replace(" ","&nbsp;",$output);
  $output = nl2br($output);

  $output = "<div style='background-color:#FFFFFF;'>".$output."</div>";
  
  if(!$return) {
    echo $output;
  } else {
    return $output;
  }  
}

/* pulls all of the elements of each sub array up a level, repeated recursively for $level times
 * 
 * @param array $data
 * @param int level
 * @return array
 *
 * example:
 *  $arr = array(1,2,3,array(4,5,6)); 
 *  array_flatten($arr); // returns array(1,2,3,4,5,6);
 */
function array_flatten($data, $level = 1) 
{
  if(!$level) 
    { 
      return $data; 
    }
  
  $output = array();

  foreach($data as $arr) 
    {
      $arr = (array)$arr;
      $output = array_merge($output, $arr);
    }

  return array_flatten($output, $level - 1);
}

/**
 * removes all elements that are in $filter_keys from the array, returns the filtered list
 * 
 * @param array $data
 * @param array $filter_keys
 * @return array
 */
function array_filter_keys($data, $filter_keys)
{
  foreach($data as $key => $value)
    {
    if(in_array($key, $filter_keys))
      {
      unset($data[$key]);
      }
    }
  return $data;
}

/**
 * 
 * returns true if any element in the return returns true from the callback. if the callback is not set,
 * will just test the truthiness of each element
 * 
 * @param array $arr
 * @param mixed $callback should be callable or false
 * @return boolean
 */
function any($arr, $callback) 
{
  foreach($arr as $key => $value) {
    if(is_callable($callback)) 
      {
	if(call_user_func($callback, array($key, $value))) 
	  {
	    return true;
	  }
      } 
    else if($value)
      {
	    return true;
      }
  }
  return false;
}

/**
 * 
 * returns true if all elements in the return returns true from the callback. if the callback is not set,
 * will just test the truthiness of each element
 * 
 * @param array $arr
 * @param mixed $callback should be callable or false
 * @return boolean
 */
function all($arr, $callback) 
{
  foreach($arr as $key => $value) 
    {
      if(is_callable($callback)) 
      {
	if(!call_user_func($callback, array($key, $value)))
	  {
	    return false;
	  }
      } 
      else if(!$value)
	{
	  return false;
	}
    }
  return true;
}

/**
 * calls the method on each object in an array, returns an array of the results
 * 
 * @param array $arr
 * @param string $method_name
 * @return array
 * 
 */
function array_invoke($arr, $method_name)
{
  $output = array();
  foreach($arr as $key => $obj)
    {
      if(!is_object($obj)) 
	{
	  Throw new Exception("$key is not an object");
	}
      if(!method_exists($obj, $method_name))
	{
	  Throw new Exception("object does not have method $method_name");
	}
      $output[$key] = $obj->$method_name;
    }
}
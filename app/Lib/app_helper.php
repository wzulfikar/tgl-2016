<?php 

function urlS($path = '', array $params = null, $forceHttps = false)
{
  if($forceHttps)
  {
    return url($path, $params, true);
  }
  return str_replace('http://', '//', url($path, $params));
}

function templateUrl()
{
  return urlS() . '/assets/AdminLTE-2.3.3';
}

function bower()
{
  return urlS() . '/bower_components';
}

/**
 * Set page title by create key 'pageTitle' in session
 * 
 * @param string $str
 */
function setPageTitle($str){
  session()->put('pageTitle', $str);
}

/**
 * Takes at least 2 arguments: truth test & output if the test passed.
 * If the args more than 2, the last arg will be the output if truth tests failed,
 * and the before-last arg will be the output if all truth tests passed.
 * 
 * @return mixed
 */
function coalesce(){
  $numArgs = func_num_args();
  if($numArgs < 2)
    throw new \Exception('insufficient args, should be at least 2 instead of 1');

  if( $numArgs < 3)
    return func_get_args()[0] ? func_get_args()[1] : null;

  $args   = func_get_args();
  $output_false = array_pop($args);
  $output_true  = array_pop($args);
  
  foreach ($args as $truth) {
    if(!$truth) return $output_false;
  }

  return $output_true;
}

/**
 * Get 'pageTitle' from session then remove it.
 * If no value inside, return value from lang file 'page_titles.generic'.
 * 
 * @return string
 */
function getPageTitle(){
  $pageTitle = session('pageTitle') ?: trans('page_titles.generic');
  session()->forget('pageTitle');
  return $pageTitle;
}

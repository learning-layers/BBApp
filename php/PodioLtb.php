<?php

class PodioLtb extends Podio {
  
  // ----------------------------------------------------
  // Invalidate access token to force re-authentication
  // Author: Gilbert Peffer
  // ----------------------------------------------------
  public static function invalidate_access_token() {
    self::$oauth->access_token = 0;
  }
    
}

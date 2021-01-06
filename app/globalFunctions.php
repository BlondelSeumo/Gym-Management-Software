<?php
/*Global Function can be call anywhere, but if some changes are done then no page would be
shown. Add this file in composer.json file in order to run it all over project
*/
if (!function_exists('merchantInformation')) {
    function merchantInformation()
    {
        return auth()->guard('merchant')->user();
    }
}
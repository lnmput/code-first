<?php


function test()
{
    echo 'test';
}


/**
 * 菜单是否激活
 *
 * @param $route
 * @return string
 */
function set_active($route) {


    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }

    return Request::path() == $route ? 'active' : '';
}



function ajax_error()
{
    return response()->json([
        'status' => 500,
        'message' => 'error'
    ]);
}

function ajax_success()
{
    return response()->json([
        'status' => 200,
        'message' => 'success'
    ]);
}

function trace_sql($dump = false)
{
    DB::listen(function ($event) use($dump) {
        if ($dump) {
            dump($event->sql);
            dump($event->bindings);
        }
        Log::info($event->sql);
        Log::info($event->bindings);
    });
}

function selltype_code($id)
{
    $sellTypes = config('microbook.sellType');

    return $sellTypes[$id-1]['code'];


}

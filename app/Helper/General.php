<?php

use Illuminate\Support\Facades\Config;

function get_languages(){
    return App\Models\Language::active() -> Selection() ->get();
}
function get_default_lang(){
    return config::get('app.locale');
}
function uploadimage($folder, $image){
    $image ->store('/', $folder);
    $filename = $image->hashName();
    $path = 'assets/images/' . $folder . '/' . $filename;
    return $path;
}
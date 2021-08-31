<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{
    public function Hindi(){
        Session()->get('language'); //ager language dhorlam
        Session()->forget('language'); //ager language forget korlam
        Session::put('language','hindi'); //jei language cai seta bosalam .. eta jdi header page er if er sathe mile tahle hindi show korbe nahle else e jeta aca seta show korbe mane english
        return redirect()->back();
    }

    public function English(){
        Session()->get('language'); //ager language dhorlam
        Session()->forget('language'); //ager language forget korlam
        Session::put('language','english'); //jei language cai seta bosalam ..englsh bosanor karone ata if er sathe mile nai tar jonno else kaj korbe akhane
        return redirect()->back();
    }
}

<?php

namespace Sadique\Privilege\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sadique\Privilege\Models\Privileges;
use Sadique\Privilege\Models\AssignPrivilege;

class Privilege2Controller extends Controller
{
    public function assignprivilege()
    {   
        $tb = 
        '<tr>
            <td>1</td>
            <td style="text-align: center;">Mohammad Sadique<input type="hidden" value="Mohammad Sadique" class="staffname"></td>
            <td style="text-align: center;">sadiquedeveloper@gmail.com</td>
            <td style="text-align: center;">
                <button type="submit" value="1" class="btn btn-success assignpri"><i class="fas fa-user"></i> Assign Privilege</button>   
            </td>
        </tr>';
          
        return view('privilege::assignprivilege',compact('tb'));
    }
}

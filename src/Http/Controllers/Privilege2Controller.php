<?php

namespace Sadique\Privilege\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sadique\Privilege\Models\Privileges;
use Sadique\Privilege\Models\AssignPrivilege;
use App\Models\Login;

class Privilege2Controller extends Controller
{
    public function assignprivilege()
    {   
        $ac = Login::select('*')->orderBy('id','DESC')->get();
        $i = 1;
        $tb = '';
        foreach($ac as $val){
            $tb .= 
            '<tr>
                <td>'.$i.'</td>
                <td style="text-align: center;">'.$val->name.'<input type="hidden" value="'.$val->name.'" class="staffname"></td>
                <td style="text-align: center;">'.$val->email.'</td>
                <td style="text-align: center;">'.$val->mobile.'</td>
                <td style="text-align: center;">
                    <button type="submit" value="'.$val->id.'" class="btn btn-success assignpri"><i class="fas fa-user"></i> Assign Privilege</button>   
                </td>
            </tr>';
            $i++;
        }
        return view('privilege::assignprivilege',compact('tb'));
        
    }

    public function subassignpri(Request $request)
    {
        $id = $request->id;
        //$staff = Login::select('*')->where(['id'=>$id,'role'=>'staff'])->first();

        return redirect()->route('staffprivilege',['id' => $id]);
    }

    public function staffprivilege($id)
    {
        // $staff = array('id'=>'1','name'=>'sadique','email'=>'sadiquedeveloper@gmail.com');
        $staff = Login::where('id',$id)->first();
        $f = explode(',',$staff->privilege_id);
        //    dd($staff['id']);
        // $a = array(14,16,22);
        // $b = array(14.16,17);

        // $c = array_intersect($a,$b);
        // print_r($f);

        // die;

        $mod = '';
        $getmodules = Privileges::where(['status'=>1,'onoff'=>1])->get();
        foreach($getmodules as $getmodule){
          $getsubmods = Privileges::where(['status'=>0,'tag'=>$getmodule->tag,'onoff'=>1])->get();
            $check2 = '';
            if(in_array($getmodule->id , $f)) 
            {
                $check2 = "checked"; 
            }
          $mod .=
          '<div class="col-md-4">
                <br>                
                <div class="card card-success">
                    <div class="card-header">       
                        <div class="icheck-default d-inline" >
                            <input type="checkbox" name="'.$getmodule->id.'" value="'.$getmodule->tag.'" id="'.$getmodule->id.'" class="selectall" '.$check2.'>
                            <label for="'.$getmodule->id.'"><h3 class="card-title">'.$getmodule->module.'</h3></label>
                        </div>
                    </div>
                    <div class="card-body">';
                    foreach($getsubmods as $getsubmod){
                        $check = '';
                        if(in_array($getsubmod->id , $f)) 
                        {
                            $check = "checked"; 
                        }

                        $mod .=
                        '<div class="row">
                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox" class="singleSubMod" value="'.$getsubmod->id.'" name="'.$getsubmod->tag.'" id="'.$getsubmod->id.'" '.$check.'>
                                  <label for="'.$getsubmod->id.'">'.$getsubmod->submodule.'</label>
                                </div>                     
                              </div>
                            </div>
                        </div>';
                    }
                    $mod .=
                    '</div>
              </div>
          </div>';
        }
        $mod2 = '';
        $c = Privileges::where(['tag'=>0,'onoff'=>1])->get();
        foreach($c as $cc){
            $mod2 .=
            '<div class="col-md-4">
                <br>                
                <div class="card card-success">
                    <div class="card-header">       
                        <div class="icheck-default d-inline" >
                            <input type="checkbox" class="singleSubMod" value="'.$cc->id.'" id="'.$cc->id.'" class="selectall">
                            <label for="'.$cc->id.'"><h3 class="card-title">'.$cc->submodule.'</h3></label>
                        </div>
                    </div>
                </div>
            </div>';
        }
        $hr = '';
        $d = Privileges::where(['tag'=>0,'onoff'=>1])->count();
        if($d > 0){
            $hr = '<div class="col-md-12"><br><hr></div>';
        }

        

        return view('privilege::staffprivilege',compact('mod','mod2','hr','staff'));
    }

    public function assignmodule(Request $request)
    {
        $id = $request->id;
        $staffid = $request->staffid;

        $staff = Login::where('id',$staffid)->first();
        $f = explode(',',$staff->privilege_id);

        $check = '';
        $privilege_id = '';
        $a = Privileges::where(['tag'=>$id,'onoff'=>1])->get();
        foreach($a as $aa){
            if(in_array($aa->id , $f)) 
            {
                // $check .= "1-".$aa->id.','; 
            } else {
                // $check .= "0-".$aa->id.',';
                if(!empty($staff->privilege_id)){
                    if(!empty($privilege_id)){
                        $privilege_id .= ','.$aa->id;
                    } else {
                        $privilege_id .= $staff->privilege_id.','.$aa->id;
                    }
                } else {
                    if(!empty($privilege_id)){
                        $privilege_id .= ','.$aa->id;
                    } else {
                        $privilege_id .= $aa->id;
                    }
                }
                $privilege_id;
            }
        }
        Login::where('id',$staffid)->update(['privilege_id' => $privilege_id]);
        return 1;
    }

    public function notassignmodule(Request $request)
    {
        $id = $request->id;
        $staffid = $request->staffid;

        $staff = Login::where('id',$staffid)->first();
        $f = explode(',',$staff->privilege_id);

        

        
        $privilege_id = '';
        $a = Privileges::where(['tag'=>$id,'onoff'=>1])->get();
        foreach($a as $aa){
            if(in_array($aa->id , $f)) 
            {
                if(!empty($privilege_id)){
                    $privilege_id .= ','.$aa->id;
                } else {
                    $privilege_id .= $aa->id;
                }
            }
        }
        $a2 = explode(',',$privilege_id);

        $a3 = array_diff($f,$a2);
        $pri_id = implode(',',$a3);
        Login::where('id',$staffid)->update(['privilege_id' => $pri_id]);

        $staff2 = Login::where('id',$staffid)->first();
        if(empty($staff2->privilege_id)){
            $privilege_id = null;
            Login::where('id',$staffid)->update(['privilege_id' => $privilege_id]);
        }
        return 1;
    }

    public function Allassignmodule(Request $request)
    {
        $id = $request->id;
        $staffid = $request->staffid;
        $pri_id = '';
        Login::where('id',$staffid)->update(['privilege_id' => $pri_id]);
        $privilege_id = '';
        $a = Privileges::where(['onoff'=>1])->get();
        foreach($a as $aa){
            if(!empty($privilege_id)){
                $privilege_id .= ','.$aa->id;
            } else {
                $privilege_id .= $aa->id;
            }
        }
        Login::where('id',$staffid)->update(['privilege_id' => $privilege_id]);
        return 1;
    }

    public function Allremovemodule(Request $request)
    {
        $id = $request->id;
        $staffid = $request->staffid;
        $pri_id = null;
        Login::where('id',$staffid)->update(['privilege_id' => $pri_id]);
        return 1;
    }

    public function assignsubmodule(Request $request)
    {
        $id = $request->id;
        $moduleid = $request->moduleid;
        $staffid = $request->staffid;
        $staff = Login::where('id',$staffid)->first();        
        if(!empty($staff->privilege_id)){
            $pri_id = $staff->privilege_id.','.$id;
        } else {
            $pri_id = $id;
        }
        if(!empty($moduleid)){
            $privilege_id = $pri_id.','.$moduleid;
        } else {
            $privilege_id = $pri_id;
        }
        Login::where('id',$staffid)->update(['privilege_id' => $privilege_id]);
        return 1;
    }

    public function removesubmodule(Request $request)
    {
        $id = $request->id;
        $moduleid = $request->moduleid;
        $staffid = $request->staffid;
        $staff = Login::where('id',$staffid)->first();
        $f = explode(',',$staff->privilege_id);
        $a2 = explode(',',$id);
        $a3 = array_diff($f,$a2); 
        //$pri_id = implode(',',$a3);    
        
        $b1 = explode(',',$moduleid);
        $b2 = array_diff($a3,$b1); 
        $pri_id = implode(',',$b2);
        
        Login::where('id',$staffid)->update(['privilege_id' => $pri_id]);

        $staff2 = Login::where('id',$staffid)->first();
        if(empty($staff2->privilege_id)){
            $privilege_id = null;
            Login::where('id',$staffid)->update(['privilege_id' => $privilege_id]);
        }
        return 1;
    }
}

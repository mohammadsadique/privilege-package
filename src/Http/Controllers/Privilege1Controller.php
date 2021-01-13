<?php

namespace Sadique\Privilege\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sadique\Privilege\Models\Privileges;

class Privilege1Controller extends Controller
{
    public function addpages()
    {

        $i = 1;
        $tb = '';
        // $co1 = Privileges::where('status',1)->count(); dd($co1);
        // if($co1 > 0){            
            $t = Privileges::where('status',1)->get();
            foreach($t as $val){
            if($val->onoff == 1){
                $btn = '<button type="submit" value="'.$val->id.'" class="btn btn-success available">Show</button>';
            } else {
                $btn = '<button type="submit" value="'.$val->id.'" class="btn btn-secondary unavailable">Hide</button>';
            }
            $tb .= 
            '<tr>
                <td>'.$i.'</td>
                <td style="text-align: center;">'.$val->module.'<input type="hidden" value="'.$val->module.'" class="modulename"></td>
                <td style="text-align: center;">'.$btn.'</td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <button type="submit" value="'.$val->id.'" class="btn btn-danger delete"><i class="fas fa-trash"></i></button>
                        <button type="button" value="'.$val->id.'" class="btn btn-warning upd"><i class="fas fa-edit"></i></button>                
                    </div>
                </td>
            </tr>';
            $i++;
            }
        // } else {
        //     $tb .= null;
        // }

        $mod = '<option value="">Select Module</option><option value="nomodule">No Module</option>';
        $f = Privileges::where(['status'=>1,'onoff'=>1])->get();
        foreach($f as $val){
            $mod .= '            
            <option value="'.$val->id.'">'.$val->module.'</option>
            ';
        }


        $i2 = 1;
        $tb2 = '';
        $t2 = Privileges::where('status',0)->get();
        foreach($t2 as $val){
          if($val->onoff == 1){
            $btn = '<button type="submit" value="'.$val->id.'" class="btn btn-success available2">Show</button>';
          } else {
            $btn = '<button type="submit" value="'.$val->id.'" class="btn btn-secondary unavailable2">Hide</button>';
          }
          if($val->tag > 0){
              $c = Privileges::where('id',$val->tag)->first();
              $module = $c->module;
          } else {
              $module = '';
          }

          $tb2 .= 
          '<tr>
              <td>'.$i2.'</td>
              <td style="text-align: center;">'.$module.'</td>
              <td style="text-align: center;">'.$val->submodule.'<input type="hidden" value="'.$val->submodule.'" class="submodulename"></td>
              <td style="text-align: center;">'.$btn.'</td>
              <td style="text-align: center;">
                  <div class="btn-group">
                      <button type="submit" value="'.$val->id.'" class="btn btn-danger delete2"><i class="fas fa-trash"></i></button>
                      <button type="button" value="'.$val->id.'" class="btn btn-warning upd2"><i class="fas fa-edit"></i></button>                
                  </div>
              </td>
          </tr>';
          $i2++;
        }



        return view('privilege::privilege',compact('tb','mod','tb2'));
        // return view('packagename::bladefilename');
    }

    public function subaddmodule(Request $request)
    {
        $valid = $request->validate([
          'module' => 'required|string',
        ]);
        $id = $request->id;
        if(!is_null($id)){
			$ee = Privileges::find($id);
		}
		else
		{
			$ee = new Privileges;
        }     
        $ee->module = $request->module;
        $ee->status = 1;
        $ee->onoff = 1;
        $ee->created_at = date('Y-m-d H:i:s'); 
        $ee->updated_at = date('Y-m-d H:i:s');
        $ee->save();    

        if(!is_null($id)){
			return redirect()->back()->with('success', 'Module updated successfully!');	
		}
		else
		{
            $r = Privileges::orderBy('id','DESC')->limit(1)->first();
            $ee2 = Privileges::find($r->id);
            $ee2->tag = $r->id;
            $ee2->save();
			return redirect()->back()->with('success', 'Module added successfully!');	
        }  
        
    }

    public function subaddsubmodule(Request $request)
    {
        $valid = $request->validate([
          'selmodule' => 'required|string',
          'submodule' => 'required|string',
        ],
        [
            'selmodule.required' => 'The module field is required.'
        ]);
        $id = $request->id;
        if(!is_null($id)){
			$ee = Privileges::find($id);
		}
		else
		{
            $ee = new Privileges;
            $ee->status = 0;
            $ee->onoff = 1;
        }  
        $ee->submodule = $request->submodule;        
        $ee->tag = $request->selmodule;        
        $ee->created_at = date('Y-m-d H:i:s'); 
        $ee->updated_at = date('Y-m-d H:i:s');
        $ee->save();
        if(!is_null($id)){
			return redirect()->back()->with('success', 'Sub Module updated successfully!');	
		}
		else
		{
			return redirect()->back()->with('success', 'Sub Module added successfully!');	
        } 
        
    }

    public function delmodule(Request $request)
    {
        $id = $request->id;
        $a = Privileges::find($id);
        Privileges::where('tag',$a->tag)->delete();
        Privileges::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Module deleted successfully!');	
    }
    public function delsubmodule(Request $request)
    {
        $id = $request->id;
        Privileges::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Sub Module deleted successfully!');	
    }

    public function updmodule(Request $request){
        $id = $request->id; 
        $ccv = Privileges::select('*')->where('id',$id)->first(); 
        return $ccv;
		// return redirect()->back()->with('ban' , $ccv );
    }
    public function updsubmodule(Request $request){
        $id = $request->id; 
        $a = Privileges::select('*')->where('id',$id)->first();
        $b = Privileges::where('id',$a->tag)->first();


        $mod = '<option value="'.$b->id.'" class="fopt">'.$b->module.'</option><option value="">Select Module</option><option value="nomodule">No Module</option>';
        $f = Privileges::where(['status'=>1,'onoff'=>1])->get();
        foreach($f as $val){
            $mod .= '            
            <option value="'.$val->id.'">'.$val->module.'</option>
            ';
        }
        return json_encode(array($a,$mod));
        // dd($b);
        //$mod = '<option value="'.$b->id.'">'.$b->module.'</option>'; 
		//return redirect()->back()->with(['ban2' => $a , 'ban3' => $b ]);
    }

    public function showmodule(Request $request)
    {
        $id = $request->id;
        $ee = Privileges::find($id);
        $ee->onoff = 1;
        $ee->save();
        $a = Privileges::where('id',$id)->first();
        Privileges::where('tag',$a->tag)->update(['onoff' => 1]);
        return redirect()->back()->with('success', 'Module show successfully!');	
    }
    public function hidemodule(Request $request)
    {
        $id = $request->id;
        $ee = Privileges::find($id);
        $ee->onoff = 0;
        $ee->save();
        $a = Privileges::where('id',$id)->first();
        Privileges::where('tag',$a->tag)->update(['onoff' => 0]);
       
        return redirect()->back()->with('success', 'Module hide successfully!');	
    }
    public function showsubmodule(Request $request)
    {
        $id = $request->id;
        $ee = Privileges::find($id);
        $ee->onoff = 1;
        $ee->save();
        return redirect()->back()->with('success', 'Sub Module show successfully!');	
    }
    public function hidesubmodule(Request $request)
    {
        $id = $request->id;
        $ee = Privileges::find($id);
        $ee->onoff = 0;
        $ee->save();
       
        return redirect()->back()->with('success', 'Sub Module hide successfully!');	
    }

    public function showprivilege()
    {
        $mod = '';
        $getmodules = Privileges::where(['status'=>1,'onoff'=>1])->get();
        foreach($getmodules as $getmodule){
          $getsubmods = Privileges::where(['status'=>0,'tag'=>$getmodule->tag,'onoff'=>1])->get();
          $mod .=
          '<div class="col-md-4">
                <br>                
                <div class="card card-success">
                    <div class="card-header">       
                        <div class="icheck-default d-inline" >
                            <input type="checkbox" name="'.$getmodule->tag.'" value="'.$getmodule->tag.'" id="'.$getmodule->id.'" class="selectall">
                            <label for="'.$getmodule->id.'"><h3 class="card-title">'.$getmodule->module.'</h3></label>
                        </div>
                    </div>
                    <div class="card-body">';
                    foreach($getsubmods as $getsubmod){
                        $mod .=
                        '<div class="row">
                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox" class="singleSubMod" value="'.$getsubmod->id.'" name="'.$getsubmod->tag.'" id="'.$getsubmod->id.'">
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
                            <input type="checkbox" class="singleSubMod" value="'.$cc->id.'" value="'.$cc->id.'" id="'.$cc->id.'" class="selectall">
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
        return view('privilege::showprivilege',compact('mod','mod2','hr'));
    }

}

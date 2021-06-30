<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Feeds;
use View;
use DB;

class c_rss extends Controller
{
    public function listft() {
    $ft = DB::table('ft')->orderBy('id_ft','DESC')->limit(8)->get();
    return $ft;
    }

    public function main() {    
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $feed = Feeds::make($db);
        $items = $feed->get_items();   

        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft] );
    }    

    public function carift(Request $request) { 
        $kw = $request->nama_ft;   
        $db = DB::table('ft')->where('url_ft',$kw)->pluck('url_ft')->toArray();
        $feed = Feeds::make($db);
        $items = $feed->get_items();   

        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft] );
    }    


    public function carinovel(Request $request) {
        $kw = $request->cari;        
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $data = preg_filter('/$/', '?q='.$kw, $db);                
        $feed = Feeds::make($data);
        $items = $feed->get_items();        

        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft] );
    }

    public function daftarft(){
        $listft = $this->listft();

        return View::make('daftarft', ['listft' => $listft] );
    }

    public function tambahft() {
        $listft = $this->listft();

        return View::make('tambahft', ['listft' => $listft] );
    }


    public function addft(Request $request) {  
        $listft = $this->listft();
        $this->validate($request, [
            'nama_ft' => 'required',
            'url_ft' => 'required',
            'owner_ft' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        
        $feed = Feeds::make([
            $request->url_ft.'/rss.xml',            
        ]);
        $data = $feed->get_items();
        if ($data == null)
        {
            $feed = Feeds::make([
                $request->url_ft.'/feed',            
            ]);

            $data = $feed->get_items();

            if ($data == null)
            {
                session()->flash("gagal","Gagal Message");
            }

            else {
                DB::table('ft')->insert([            
                    'nama_ft' => $request->nama_ft,
                    'url_ft' => $request->url_ft.'feed',     
                    'owner_ft' => $request->owner_ft,             
                ]);

                session()->flash("success","Success Message");
            }
        }  
        else {
            DB::table('ft')->insert([            
                'nama_ft' => $request->nama_ft,
                'url_ft' => $request->url_ft.'/rss.xml',     
                'owner_ft' => $request->owner_ft,             
            ]);
            session()->flash("success","Success Message");
        }      
    
        return View::make('tambahft', ['listft' => $listft] );
    }
}

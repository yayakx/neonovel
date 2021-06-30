@extends('main')

@section('main')
<div class="card col-md-8 ml-auto" style="overflow-y: scroll; height:650px;">    
    <div class="card-body">
        <div class="card-header bg-success text-white row" style="position:sticky; top:0;z-index:50;width:100%">
            <h4 class="text-white col-md" >List Update Novel Terbaru</h4>
            <button class="btn btn-outline-light d-block ml-auto" onclick="location.reload()"><i class="fa fa-sync-alt" aria-hidden="true"></i></button> 
        </div>
            <div class="col-md mt-2">     
                <div class="d-flex justify-content-between text-center">    
                    <p class="card-text col-md-6"><a>Judul</a></p>
                    <p class="card-text col-md-2"><a>Terbit</a></p>
                    <p class="card-text col-md-4"><a>FT</a></p>
                </div>
                <div class="scrolling-pagination">
                @foreach ($items as $item)    
                <div class="d-flex justify-content-between">                        
                    <p class="card-text col-md-6"><a href="{{ $item->get_permalink() }}" target="_blank">{{ $item->get_title() }}</a></p>
                    <p class="card-text col-md-2"><small>{{ $item->get_date('j F Y') }}</small></p>
                    <p class="card-text col-md-4"><a href="{{ $item->get_base() }}">{{ $item->get_base()}}</a></p>
                </div>             
                @endforeach 
                </div>                             
            </div>
    </div>
  </div> 
@endsection
@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading --> 
        @if($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
            <div class="row d-flex justify-content-between">
                <h1 class="h3">Majalah</h1>
                <a href="/majalah/add" class="btn btn-success"><i class="fa fa-plus"></i> Majalah</a>
            </div>
            <br>
    
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                    <table style="width:100%" class="table table-striped" id="dataTable" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Persetujuan Dewan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($majalah as $p)
                            <tr>
                                <td>{{$i}}</td> 
                                <td>{{$p->judul}}</td>
                                <td>{{$p->status}}</td>
                                <td>{{$p->approval_dewan}}</td>
                                <td>
                                    <a href="/majalah/view/{{$p->majalah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                                    @if(($p->status_id != 5 && $p->status_id !=2) || ($p->approval_dewan != 'Setuju'))
                                        <a href="/majalah/edit/{{$p->majalah_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                    @if($p->status_id != 5 && $p->status_id !=2)
                                        
                                        <a href="/majalah/ajukan/{{$p->majalah_id}}" class="btn btn-outline-danger"><i class="fa fa-paper-plane"></i> Ajukan Ke SEKJEN</a>
                                    @endif
                                    @if($p->approval_dewan != 'Setuju')
                                        <a href="/majalah/ajukanDewanRedaksi/{{$p->majalah_id}}" class="btn btn-outline-success"><i class="fa fa-paper-plane"></i> Ajukan Ke Dewan Redaksi</a>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div> 

@endsection 
@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading --> 
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($majalah as $p)
                            <tr>
                                <td>{{$i}}</td> 
                                <td>{{$p->judul}}</td>
                                <td>{{ $p->status}}</td>
                                <td>
                                <a href="/majalah/view/{{$p->majalah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                                @if($p->status_id == 1)
                                    <a href="/majalah/edit/{{$p->majalah_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="/majalah/ajukan/{{$p->majalah_id}}" class="btn btn-outline-success"><i class="fa fa-paper-plane"></i> Ajukan</a>
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
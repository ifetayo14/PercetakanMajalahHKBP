@extends('layout.layout')

@section('title')
    Periode
@endsection

@section('main-content')
<!-- Page Heading --> 
            <div class="row d-flex justify-content-between">
                <h1 class="h3">Periode</h1>
                <a href="/periode/add" class="btn btn-success"><i class="fa fa-plus"></i> Periode</a>
            </div>
            <br>
    
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                    <table style="width:100%" class="table table-striped" id="dataTable" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Tema</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($periode as $p)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>{{ $p->bulan}}</td>
                                <td>{{$p->tema}}</td>
                                <td>{{ $p->status}}</td>
                                <td>
                                    <a href="/periode/edit/{{$p->periode_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="/periode/view/{{$p->periode_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                                    <!-- <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$p->periode_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a> -->
                                </td>
                            </tr>
                                <div class="modal fade" id="deleteModal-{{$p->periode_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Hapus Periode <b>{{$p->tema}}</b> ?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <a href="periode/delete/{{$p->periode_id}}" class="btn btn-primary">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++; ?>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div> 

@endsection 
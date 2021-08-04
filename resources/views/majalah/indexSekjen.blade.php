@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading --> 
            <div class="row d-flex justify-content-between">
                <h1 class="h3">Majalah</h1>
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
                                <a href="/majalahSekjen/view/{{$p->majalah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div> 

@endsection 
@extends('layouts.app')
@section('title', 'Dashboard - Comments')
@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Deleted Comments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Deleted Comments</li>
                </ul>
            </div>
            <div class="col">
                @if($deleted_comments->count() > 0)
                    @permission('restore.deleted.comments')
                        <a href="{{route('comments.restoreAll')}}" class="btn btn-success bs_dashboard_btn bs_btn_color float-right">Restore All</a>
                    @endpermission
                    @permission('delete.forever.comments')
                        <a href="javascript:void(0)" class="btn btn-dark bs_dashboard_btn float-right" onclick="var check = confirm('Are you sure want to delete!');
                        if(check){
                            document.getElementById('deleteAllForever').submit();
                        }">Delete All Forever</a>
                        <form action="{{route('comments.forceDeleteAll')}}" method="POST" id="deleteAllForever">
                            @csrf
                        </form>
                    @endpermission
                @endif
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Comments</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="datatable table table-stripped">
                            <thead>
                                <tr>
                                    <th>Count</th>
                                    <th>User</th>
                                    <th>Post</th>
                                    <th>Comment</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1 ; ?>
                                @foreach($deleted_comments as $comment)
                                <tr>
                                    <td><?=$count++?></td>
                                    <td>{{ucwords($comment->user->name)}}</td>
                                    <td>
                                        <a href="{{url('/post',$comment->commentable->slug)}}">{{ucwords($comment->commentable->title)}}</a>
                                    </td>
                                    <td>{{$comment->body}}</td>
                                    <td>{{$comment->created_at->format('d:m:Y')}}</td>
                                    <td>
                                       <div class="actions">
                                            @permission('restore.deleted.comments')
                                            <a href="{{route('comments.restoreSingle',$comment->id)}}" class="btn btn-sm bg-success-light mr-2">
                                                <i class="fe fe-check-circle"></i> Restore
                                            </a>
                                            @endpermission
                                            @permission('delete.forever.comments')
                                            <a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('comments.forceDeleteSingle',$comment->id)}}">
                                                <i class="fe fe-trash"></i> Delete
                                            </a>
                                            @endpermission
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.attr_modal')
@endsection
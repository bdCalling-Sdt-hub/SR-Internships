@extends('backend.layouts.include.master')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between border-bottom">
                        <h5 class="card-title">Internship Listings</h5>
                        <a href="{{ route('internships.create') }}">
                            <h6 class="mt-3 btn btn-dark">+ Add</h6>
                        </a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Allowance</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internships as $internship)
                                <tr>
                                    <td>{{ $internship->id }}</td>
                                    <td>{{ $internship->title ?? '' }}</td> <!-- Fixed 'title' spelling -->
                                    <td>{{ $internship->location ?? '' }}</td>
                                    <td>{{ $internship->allowance ?? '' }}</td> <!-- Added allowance -->
                                    <td>{{ $internship->type ?? '' }}</td>
                                    <td>{{ $internship->description ?? '' }}</td>
                                    <td>{{ $internship->status ? ucfirst($internship->status) : '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('internships.edit', $internship->id) }}" class="btn btn-warning btn-sm me-2"><i class="bi bi-pencil-fill"></i></a>
                                        <form action="{{ route('internships.destroy', $internship->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this internship?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

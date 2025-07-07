@extends('admin.layouts.master')

@section('title', 'Streams')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                &nbsp;
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div
                                class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                                <h4 class="header-title">Streams</h4>
                            </div>

                            <div class="card-body">
                                <ul class="nav nav-tabs" id="streamTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab"
                                            data-bs-target="#pending" type="button" role="tab" aria-controls="pending"
                                            aria-selected="true">Pending
                                            @if($streams_count_pending > 0)
                                                <span class="badge bg-danger ms-1">{{ $streams_count_pending }}</span>
                                            @endif</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="live-tab" data-bs-toggle="tab" data-bs-target="#live"
                                            type="button" role="tab" aria-controls="live" aria-selected="false">Live
                                            @if($streams_count_live > 0)
                                                <span class="badge bg-danger ms-1">{{ $streams_count_live }}</span>
                                            @endif</button></button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ended-tab" data-bs-toggle="tab" data-bs-target="#ended"
                                            type="button" role="tab" aria-controls="ended" aria-selected="false">Ended
                                            @if($streams_count_ended > 0)
                                                <span class="badge bg-danger ms-1">{{ $streams_count_ended }}</span>
                                            @endif</button></button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="streamTabsContent">
                                    @php
                                        $statuses = ['pending', 'live', 'ended'];
                                    @endphp

                                    @foreach ($statuses as $status)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $status }}"
                                            role="tabpanel" aria-labelledby="{{ $status }}-tab">
                                            @php
                                                $filtered = $streams->where('status', $status);
                                            @endphp

                                            @if ($filtered->isEmpty())
                                                <p>No {{ $status }} streams found.</p>
                                            @else
                                                @foreach ($filtered as $stream)
                                                    <div class="card mb-3">
                                                        <div class="card-body d-flex align-items-center">
                                                            <img src="{{ $stream->image ? asset('storage/' . $stream->image) : asset('default-man.png') }}"
                                                                alt="Stream Image" class="me-3 rounded" width="100" height="80">
                                                            <div>
                                                                <h5 class="mb-1">{{ $stream->title }}</h5>
                                                                <p class="mb-0">
                                                                    <strong>Teams:</strong>
                                                                    {{ $stream->team_1 }} vs {{ $stream->team_2 }}
                                                                </p>
                                                                <p class="mb-0">
                                                                    <strong>Date:</strong> {{ $stream->date }},
                                                                    <strong>Time:</strong> {{ $stream->start_time }} -
                                                                    {{ $stream->end_time }}
                                                                </p>
                                                                <p class="mb-0"><strong>Status:</strong>
                                                                    {{ ucfirst($stream->status) }}</p>
                                                                <p class="mb-0"><strong>View Count:</strong>
                                                                    {{ ucfirst($stream->viewer_count) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
@endsection
@extends('backend.layouts.main')

@section('container')
<main id="main" class="main">
    <div class="content-wrapper p-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Analytics Dashboard</h4>
                <small class="text-muted">Welcome back! Here's what's happening.</small>
            </div>
            <span class="text-muted small"><i class="bx bx-time me-1"></i>{{ now()->format('D, d M Y') }}</span>
        </div>

        {{-- Filter Bar --}}
        <form method="GET" action="{{ route('dashboard') }}" class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2 align-items-end">

                    {{-- Quick Filter Buttons --}}
                    <div class="col-12 col-md-auto">
                        <label class="form-label small fw-semibold text-muted mb-1">Quick Filter</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['all' => 'All Time', 'today' => 'Today', 'week' => 'This Week', 'month' => 'This Month'] as $val => $label)
                            <a href="{{ route('dashboard', ['date_filter' => $val]) }}"
                                class="btn btn-sm {{ $dateFilter === $val ? 'text-white' : '' }}"
                                style="{{ $dateFilter === $val
                                ? 'background:#bfae8f; border-color:#bfae8f; color:#fff;'
                                : 'border:1px solid #bfae8f; color:#bfae8f; background:transparent;' }}">
                                {{ $label }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- From --}}
                    <div class="col-6 col-md-auto">
                        <label class="form-label small fw-semibold text-muted mb-1">From</label>
                        <input type="date" name="start_date" class="form-control form-control-sm"
                            value="{{ request('start_date') }}"
                            onchange="this.form.querySelector('[name=date_filter]').value='custom'">
                    </div>

                    {{-- To --}}
                    <div class="col-6 col-md-auto">
                        <label class="form-label small fw-semibold text-muted mb-1">To</label>
                        <input type="date" name="end_date" class="form-control form-control-sm"
                            value="{{ request('end_date') }}"
                            onchange="this.form.querySelector('[name=date_filter]').value='custom'">
                    </div>

                    <input type="hidden" name="date_filter" value="{{ $dateFilter }}">

                    {{-- Buttons --}}
                    <div class="col-auto d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-sm text-white" style="background:#bfae8f; border-color:#bfae8f;">
                            <i class="bx bx-search me-1"></i> Apply
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-reset me-1"></i> Reset
                        </a>
                    </div>

                    {{-- Active filter badge --}}
                    @if($dateFilter !== 'all')
                    <div class="col-auto d-flex align-items-end">
                        <span class="badge px-3 py-2 text-white" style="background:#bfae8f; font-size:12px;">
                            <i class="bx bx-filter-alt me-1"></i>
                            @if($dateFilter === 'today') Today
                            @elseif($dateFilter === 'week') This Week
                            @elseif($dateFilter === 'month') This Month
                            @elseif($dateFilter === 'custom')
                            {{ request('start_date') }} → {{ request('end_date') }}
                            @endif
                        </span>
                    </div>
                    @endif

                </div>
            </div>
        </form>

        {{-- Stat Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3" style="background:rgba(191,174,143,0.15);">
                            <i class="bx bx-calendar-event fs-3" style="color:#bfae8f;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4">{{ $totalEvents }}</div>
                            <div class="text-muted small">Total Events</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3" style="background:rgba(25,135,84,0.12);">
                            <i class="bx bx-file fs-3" style="color:#198754;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4">{{ $totalBlogs }}</div>
                            <div class="text-muted small">Blog Posts</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3" style="background:rgba(255,193,7,0.12);">
                            <i class="bx bx-envelope fs-3" style="color:#ffc107;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4">{{ $totalMessages }}</div>
                            <div class="text-muted small">
                                Messages
                                @if($unreadMessages > 0)
                                <span class="badge bg-danger ms-1">{{ $unreadMessages }} new</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3" style="background:rgba(13,202,240,0.12);">
                            <i class="bx bx-user-check fs-3" style="color:#0dcaf0;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4">{{ $totalRegistrations }}</div>
                            <div class="text-muted small">Registrations</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Charts Row --}}
        <div class="row g-3 mb-4">
            {{-- Registrations Chart --}}
            <div class="col-md-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="bx bx-line-chart me-1 text-primary"></i> Event Registrations (Last 6 Months)
                        </h6>
                        <canvas id="registrationsChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            {{-- Message Status Donut --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="bx bx-pie-chart me-1 text-warning"></i> Message Status
                        </h6>
                        <canvas id="messageStatusChart" height="180"></canvas>
                        <div class="d-flex justify-content-center gap-3 mt-3 small">
                            <span><span class="badge bg-danger">&nbsp;</span> Unread ({{ $messageStatusChart['unread'] }})</span>
                            <span><span class="badge bg-info">&nbsp;</span> Read ({{ $messageStatusChart['read'] }})</span>
                            <span><span class="badge bg-success">&nbsp;</span> Replied ({{ $messageStatusChart['replied'] }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Messages Chart --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="bx bx-bar-chart me-1 text-success"></i> Enquiries Received (Last 6 Months)
                        </h6>
                        <canvas id="messagesChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tables Row --}}
        <div class="row g-3">
            {{-- Upcoming Events --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0"><i class="bx bx-calendar me-1 text-primary"></i> Upcoming Events</h6>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        @forelse($upcomingEvents as $event)
                        <div class="d-flex align-items-center gap-3 py-2 border-bottom">
                            <div class="text-center bg-primary bg-opacity-10 rounded-2 px-2 py-1" style="min-width:48px">
                                <div class="fw-bold text-primary small">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                <div class="text-muted" style="font-size:10px">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-semibold text-truncate small">{{ $event->title }}</div>
                                <div class="text-muted" style="font-size:11px"><i class="bx bx-map-pin"></i> {{ Str::limit($event->location, 30) }}</div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small text-center py-3">No upcoming events.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Recent Messages --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0"><i class="bx bx-envelope me-1 text-warning"></i> Recent Messages</h6>
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
                        </div>
                        @forelse($recentMessages as $msg)
                        <div class="d-flex align-items-center gap-3 py-2 border-bottom">
                            <div class="rounded-circle bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="width:36px;height:36px;min-width:36px">
                                <i class="bx bx-user text-secondary"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-semibold small d-flex align-items-center gap-1">
                                    {{ $msg->name }}
                                    @if($msg->status === 'unread')
                                    <span class="badge bg-danger" style="font-size:9px">New</span>
                                    @endif
                                </div>
                                <div class="text-muted" style="font-size:11px">{{ $msg->email }}</div>
                            </div>
                            <div class="text-muted" style="font-size:11px">{{ $msg->created_at->diffForHumans() }}</div>
                        </div>
                        @empty
                        <p class="text-muted small text-center py-3">No messages yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = @json($registrationChart->pluck('month'));
    const regCounts = @json($registrationChart->pluck('count'));
    const msgCounts = @json($messagesChart->pluck('count'));

    // Registrations Line Chart
    new Chart(document.getElementById('registrationsChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Registrations',
                data: regCounts,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#0d6efd',
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    // Messages Bar Chart
    new Chart(document.getElementById('messagesChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Messages',
                data: msgCounts,
                backgroundColor: 'rgba(25,135,84,0.7)',
                borderRadius: 6,
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    // Message Status Donut
    new Chart(document.getElementById('messageStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Unread', 'Read', 'Replied'],
            datasets: [{
                data: [
                    {{ $messageStatusChart['unread'] }},
                    {{ $messageStatusChart['read'] }},
                    {{ $messageStatusChart['replied'] }}
                ],
                backgroundColor: ['#dc3545', '#0dcaf0', '#198754'],
                borderWidth: 2,
            }]
        },
        options: { plugins: { legend: { display: false } }, cutout: '70%' }
    });
</script>
@endsection
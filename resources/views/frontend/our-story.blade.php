@extends('frontend.layouts.master')

@section('content')
    <main class="main">

        <!-- Hero -->
        <section class="page-banner"
            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.50)), url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat; padding: 110px 0;">
            <div class="container text-white">
                <small style="letter-spacing: 2px; text-transform: uppercase;">Our Story</small>
                <h1 class="mt-3 mb-3" style="max-width: 760px; font-size: 3rem; line-height: 1.2; font-weight: 700;">
                    The Journey Behind Grandview
                </h1>
                <p style="max-width: 720px; font-size: 1.05rem; line-height: 1.8; margin-bottom: 0;">
                    Grandview was built on a simple idea: intelligent technology should make work clearer, more connected,
                    and more effective for the people behind every business.
                </p>
            </div>
        </section>

        <!-- Story Cards -->
        <section class="section bg-white" style="padding: 90px 0;">
            <div class="container">
                <div class="text-center mb-5">
                    <small style="text-transform: uppercase; letter-spacing: 2px; color: #6c757d;">Our Journey</small>
                    <h2 class="fw-bold mt-2" style="font-size: 2.2rem; color: #2d465e;">
                        The chapters that shaped who we are
                    </h2>
                </div>

                <div class="row g-4">
                    @foreach ($stories as $story)
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4" style="cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#storyModal{{ $story['id'] }}">
                                <div class="card-body p-4 p-lg-5">
                                    <small class="d-inline-block mb-3"
                                        style="letter-spacing: 1.5px; text-transform: uppercase; color: #997122;">
                                        {{ $story['label'] }}
                                    </small>

                                    <h3 class="fw-bold mb-3" style="font-size: 1.5rem; color: #2d465e;">
                                        {{ $story['title'] }}
                                    </h3>

                                    <p class="text-muted mb-4" style="line-height: 1.8;">
                                        {{ $story['excerpt'] }}
                                    </p>

                                    <button type="button" class="btn p-0 border-0 bg-transparent fw-semibold"
                                        style="color: #997122;">
                                        Read chapter <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>

    <!-- Story Modals -->
    @foreach ($stories as $story)
        <div class="modal fade" id="storyModal{{ $story['id'] }}" tabindex="-1"
            aria-labelledby="storyModalLabel{{ $story['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header border-0 px-4 px-lg-5 pt-4 pt-lg-5 pb-0">
                        <div>
                            <small class="d-block mb-2"
                                style="letter-spacing: 1.5px; text-transform: uppercase; color: #997122;">
                                {{ $story['label'] }}
                            </small>
                            <h3 class="modal-title fw-bold" id="storyModalLabel{{ $story['id'] }}" style="color: #2d465e;">
                                {{ $story['title'] }}
                            </h3>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body px-4 px-lg-5 pb-4 pb-lg-5 pt-4">
                        <p class="text-muted mb-0" style="line-height: 1.95; font-size: 1.02rem;">
                            {{ $story['content'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

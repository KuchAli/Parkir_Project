@extends('layouts.main')
@section('title', 'Parking Application - Booking')

@section('content')
<div class="container">
    <h4 class="mb-4 text-muted px-5 ms-5 text-booking">My Booking</h4>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row mb-4">
                @forelse($booking as $item)

                   

                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <div class="container">
                            

                            

                                {{-- Header --}}
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold">PKR-{{ str_pad($item->id_parkir, 3, '0', STR_PAD_LEFT) }}</h6>
                                    @if($item->status == 'booking')
                                        <span class="badge bg-primary">Upcoming</span>
                                    @elseif($item->status == 'masuk')
                                        <span class="badge bg-success">Parked</span>
                                    @else
                                        <span class="badge bg-secondary">Finished</span>
                                    @endif
                                </div>

                                <hr>

                                {{-- Info --}}
                                <p class="mb-1">
                                    <strong>Area:</strong> {{ $item->area->nama_area ?? '-' }}
                                </p>

                                <p class="mb-1">
                                    <strong>Entry:</strong><br>
                                    {{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d M Y, H:i') }}
                                </p>

                                <p class="mb-2">
                                    <strong>Exit:</strong><br>
                                    @if($item->waktu_keluar)
                                        {{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d M Y, H:i') }}
                                    @else
                                        - <i class="fas fa-exclamation-triangle text-danger">Not yet out of the parking lot</i> {{-- atau tulis "Belum Keluar / Belum Bayar" --}}
                                    @endif
                                </p>

                                <hr>
                                
                                
                                {{-- Action --}}
                                <div class="d-flex justify-content-end">
                                    <strong class="me-auto px-3 py-2">Lets Make a Booking!</strong>
                                    {{-- Tombol muncul hanya jika semua booking finished --}}
                                    @if(!$hasActiveBooking)
                                        <div class="mb-3 text-end">
                                            <a href="{{ route('owner.reservasi.create') }}" class="btn btn-primary">
                                                + Make Booking
                                            </a>
                                        </div>
                                    @endif
                                    @if($status == 'Upcoming')
                                        <form action="{{ route('owner.reservasi.destroy', $item->id_parkir) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-12 text-start">
                        <p class="text-muted">You haven't made any bookings yet.</p>
                        <a href="{{ route('owner.reservasi.create') }}" class="btn btn-primary">
                            + Make a Booking
                        </a>
                    </div>

                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
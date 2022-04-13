<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('admin.laporan-reservasi.cetakLaporan') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar"></i></span>
            <select class="form-select" name="bulan_cetak">
                @php
                    $start = \Carbon\Carbon::parse($date_old);
                    $month = $start->timestamp;
                    $end = \Carbon\Carbon::now()->timestamp;
                @endphp
                @while ($month < $end)
                    @php
                        $month_select = $start->month;
                        $month_now = \Carbon\Carbon::now()->month;
                        $value = $start->year."-".$start->month."-1";
                        $text = $start->locale('id')->monthName." ".$start->locale('id')->year;
                    @endphp
                    <option @if($month_select == $month_now) selected @endif value="{{ $value }}">{{ $text }}</option>
                    @php
                        $start = $start->addMonth(1);
                        $month = $start->timestamp;
                    @endphp
                @endwhile
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-print"></i>
            &nbsp;Cetak PDF
        </button>
    </div>
</form>
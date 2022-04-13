<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Input Jumlah</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('admin.data-reservasi.storeCart') }}" method="POST" id="form-jumlah-orang">
    <div class="modal-body">
        @csrf
        <input type="hidden" value="{{ $id }}" name="id_kamar">
        <div class="row gx-3">
            <div class="col-lg-6">
                <label class="form-label">Jumlah Dewasa</label>
                <input type="number" class="form-control" id="jumlah-dewasa" name="jumlah_dewasa" placeholder="Jumlah..." required>
                <small class="form-text text-muted" id="keterangan-dewasa"></small>
            </div>
            <div class="col-lg-6">
                <label class="form-label">Jumlah Anak</label>
                <input type="number" class="form-control" id="jumlah-anak" name="jumlah_anak" placeholder="Jumlah..." required>
                <small class="form-text text-muted" id="keterangan-anak"></small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
    </div>
</form>

<script type="text/javascript">
    $(function(){
        $('#form-jumlah-orang').submit(function(){
            var jumlah_dewasa = parseInt($('#jumlah-dewasa').val());
            var jumlah_anak = parseInt($('#jumlah-anak').val());
            if(jumlah_dewasa < 0){
                $('#keterangan-dewasa').text("Format jumlah dewasa tidak sesuai");
                $('#keterangan-anak').text("");
                return false;
            }else if(jumlah_anak < 0){
                $('#keterangan-anak').text("Format jumlah anak tidak sesuai");
                $('#keterangan-dewasa').text("");
                return false;
            }else{
                return true;
            }
        });
    })
</script>
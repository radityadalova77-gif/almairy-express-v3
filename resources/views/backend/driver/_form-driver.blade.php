{{-- FORM DRIVER --}}

<div class="form-grid">

    <div class="form-group">
        <label>ID Driver</label>
        <input type="text" name="kode_driver" value="DRV-{{ rand(1000,9999) }}" readonly>
    </div>

    <div class="form-group">
        <label>Nama Driver</label>
        <input type="text" name="nama_driver" placeholder="Masukkan nama driver" required>
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" name="no_telp" placeholder="08xxxxxxxxxx" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="driver@email.com">
    </div>

    <div class="form-group full">
        <label>Alamat</label>
        <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
    </div>

    <div class="form-group">
        <label>Nomor SIM</label>
        <input type="text" name="no_sim" placeholder="Masukkan nomor SIM" required>
    </div>

    <div class="form-group">
        <label>Jenis SIM</label>
        <select name="jenis_sim" required>
            <option value="">Pilih Jenis SIM</option>
            <option value="SIM A">SIM A</option>
            <option value="SIM B1">SIM B1</option>
            <option value="SIM B2">SIM B2</option>
        </select>
    </div>

    <div class="form-group">
        <label>Masa Berlaku SIM</label>
        <input type="date" name="expired_sim" required>
    </div>

    <div class="form-group">
        <label>Status Driver</label>
        <select name="status">
            <option value="Aktif">Aktif</option>
            <option value="Standby">Standby</option>
            <option value="Libur">Libur</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>
    </div>

    <div class="form-group">
        <label>Pengalaman (Tahun)</label>
        <input type="number" name="pengalaman" min="0" placeholder="Contoh 5">
    </div>

    <div class="form-group">
        <label>Jenis Kendaraan Dikuasai</label>
        <select name="kategori_armada">
            <option value="">Pilih</option>
            <option value="Pickup">Pickup</option>
            <option value="Box">Truck Box</option>
            <option value="Trailer">Trailer</option>
        </select>
    </div>

    <div class="form-group">
        <label>No KTP</label>
        <input type="text" name="no_ktp" placeholder="Masukkan nomor KTP">
    </div>

    <div class="form-group">
        <label>Tanggal Bergabung</label>
        <input type="date" name="tanggal_gabung" value="{{ date('Y-m-d') }}">
    </div>

    <div class="form-group full">
        <label>Catatan</label>
        <textarea name="catatan" placeholder="Catatan tambahan driver..."></textarea>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn" onclick="closeModal('add-driver')">
        Batal
    </button>

    <button type="submit" class="btn btn-primary">
        + Simpan Driver
    </button>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // auto uppercase nomor SIM
        let sim = document.querySelector('[name="no_sim"]');
        if (sim) {
            sim.addEventListener('keyup', function() {
                this.value = this.value.toUpperCase();
            });
        }

        // validasi no telp angka only
        let telp = document.querySelector('[name="no_telp"]');
        if (telp) {
            telp.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        // warning expired sim
        let expired = document.querySelector('[name="expired_sim"]');

        if (expired) {
            expired.addEventListener('change', function() {

                let today = new Date();
                let simDate = new Date(this.value);

                if (simDate < today) {
                    alert('Masa berlaku SIM sudah habis.');
                    this.focus();
                }

            });
        }

    });
</script>
@extends('frontend.layouts.app')

@section('content')

<div style="
    min-height:80vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 20px;
">

    <div style="
        width:100%;
        max-width:700px;
        background:white;
        padding:40px;
        border-radius:20px;
        box-shadow:0 10px 30px rgba(0,0,0,.05);
    ">

        <h1 style="
            font-size:38px;
            margin-bottom:16px;
        ">
            📦 Live Tracking
        </h1>

        <p style="
            color:#6b7280;
            margin-bottom:30px;
        ">
            Masukkan nomor resi untuk melacak pengiriman anda.
        </p>

        <form id="trackingForm">

            <div style="
                display:flex;
                gap:14px;
            ">

                <input
                    type="text"
                    name="resi"
                    placeholder="Masukkan nomor resi..."
                    required
                    style="
                        flex:1;
                        padding:14px;
                        border-radius:12px;
                        border:1px solid #dbd8d1;
                        outline:none;
                    ">

                <button
                    type="submit"
                    style="
                        background:#2563eb;
                        color:white;
                        border:none;
                        padding:14px 24px;
                        border-radius:12px;
                        cursor:pointer;
                        font-weight:600;
                    ">
                    Cek
                </button>

            </div>

        </form>

    </div>

</div>
<script>
    document.getElementById('trackingForm')
        .addEventListener('submit', function(e) {

            e.preventDefault();

            let resi = document.querySelector('input[name="resi"]').value;

            window.location.href = "/tracking/" + resi;

        });
</script>

@endsection
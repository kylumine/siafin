@extends('home')

@section('content')
    <h1>QR Code Scanner</h1>
    <div id="reader" style="width: 500px;"></div>

    <form id="qrForm" method="POST" action="/qr-scan-result" style="display: none;">
        @csrf
        <input type="text" id="qrData" name="qrData">
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.0.9/minified/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned result here.
            document.getElementById('qrData').value = decodedText;
            document.getElementById('qrForm').submit();
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });

        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection

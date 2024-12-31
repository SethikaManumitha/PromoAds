<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Success</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .qr-code-container {
            text-align: center;
            margin-bottom: 30px;
            border: 3px solid lightgreen; /* Light green border */
            padding: 20px; /* Add padding for better visual */
            border-radius: 10px; /* Rounded corners */
            background-color: white; /* White background to distinguish QR code */
        }
        .btn {
            width: 50%;
            margin: 20px auto;
        }
        .btn-download {
            margin-top: 10px;
        }

        /* Print Styling */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                top: 0;
                left: 0;
                padding: 20px;
                width: 100%;
            }
            .banner {
                width: 100%;
                text-align: center;
                background-color: #28a745;
                color: white;
                padding: 15px 0;
                font-size: 24px;
                margin-bottom: 20px;
            }
            .qr-code-container {
                margin-top: 20px;
                border: 3px solid lightgreen; /* Light green border for QR Code */
                padding: 20px;
                border-radius: 10px;
                background-color: white;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="print-container">
        <!-- Banner Section -->
        <div class="banner">
            <h2>Scan the QR Code Below!</h2>
        </div>

        <!-- QR Code Section for Print -->
        <div class="row qr-code-container">
            <div class="col-12">
                {!! $qrCode !!}
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <button class="btn btn-info btn-print" id="btnPrint" style="width:580px">Print QR Code</button>
            </div>
        </div>
      <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-download" id="btnDownload" style="width:580px">Download QR Code</button>
            </div>
        </div>
    
               <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" id="btnSignIn" name="btnSignIn" style="width:580px">Sign In</button>
            </div>
        </div>
      
    </div>

    

    <script>
        const btnSignIn = document.getElementById('btnSignIn');
        const btnDownload = document.getElementById('btnDownload');
        const btnPrint = document.getElementById('btnPrint');

        btnSignIn.addEventListener('click', () => {
            window.location.href = "{{ route('signin') }}";
        });

        btnDownload.addEventListener('click', () => {
            const qrCodeElement = document.querySelector('.qr-code-container svg'); 
            if (qrCodeElement) {
                const link = document.createElement('a');
                const xmlSerializer = new XMLSerializer();
                const svgContent = xmlSerializer.serializeToString(qrCodeElement);

                // Create a Blob from the SVG string to trigger download
                const svgBlob = new Blob([svgContent], { type: 'image/svg+xml' });
                const svgUrl = URL.createObjectURL(svgBlob);
                link.href = svgUrl;
                link.download = 'qr_code.svg';  
                link.click();
            } else {
                alert("QR code not found");
            }
        });

        btnPrint.addEventListener('click', () => {
            window.print();  // Trigger the print dialog
        });
    </script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

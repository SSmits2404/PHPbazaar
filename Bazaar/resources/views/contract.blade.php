<!DOCTYPE html>
<html>
<head>
    <title>Service Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .contract-header {
            text-align: center;
        }
        .contract-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="contract-header">
        <h1>Service Agreement</h1>
        <p>This Service Agreement ("Agreement") is made and entered into on <strong>{{$start_date}}</strong>.</p>
    </div>

    <div class="contract-section">
        <h2>Parties</h2>
        <p>This Agreement is between <strong>{{$clientName}}</strong> ("Client") and <strong>Provider</strong> ("Service Provider").</p>
    </div>  

    <div class="contract-section">
        <h2>Services</h2>
        <p>The Service Provider agrees to perform the following services ("Services"): <strong> kipnuggets</strong>.</p>
    </div>

    <div class="contract-section">
        <h2>Payment</h2>
        <p>For the Services rendered by the Service Provider under this Agreement, the Client will pay the Service Provider <strong> 2000 kipnuggets</strong>.</p>
    </div>

    <div class="contract-section">
        <h2>Term</h2>
        <p>This Agreement will begin on <strong>{{$start_date}}</strong> and will remain in full force and effect until <strong>you dead</strong>, unless terminated earlier as provided in this Agreement.</p>
    </div>

    <div class="contract-section">
        <h2>Signatures</h2>
        <p>By signing below, both parties agree to the terms of this Agreement.</p>

        <p>Client: ___________________________ Date: ___________</p>

        <p>Service Provider: ___________________________ Date: ___________</p>
    </div>
</body>
</html>

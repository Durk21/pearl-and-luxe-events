<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .alert { background: #fff3cd; border: 1px solid #ffc107; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .details { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #e74c3c; }
        .label { font-weight: bold; color: #2c3e50; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 New Booking Alert</h1>
        </div>
        
        <div class="content">
            <div class="alert">
                <strong>A new booking has been received!</strong> Reference: <strong>{{ $booking->reference_number }}</strong>
            </div>
            
            <div class="details">
                <h3>Client Information</h3>
                <p><span class="label">Name:</span> {{ $booking->client_name }}</p>
                <p><span class="label">Email:</span> {{ $booking->client_email }}</p>
                <p><span class="label">Phone:</span> {{ $booking->client_phone }}</p>
            </div>
            
            <div class="details">
                <h3>Booking Details</h3>
                <p><span class="label">Reference:</span> {{ $booking->reference_number }}</p>
                <p><span class="label">Event Date:</span> {{ $booking->event_date->format('F d, Y') }}</p>
                <p><span class="label">Event Type:</span> {{ $booking->event_type }}</p>
                <p><span class="label">Package:</span> {{ $booking->package->name }} (KES {{ number_format($booking->package->price, 2) }})</p>
                <p><span class="label">Guest Count:</span> {{ $booking->guest_count }}</p>
                <p><span class="label">Total Amount:</span> KES {{ number_format($booking->total_amount, 2) }}</p>
                <p><span class="label">Deposit Amount:</span> KES {{ number_format($booking->deposit_amount, 2) }}</p>
                <p><span class="label">Status:</span> {{ ucfirst($booking->status) }}</p>
            </div>
            
            @if($booking->special_requests)
            <div class="details">
                <h3>Special Requests</h3>
                <p>{{ $booking->special_requests }}</p>
            </div>
            @endif
            
            <p>Please review this booking and follow up with the client to confirm and arrange payment.</p>
            
            <div class="footer">
                <p>&copy; 2026 Pearl & Luxe Events Admin</p>
            </div>
        </div>
    </div>
</body>
</html>

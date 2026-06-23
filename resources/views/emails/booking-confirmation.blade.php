<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .details { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #667eea; }
        .label { font-weight: bold; color: #667eea; }
        .button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmation</h1>
            <p>Thank you for choosing Pearl & Luxe Events!</p>
        </div>
        
        <div class="content">
            <p>Hi {{ $booking->client_name }},</p>
            
            <p>We're thrilled to confirm your booking with us! Below are your booking details:</p>
            
            <div class="details">
                <p><span class="label">Reference Number:</span> {{ $booking->reference_number }}</p>
                <p><span class="label">Event Date:</span> {{ $booking->event_date->format('F d, Y') }}</p>
                <p><span class="label">Event Type:</span> {{ $booking->event_type }}</p>
                <p><span class="label">Package:</span> {{ $booking->package->name }}</p>
                <p><span class="label">Number of Guests:</span> {{ $booking->guest_count }}</p>
                <p><span class="label">Total Amount:</span> KES {{ number_format($booking->total_amount, 2) }}</p>
                <p><span class="label">Deposit Required:</span> KES {{ number_format($booking->deposit_amount, 2) }}</p>
                <p><span class="label">Status:</span> <strong>{{ ucfirst($booking->status) }}</strong></p>
            </div>
            
            @if($booking->special_requests)
            <div class="details">
                <p><span class="label">Special Requests:</span></p>
                <p>{{ $booking->special_requests }}</p>
            </div>
            @endif
            
            <p>Next step: Please pay the deposit to confirm your booking. Our team will contact you shortly with payment details and next steps.</p>
            
            <p><strong>Questions?</strong> Feel free to contact us at support@pearlandluxeevents.com or call us at +254 XXX XXX XXX</p>
            
            <p>Best regards,<br><strong>Pearl & Luxe Events Team</strong></p>
            
            <div class="footer">
                <p>&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>

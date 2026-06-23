<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .status-box { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #38ef7d; text-align: center; }
        .status-old { color: #999; text-decoration: line-through; }
        .status-new { font-size: 20px; color: #38ef7d; font-weight: bold; }
        .arrow { color: #38ef7d; font-size: 24px; margin: 0 10px; }
        .details { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; }
        .label { font-weight: bold; color: #11998e; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Booking Status Updated</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $booking->client_name }},</p>
            
            <p>Great news! Your booking status has been updated:</p>
            
            <div class="status-box">
                <span class="status-old">{{ ucfirst($previousStatus) }}</span>
                <span class="arrow">→</span>
                <span class="status-new">{{ ucfirst($booking->status) }}</span>
            </div>
            
            <div class="details">
                <p><span class="label">Booking Reference:</span> {{ $booking->reference_number }}</p>
                <p><span class="label">Event Type:</span> {{ $booking->event_type }}</p>
                <p><span class="label">Event Date:</span> {{ $booking->event_date->format('F d, Y') }}</p>
                <p><span class="label">Package:</span> {{ $booking->package->name }}</p>
                <p><span class="label">Current Status:</span> <strong>{{ ucfirst($booking->status) }}</strong></p>
            </div>
            
            @if($booking->status === 'confirmed')
            <p><strong>What's next?</strong> Our event coordination team will be in touch shortly to discuss final details and requirements for your event.</p>
            @elseif($booking->status === 'completed')
            <p><strong>Thank you!</strong> We appreciate your trust in Pearl & Luxe Events. We hope your event was spectacular!</p>
            @elseif($booking->status === 'cancelled')
            <p>If you have any questions about this cancellation, please contact us at support@pearlandluxeevents.com</p>
            @endif
            
            <p>For any questions, contact us at support@pearlandluxeevents.com or call +254 XXX XXX XXX</p>
            
            <p>Best regards,<br><strong>Pearl & Luxe Events Team</strong></p>
            
            <div class="footer">
                <p>&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>

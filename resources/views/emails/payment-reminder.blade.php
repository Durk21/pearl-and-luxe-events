<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .alert { background: #ffe0e0; border: 2px solid #f5576c; padding: 20px; border-radius: 5px; margin: 20px 0; text-align: center; }
        .details { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #f5576c; }
        .label { font-weight: bold; color: #f5576c; }
        .amount { font-size: 24px; color: #f5576c; font-weight: bold; }
        .button { display: inline-block; background: #f5576c; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💳 Payment Reminder</h1>
            <p>Complete your event booking</p>
        </div>
        
        <div class="content">
            <p>Hi {{ $booking->client_name }},</p>
            
            <div class="alert">
                <p style="margin: 0;"><strong>Your deposit payment is due soon!</strong></p>
                <p class="amount" style="margin: 10px 0 0 0;">KES {{ number_format($booking->deposit_amount, 2) }}</p>
            </div>
            
            <p>To secure your {{ $booking->event_type }} on <strong>{{ $booking->event_date->format('F d, Y') }}</strong>, please complete the deposit payment as soon as possible.</p>
            
            <div class="details">
                <p><span class="label">Booking Reference:</span> {{ $booking->reference_number }}</p>
                <p><span class="label">Event Type:</span> {{ $booking->event_type }}</p>
                <p><span class="label">Event Date:</span> {{ $booking->event_date->format('F d, Y') }}</p>
                <p><span class="label">Package:</span> {{ $booking->package->name }}</p>
                <p><span class="label">Deposit Due:</span> <strong>KES {{ number_format($booking->deposit_amount, 2) }}</strong></p>
            </div>
            
            <p><strong>Payment Methods Available:</strong></p>
            <ul>
                <li>M-Pesa: [Account details]</li>
                <li>Bank Transfer: [Bank details]</li>
                <li>Credit Card: [Payment link]</li>
            </ul>
            
            <p>Once payment is received, we'll send you a confirmation and detailed event planning information.</p>
            
            <p>For assistance, contact us at support@pearlandluxeevents.com or call +254 XXX XXX XXX</p>
            
            <p>Best regards,<br><strong>Pearl & Luxe Events Team</strong></p>
            
            <div class="footer">
                <p>&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
